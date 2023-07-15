<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Vente; // Remplacez "VotreModele" par le nom de votre modèle correspondant à la table de votre base de données

class UpdateDurationCommand extends Command
{
    protected $signature = 'duration:update';
    protected $description = 'Mettre à jour la durée chaque jour et mettre à jour le statut si la date est atteinte';

    public function handle()
    {
        $projets = Vente::where('status', '!=', 'terminé')->get();

        foreach ($projets as $projet) {
            $dateFin = Carbon::parse($projet->date_debut)->addDays($projet->duree);

            if (Carbon::now()->gte($dateFin)) {
                $projet->status = 'terminé';
                $projet->save();
            } else {
                $projet->duree -= 1;
                $projet->save();
            }
        }

        $this->info('La durée a été mise à jour et les statuts ont été mis à jour si nécessaire.');
    }
}

