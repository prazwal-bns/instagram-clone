<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class VerifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:verify-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::has('posts', '>', 5)->get();

        // Update the 'is_verified' field for those users
        foreach ($users as $user) {
            $user->update(['is_verified' => true]);
        }

        $this->info('Users with more than 5 posts have been verified.');
    }
}
