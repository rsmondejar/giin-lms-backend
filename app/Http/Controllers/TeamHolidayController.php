<?php

namespace App\Http\Controllers;

use App\Interfaces\ILeaveState;
use App\Models\Leave;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class TeamHolidayController extends Controller
{
    private const MODEL_NOT_FOUND = 'No se ha encontrado las vacaciones';

    private const MODEL_NAME = 'Vacaciones';

    private const ROUTE_INDEX = 'team-holidays.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $authUser */
        $authUser = auth()->user();
        $leaves = Leave::byManager($authUser->id)->with(['dates'])->get();

        return view('team_holidays')->with([
            'leaves' => $leaves,
        ]);
    }

    /**
     * Approve the specified Leave from storage.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function approve(int $id): Redirector|Application|RedirectResponse
    {
        /** @var Leave $leave */
        $leave = Leave::find($id);

        if (empty($leave)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        $leave->state_id = ILeaveState::APPROVED;
        $leave->save();

        Flash::success(sprintf("%s aprobada correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }

    /**
     * Approve the specified Leave from storage.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function reject(int $id): Redirector|Application|RedirectResponse
    {
        /** @var Leave $leave */
        $leave = Leave::find($id);

        if (empty($leave)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        $leave->state_id = ILeaveState::REJECTED;
        $leave->save();

        // Mark all leaves dates as cancelled
        foreach ($leave->dates as $date) {
            $date->is_cancelled = true;
            $date->save();
        }

        Flash::success(sprintf("%s aprobada correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }
}
