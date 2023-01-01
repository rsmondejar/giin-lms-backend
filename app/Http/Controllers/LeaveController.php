<?php

namespace App\Http\Controllers;

use App\Exceptions\RequestHolidaysException;
use App\Interfaces\ILeaveState;
use App\Models\Leave;
use Exception;
use App\Http\Requests\CreateLeaveRequest;
use App\Repositories\LeaveRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class LeaveController extends AppBaseController
{
    /** @var LeaveRepository $leaveRepository */
    private LeaveRepository $leaveRepository;

    private const MODEL_NOT_FOUND = 'No se ha encontrado las vacaciones';

    private const MODEL_NAME = 'Vacaciones';

    private const ROUTE_INDEX = 'home';

    public function __construct(LeaveRepository $leaveRepo)
    {
        $this->leaveRepository = $leaveRepo;
    }

    /**
     * Store a newly created Leave in storage.
     * @param CreateLeaveRequest $request
     * @return Redirector|Application|RedirectResponse
     * @throws RequestHolidaysException
     */
    public function store(CreateLeaveRequest $request): Redirector|Application|RedirectResponse
    {
        $input = $request->validated();

        try {
            $leave = $this->leaveRepository->create($input);

            if (empty($leave)) {
                throw new RequestHolidaysException("%s no han sido guardadas.", self::MODEL_NAME);
            }
        } catch (Exception $error) {
            Flash::error($error->getMessage());
            return redirect(route(self::ROUTE_INDEX));
        }

        Flash::success(sprintf("%s guardadas correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }

    /**
     * Remove the specified Leave from storage.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        $leave = Leave::find($id);

        if (empty($leave)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        $leave->state_id = ILeaveState::CANCELLED;
        $leave->save();

        // Mark all leaves dates as cancelled
        foreach ($leave->dates as $date) {
            $date->is_cancelled = true;
            $date->save();
        }

        Flash::success(sprintf("%s eliminadas correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }

}
