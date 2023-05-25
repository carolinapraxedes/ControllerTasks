<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\Lang;

class resetPasswordNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    /**
     * Create a new notification instance.
     */
    public function __construct($token,$email)
    {
        //
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = 'http://localhost:8000/password/reset/'.$this->token.'?email='.$this->email;
        return (new MailMessage)
        ->subject('Reset Password Notification')
        ->line('You are receiving this email because we received a password reset request for your account.')
        ->action('Reset Password', $url)
        ->line('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
        ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}