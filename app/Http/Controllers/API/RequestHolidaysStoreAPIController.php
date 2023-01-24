<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User as EmployeeUser;
use App\Http\Controllers\GetRequestHolidaysMetricsController as Metrics;
use App\Http\Controllers\RequestHolidaysController;
use App\Exceptions\RequestHolidaysException;
use App\Interfaces\ILeaveState;
use App\Interfaces\IRequestHolidaysErrorCode;
use App\Models\Leave;
use App\Models\LeaveDate;
use App\Models\UserHoliday;
use App\Http\Requests\RequestHolidaysRequest;
use App\Traits\HolidaysTrait;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Request Holidays Store API Controller.
 * Manage Request of type Holidays.
 * @package App\Http\Controllers\API
 */
class RequestHolidaysStoreAPIController extends BaseAPIController
{
    use HolidaysTrait;

    /**
     * Store Request Holiday
     * @throws Throwable
     */
    public function __invoke(RequestHolidaysRequest $request): JsonResponse
    {
        $output = self::baseResponse();

        try {
            DB::beginTransaction();


            $userId = auth()->id();
            $year = Carbon::today()->year;

            $data = $request->validated();

            /**
             * Opciones:
             * A) Si tiene dias sin usar y es para antes de 1 marzo, pues se le cuentan del ano anterior.
             * B) Si tiene dias sin usar y >= 1 marzo, se aplican como vacaciones del siguiente ano.
             * C) Si no tienes dias sin usar, es para el siguiente ano, directamente se cargan como si fueran
             * para el ano siguiente
             */
            $userHoliday = self::getUserHoliday($data);

            if (empty($userHoliday)) {
                $output['error_code'] = IRequestHolidaysErrorCode::USER_HOLIDAYS_NOT_SET;
                throw new RequestHolidaysException(
                    sprintf(
                        "The user [%d] doesn't have configured holidays for year %s.",
                        $userId,
                        $year,
                    )
                );
            }

            $leave = new Leave();
            $leave->fill([
                'comment' => $data['comment'],
//                'emails' => $data['notifyEmails'],
                'user_id' => auth()->id(),
                'requested_to_user_id' => $data['manager'],
                'state_id' => ILeaveState::PENDING,
                'type_id' =>$data['reason'],
                'user_holiday_id' => $userHoliday->id,
            ]);

            $leave->save();

            $daysNotProcessed = [];
            $requestDatesArray = $data['dates'];

            // Get Leaves from this user
            $previousLeaves = self::getPreviousLeaves($requestDatesArray);

            foreach ($data['dates'] as $date) {
                /*
                 * No debería hacer falta comprobar que no cae en un festivo o fin de semana,
                 * ese check se hace ya en el front.
                 */
                // Check if day is not previously requested
                if (!$previousLeaves->contains('date', Carbon::parse($date))) {
                    $leave->dates()->create([
                        'date' => $date,
                        'is_half_day' => $date['is_halfday'] ?? false,
                    ]);
                } else {
                    $daysNotProcessed[] = [
                        'date' => $date['date'],
                        'reason' => 'Date previously requested by the user and it is not cancelled',
                    ];
                }
            }

            $output['data']['days_no_processed'] = $daysNotProcessed;

            // If all days requested are already requested and not cancelled.
            if (count($daysNotProcessed) === count($data['dates'])) {
                $output['error_code'] = IRequestHolidaysErrorCode::DAYS_PREVIOUSLY_REQUESTED;
                throw new RequestHolidaysException("All days requested are previously requested and not cancelled.");
            }

            $output['message'] = "Request Holiday Saved Successfully";

            DB::commit();
        } catch (Throwable $error) {
            DB::rollback();
            Log::error($error);

            $output['error'] = true;
            $output['status'] = 400;
            $output['error_code'] = $error->getCode();
            $output['message'] = $error->getMessage();
            $output['errors'][] = $error->getMessage();
        }

        return response()->json($output)->setStatusCode($output['status']);
    }

    /**
     * Get User Holiday
     * @param array $data
     * @return UserHoliday|null
     * @throws RequestHolidaysException
     */
    private function getUserHoliday(array $data): ?UserHoliday
    {
        $userId = auth()->id();
        $year = Carbon::today()->year;

        /** @var EmployeeUser $user */
        $user = EmployeeUser::find($userId);
        $userHoliday = null;

        $totalRequestedDays = RequestHolidaysController::getSumDays($data['dates']);
        $lastDayRequested = RequestHolidaysController::getLastDay($data['dates']);

        $maxDateToUseDaysFromCurrentYear = Carbon::createFromDate(($year), 3, 1)->startOfDay();
        $maxDateToUseDaysFromNextYear = Carbon::createFromDate(($year + 1), 3, 1)->startOfDay();

        if ($lastDayRequested < $maxDateToUseDaysFromCurrentYear) {
            // Comprobar si tiene dias disponibles año pasado
            $vacationRemainingDaysPreviousYear = Metrics::getLastYearVacationsRemainingDaysByUser($user);

            if ($vacationRemainingDaysPreviousYear >= $totalRequestedDays) {
                // Se cargan al año anterior
                $userHoliday = UserHoliday::where([
                    'user_id' => $userId,
                    'year' => ($year - 1),
                ])->first();
            }
        } else {
            // Comprobar si tiene dias disponibles este año
            $vacationRemainingDaysCurrentYear = Metrics::getCurrentVacationsRemainingDaysByUser($user);

            if ($lastDayRequested < $maxDateToUseDaysFromNextYear && !$vacationRemainingDaysCurrentYear) {
                // No tiene vacaciones disponibles para este año
                throw new RequestHolidaysException(
                    sprintf(
                        "The user [%d] doesn't have enough holidays available for year %s." .
                        " Available [%.2f], requested [%.2f]",
                        $userId,
                        $year,
                        $vacationRemainingDaysCurrentYear,
                        $totalRequestedDays,
                    ),
                    IRequestHolidaysErrorCode::ALL_HOLIDAYS_ALREADY_TAKEN
                );
            }

            if ($lastDayRequested >= $maxDateToUseDaysFromNextYear) {
                $userHoliday = UserHoliday::where([
                    'user_id' => $userId,
                    'year' => ($year + 1),
                ])->first();

                if (is_null($userHoliday)) {
                    $userHoliday = $this->generateUserHolidaysNextYearForUser($user);
                }

                if (empty($userHoliday)) {
                    $output['error_code'] = IRequestHolidaysErrorCode::USER_HOLIDAYS_NOT_SET;
                    throw new RequestHolidaysException(
                        sprintf(
                            "The user [%d] doesn't have configured holidays for year %s.",
                            $userId,
                            ($year + 1),
                        )
                    );
                }

                $vacationRemainingDaysNextYear = Metrics::getNextVacationsRemainingDaysByUser($user);
                if ($vacationRemainingDaysNextYear < $totalRequestedDays) {
                    throw new RequestHolidaysException(
                        sprintf(
                            "The user [%d] doesn't have enough holidays available for year %s." .
                            " Available [%.2f], requested [%.2f]",
                            $userId,
                            ($year + 1),
                            $vacationRemainingDaysNextYear,
                            $totalRequestedDays,
                        ),
                        IRequestHolidaysErrorCode::ALL_HOLIDAYS_ALREADY_TAKEN
                    );
                }
            }
        }

        if (is_null($userHoliday)) {
            $userHoliday = UserHoliday::where([
                'user_id' => $userId,
                'year' => $year,
            ])->first();
        }

        return $userHoliday;
    }

    /**
     * Get Array From Dates.
     * @param array $dates
     * @return array
     */
    protected static function getArrayFromDates(array $dates): array
    {
        $requestDatesArray = [];
        foreach ($dates as $date) {
            $requestDatesArray[] = $date['dateFormatted'];
        }
        return $requestDatesArray;
    }

    /**
     * Get Previous Leaves.
     * @param array $requestDatesArray
     * @return array|Collection
     */
    protected static function getPreviousLeaves(array $requestDatesArray): array|Collection
    {
        return LeaveDate::byUser(auth()->id())
            ->whereIn('date', $requestDatesArray)
            ->where('is_cancelled', false)
            ->select('date')
            ->get();
    }
}
