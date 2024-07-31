<?php

namespace App\Jobs\CMS;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Libraries\Mailer;
use Mail;

class SendResetPasswordMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        //
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // send email
        $mailer = (new Mailer)->setSubject('Password Reset Account - ' . config('cms.site_title'))
            ->setTitle('Reset your Account')
            ->setContent('Hello, we just receive a password reset request for your <strong>' . config('cms.site_title') . '</strong> account. If you dont make such request, you can ignore this email. To reset your account password, click the activation link below : ')
            ->setButton([
                'url' => route('cms.auth.reset-password', ['token' => $this->token]),
                'label' => 'Reset Password Here'
            ]);

        Mail::to($this->email)->send($mailer);
    }
}
