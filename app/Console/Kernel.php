<?php

namespace App\Console;

use App\Console\Commands\GenerateUserHolidays;
use App\Console\Commands\GenerateUserHolidaysNextYear;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use InfyOm\Generator\Commands\API\APIControllerGeneratorCommand;
use InfyOm\Generator\Commands\API\APIGeneratorCommand;
use InfyOm\Generator\Commands\API\APIRequestsGeneratorCommand;
use InfyOm\Generator\Commands\APIScaffoldGeneratorCommand;
use InfyOm\Generator\Commands\Scaffold\ScaffoldGeneratorCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        APIGeneratorCommand::class,
        APIRequestsGeneratorCommand::class,
        APIControllerGeneratorCommand::class,
        APIScaffoldGeneratorCommand::class,
        ScaffoldGeneratorCommand::class,
        GenerateUserHolidays::class,
        GenerateUserHolidaysNextYear::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly(); // NOSONAR
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php'); // NOSONAR
    }
}
