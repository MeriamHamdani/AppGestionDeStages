<?php

namespace App\Notifications;

use App\Models\Etudiant;
use App\Models\Soutenance;
use App\Mail\SoutenanceMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SoutenanceNotification extends Notification
{
    use Queueable;
    public Etudiant $etudiant;
    public Soutenance $soutenance;
    public String $post;
    public String $encadrant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Soutenance $soutenance,Etudiant $etudiant,String $encadrant,String $post)
    {
        $this->etudiant=$etudiant;
        $this->soutenance=$soutenance;
        $this->post=$post;
        $this->encadrant=$encadrant;

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
        return (new SoutenanceMail($this->soutenance,$this->etudiant,$this->encadrant,$this->post,$notifiable))
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
        return ['encadrant'=>$this->encadrant,
                'etudiant'=>$this->etudiant->id,
                'post'=>$this->post,
                'soutenance'=>$this->soutenance->id,
                'notifiable'=>$notifiable ] ;
    }

}