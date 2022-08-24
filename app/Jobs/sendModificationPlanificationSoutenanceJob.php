<?php

namespace App\Jobs;

use App\Models\Etudiant;
use App\Models\Enseignant;
use App\Models\Soutenance;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\EditSoutenanceNotification;

class sendModificationPlanificationSoutenanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $notifiable;
	public Soutenance $soutenance;
	public String $etat;
	public String $post;
	public Etudiant $etudiant;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Enseignant $notifiable,Soutenance $soutenance,String $etat, String $post,Etudiant $etudiant)
    {
        $this->notifiable=$notifiable;
		$this->soutenance=$soutenance;
		$this->etat=$etat;
		$this->post=$post;
		$this->etudiant=$etudiant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->notifiable->notify(new EditSoutenanceNotification($this->soutenance,$this->etat,$this->post,$this->etudiant));
    }
}