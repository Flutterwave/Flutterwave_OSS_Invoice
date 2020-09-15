<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification implements ShouldQueue
{
    use Queueable;

    private $name;

    /**
     * Create a new notification instance.
     *
     * @param $name
     */
    public function __construct($name)
    {
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
            'title' => 'Welcome to Invoices'
        ];
        return $mail
            ->subject('Welcome to Invoices')
            ->line('Thank you for choosing Flutterwave Invoices.
                You can now create and manage invoices between you and your clients.');
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
