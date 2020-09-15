<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassword extends Notification implements ShouldQueue
{
    use Queueable;

    private $link, $name;

    /**
     * Create a new notification instance.
     *
     * @param $name
     * @param $link
     */
    public function __construct($name, $link)
    {
        $this->link = $link;
        $this->$name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = new MailMessage;
        $mail->markdown = 'emails.default';
        $mail->viewData = [
            'greeting' => "Hi $this->name,",
            'title' => 'Reset Password'
        ];
        return $mail
            ->subject('Reset Password')
            ->line('Thank you for choosing Flutterwave Invoices. Please click the button below to reset your password.')
            ->action('Reset Password', $this->link)
            ->line('If you did not initiate this operation, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
