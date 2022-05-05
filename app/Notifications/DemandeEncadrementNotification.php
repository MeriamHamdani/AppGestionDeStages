<?php

namespace App\Notifications;

use App\Mail\ConfirmerEncadrement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeEncadrementNotification extends Notification
{
    use Queueable;

    public $data=[];
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->data=$data;
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
        return (new ConfirmerEncadrement($this->data))
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
        return 
           $this->data;
    }
}