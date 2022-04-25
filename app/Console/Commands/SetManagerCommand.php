<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetManagerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:manager {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set user a manager by email';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $email = $this->argument('email');
        $user = User::where('email',$email)->first();
        $user->setManager();

        $this->info('User '. $user->name. ' successfully set to manager');
    }
}
