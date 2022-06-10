<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SessionDepotModifie extends Mailable
{
    use Queueable, SerializesModels;
    public $data=[];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ihec@gmail.com')
            ->subject('Session de dépôt est modifiée')
            ->view('emails.etudiant.sessionModifie');
    }
}
