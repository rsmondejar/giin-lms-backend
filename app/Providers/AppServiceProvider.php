<?php

namespace App\Providers;

use App\Models\Business;
use App\Models\Department;
use App\Models\Leave;
use App\Models\LeaveDate;
use App\Models\LeaveState;
use App\Models\LeaveType;
use App\Models\PublicHoliday;
use App\Models\User;
use App\Models\UserHoliday;
use App\Observers\BusinessObserver;
use App\Observers\DepartmentObserver;
use App\Observers\LeaveDateObserver;
use App\Observers\LeaveObserver;
use App\Observers\LeaveStateObserver;
use App\Observers\LeaveTypeObserver;
use App\Observers\PublicHolidayObserver;
use App\Observers\UserHolidayObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public const DEFAULT_STRING_LENGTH = 191;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(self::DEFAULT_STRING_LENGTH);

        if (!app()->environment('production')) {
            Mail::alwaysTo(env('MAIL_TO_DEVELOPER', ''));
        }

        Business::observe(BusinessObserver::class);
        Department::observe(DepartmentObserver::class);
        Leave::observe(LeaveObserver::class);
        LeaveDate::observe(LeaveDateObserver::class);
        LeaveState::observe(LeaveStateObserver::class);
        LeaveType::observe(LeaveTypeObserver::class);
        PublicHoliday::observe(PublicHolidayObserver::class);
        User::observe(UserObserver::class);
        UserHoliday::observe(UserHolidayObserver::class);
    }
}
