<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;

class KlantResetPassword extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $resetUrl = url(route('klant.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Wachtwoord herstellen - The Hair Hub')
            ->view('emails.wachtwoord-reset-link', [
                'actionUrl' => $resetUrl,
                'expiresInMinutes' => config('auth.passwords.klanten.expire', 60)
            ]);
    }
} 