<?php

namespace App\Mail;

use App\Models\Etudiant;
use App\Models\Soutenance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SoutenanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public Etudiant $etudiant;
    public Soutenance $soutenance;
    public String $post;
    public String $encadrant;
    public $notifiable;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Soutenance $soutenance,Etudiant $etudiant,String $encadrant,String $post,$notifiable)
    {

        $this->etudiant=$etudiant;
        $this->soutenance=$soutenance;
        $this->post=$post;
        $this->encadrant=$encadrant;
        $this->notifiable=$notifiable;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ihec@gmail.com')
                    ->subject('Planning de soutenance')
                    ->view('emails.soutenance');
    }
}