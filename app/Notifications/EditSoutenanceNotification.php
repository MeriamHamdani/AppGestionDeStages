<?php

namespace App\Notifications;

use App\Models\Etudiant;
use App\Models\Soutenance;
use Illuminate\Bus\Queueable;
use App\Mail\EditSoutenanceMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EditSoutenanceNotification extends Notification
{
    use Queueable;
    public Etudiant $etudiant;
    public Soutenance $soutenance;
    public String $post;
    public String $etatt;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Soutenance $soutenance,String $etatt,String $post,Etudiant $etudiant)
    {
        $this->etudiant=$etudiant;
        $this->soutenance=$soutenance;
        $this->post=$post;
        $this->etatt=$etatt;

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
        return (new EditSoutenanceMail($this->soutenance,$this->etatt,$this->post,$notifiable,$this->etudiant))
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
        return [
            'soutenance'=>$this->soutenance,
            'notifiable'=>$notifiable,
            'etat'=>$this->etatt,
            'post'=>$this->post
        ];
    }
}