<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DownloadLettreAffectationtMail extends Mailable
{
    use Queueable, SerializesModels;
public $details=[];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $details)
    {
        $this->details=$details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ihec@gmail.com')
                    ->subject('Confirmation de demande de stage')
                    ->view('emails.etudiant.downloadLettreAffectation');
    }
}
