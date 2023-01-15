<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Traits\HolidaysTrait;
use App\Traits\SeniorityDaysTrait;

/**
 * Command GenerateUserHolidays
 * @package App\Console\Commands
 */
class GenerateUserHolidays extends Command
{
    use HolidaysTrait;
    use SeniorityDaysTrait;

    protected $signature = 'lms:generate-user-holidays';

    protected $description = 'Genera los días festivos anuales de cada empleado';

    /**
     * @return void
     */
    public function handle(): void
    {
        $users = User::orderBy('name')->get();

        /** @var User $user */
        $users->each(function ($user) {
            $userHoliday = $this->generateUserHolidaysCurrentYearForUser($user);

            $this->line(
                sprintf(
                    'Generating holidays for: %s [Holidays: %.2f] [Seniority: %.2f]',
                    $user->name,
                    $userHoliday->holidays,
                    $userHoliday->seniority_days,
                )
            );
        });
    }
}
