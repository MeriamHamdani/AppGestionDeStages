<?php

namespace App\Mail;

use App\Models\Etudiant;
use App\Models\Soutenance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditSoutenanceMail extends Mailable
{
    use Queueable, SerializesModels;
    public Soutenance $soutenance;
    public String $post;
    public String $etatt;
    public $notifiable;
    public Etudiant $etudiant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Soutenance $soutenance,String $etatt,String $post,$notifiable,Etudiant $etudiant)
    {
        $this->soutenance=$soutenance;
        $this->post=$post;
        $this->etatt=$etatt;
        $this->notifiable=$notifiable;
        $this->etudiant=$etudiant;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ihec@gmail.com')
        ->subject('Changement de planning de soutenance')->view('emails.editSoutenance');
    }
}