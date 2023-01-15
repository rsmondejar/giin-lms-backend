<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lms:sync-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all users
        $users = User::with(['roles'])->whereDoesntHave('roles', fn ($q) => $q->where('name', 'super-admin'))->get();

        $users->each(
            fn ($user) => $user->roles->each(
                fn ($role) => $user->syncPermissions($role->getPermissionNames())
            )
        );

        return Command::SUCCESS;
    }
}
