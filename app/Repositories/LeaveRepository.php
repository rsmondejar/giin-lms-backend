<?php

namespace App\Repositories;

use Carbon\Carbon;
use DB;
use App\Exceptions\RequestHolidaysException;
use App\Interfaces\ILeaveState;
use App\Interfaces\ILeaveType;
use App\Interfaces\IRequestHolidaysErrorCode;
use App\Models\Leave;
use App\Models\LeaveDate;
use App\Models\UserHoliday;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class LeaveRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'user_id',
        'requested_to_user_id',
        'emails',
        'comment',
        'state_id',
        'type_id',
        'user_holiday_id',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Leave::class;
    }

    /**
     * @throws RequestHolidaysException
     */
    public function create(array $input): Leave
    {
        $userId = auth()->id();
        $year = today()->year;
        $leave = null;

        try {
            DB::beginTransaction();

            $userHoliday = UserHoliday::where([
                'user_id' => $userId,
                'year' => $year,
            ])->first();

            if (is_null($userHoliday)) {
                $userHoliday = UserHoliday::create([
                    'user_id' => $userId,
                    'year' => $year,
                    'holidays' => 22,
                    'seniority_days' => 0,
                    'extra' => 0
                ]);
            }

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
                'comment' => $input['comment'],
                'emails' => !is_null($input['emails']) ? self::cleanEmailInput($input['emails']) : null,
                'user_id' => auth()->id(),
                'requested_to_user_id' => $input['requested_to_user_id'],
                'state_id' => ILeaveState::PENDING,
                'type_id' => ILeaveType::HOLIDAYS,
                'user_holiday_id' => $userHoliday->id,
            ]);

            $leave->save();

            // Store days
            $requestDatesArray = explode(',', $input['dates']);

            // Get Leaves from this user
            $previousLeaves = self::getPreviousLeaves($requestDatesArray);

            foreach ($requestDatesArray as $date) {
                // Check if day is not previously requested
                if (!$previousLeaves->contains('date', Carbon::parse($date))) {
                    $leave->dates()->create([
                        'date' => $date,
                        'is_half_day' => 0, // @TODO: De momento lo tenemos harcodeado
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error->getMessage());
        }

        return $leave;
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

    /**
     * Clean Email Input
     * @param string $email
     * @return string
     */
    private static function cleanEmailInput(string $email): string
    {
        $email = str_replace(' ', '', $email);
        return str_replace(',', ';', $email);
    }
}
