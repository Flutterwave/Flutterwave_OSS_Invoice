<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInvoice extends Notification  implements ShouldQueue
{
    use Queueable;

    private $ref, $reminder;

    /**
     * Create a new notification instance.
     * @param $invoice
     * @param $reminder
     */
    public function __construct($invoice, $reminder = false)
    {
        $this->ref = $invoice->ref;
        $this->reminder = $reminder;
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
        $title = ($this->reminder? "Reminder — " : '') . "Invoice #$this->ref";
        $mail->viewData = [
            'name' => '',
            'title' => $title
        ];
        return $mail
            ->subject($title)
            ->line('I hope this email meets you well. Kindly find attached the invoice to my goods/services')
            ->line('Thanks and hope to hear from you soon')
            ->attach(public_path("invoices/$this->ref.pdf"));
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
