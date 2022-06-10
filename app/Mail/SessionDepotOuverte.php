<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SessionDepotOuverte extends Mailable
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
            ->subject('Session de dépôt ouverte')
            ->view('emails.etudiant.sessionOuverte');
    }
}
