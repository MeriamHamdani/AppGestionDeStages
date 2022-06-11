<?php

namespace App\Notifications;

use App\Mail\DownloadFicheEncadrementMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DownloadFicheEncadrementNotification extends Notification
{
    use Queueable;
    public $details2;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details2)
    {
        $this->details2=$details2;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new DownloadFicheEncadrementMail($this->details2))
            ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->details2;
    }
}
