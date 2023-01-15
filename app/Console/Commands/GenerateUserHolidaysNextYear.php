<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Traits\HolidaysTrait;
use App\Traits\SeniorityDaysTrait;

/**
 * Command GenerateUserHolidaysNextYear
 * @package App\Console\Commands
 */
class GenerateUserHolidaysNextYear extends Command
{
    use HolidaysTrait;
    use SeniorityDaysTrait;

    protected $signature = 'lms:generate-user-holidays-next-year';

    protected $description = 'Genera los días festivos anuales de cada empleado para el siguiente año';

    /**
     * @return void
     */
    public function handle(): void
    {
        $users = User::orderBy('name')->get();

        $users->each(function ($user) {
            $userHoliday = $this->generateUserHolidaysNextYearForUser($user);

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
