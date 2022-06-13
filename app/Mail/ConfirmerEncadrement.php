<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmerEncadrement extends Mailable
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
                    ->subject('Demande d\'encadrement')
                    ->view('emails.enseignant.demandeConfirmationEncadrement');
    }
}
