<?php

namespace App\Console\Commands\Test;

use App\Models\User;
use Illuminate\Console\Command;

class SendVerifyEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify {--email=}';

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
        $email = $this->option('email');
        $user = User::query()
            ->where('email', $email)
            ->first();

        if (! $user) {
            $this->info("User with '{$email}' not found");
            return;
        }

        $user->email_verified_at = null;
        $user->save();

        $user->sendEmailVerificationNotification();
    }
}
