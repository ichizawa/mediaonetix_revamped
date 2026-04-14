<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    protected $baseUrl;

    public function __construct($baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
    }

    protected function verificationUrl($notifiable): string
    {

        if ($this->baseUrl) {
            URL::forceRootUrl($this->baseUrl);
        }


        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addHours(24),
            // Carbon::now()->addMinutes(1),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );


        if ($this->baseUrl) {
            URL::forceRootUrl(Config::get('app.url'));
        }

        return $url;
    }

    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('MediaoneTix Account Activation')
            ->view('mail.auth-verification', [
                'verificationUrl' => $url,
                'user' => $notifiable,
            ]);
    }
}
