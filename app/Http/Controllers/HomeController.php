<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use App\Http\Controllers\GetRequestHolidaysMetricsController as Metrics;

class HomeController extends Controller
{
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

        $managers = User::ofManagersByUser($authUser)
            ->orderBy('name')
            ->pluck('name', 'id');

        $leaveTypes = LeaveType::orderBy('name')->pluck('name', 'id');

        $leaves = Leave::byUser($authUser->id)->with(['dates'])->get();

        return view('home')->with([
            'managers' => $managers,
            'leaveTypes' => $leaveTypes,
            'leaves' => $leaves,
            'metrics' => self::getMetrics($authUser),
        ]);
    }

    public static function getMetrics(User $user): array
    {
        return [
            'sickness_days' => Metrics::getSicknessDaysByUser($user),
            'unofficial_leaves_days' => Metrics::getUnofficialLeavesDaysByUser($user),
            'leaves_of_absence_days' => Metrics::getLeavesOfAbsenceDaysByUser($user),
            'vacations_days' => Metrics::getCurrentVacationsDaysByUser($user),
            'vacations_remaining_days' => Metrics::getCurrentVacationsRemainingDaysByUser($user),
            'vacations_per_year_days' => Metrics::getVacationsPerYearDaysByUser($user),
            'seniority_days' => Metrics::getCurrentSeniorityDaysByUser($user),
            'seniority_remaining_days' => Metrics::getCurrentSeniorityRemainingDaysByUser($user),
            'seniority_per_year_days' => Metrics::getSeniorityPerYearDaysByUser($user),
            'last_year_vacations_days' => Metrics::getLastYearVacationsDaysByUser($user),
            'last_year_vacations_remaining_days' => Metrics::getLastYearVacationsRemainingDaysByUser($user),
            'last_year_vacations_per_year_days' => Metrics::getLastYearVacationsPerYearDaysByUser($user),
        ];
    }
}
