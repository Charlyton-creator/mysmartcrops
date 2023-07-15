<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Schema;
use Illuminate\Database\Schema\Blueprint;

class createTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating tables ....');
        // $this->createAgriculteursTable();
        // $this->createProjetsTable();
        // $this->createParcellesTable();
        // $this->createVarietesTable();
        // $this->createSaisonCultureTable();
        // $this->createCulturesTable();
        // $this->createRecolteTable();
        // $this->createSaisonsTable();
        // $this->createVentesTable();
        // $this->createFournisseursTable();
        // $this->createProduitsTable();
        // $this->createPublicitesTable();
        // $this->createVenteProduitTable();
        // $this->createProduitPubliciteTable();
        // $this->createImagesTable();
        // $this->createParticuliersTable();
        //$this->createCommandesTable();
        // $this->createCommandeProduitTable();
        // $this->createInvestisseursTable();
        // $this->createInvestisseurProjetTable();
        // $this->createPortefeuilAgriculteursTable();
        // $this->createPortefeuilPartTable();
        //$this->createPortefeuilFournisseurTable();
        //$this->CreatePanierTable();
        //$this->CreatePanierItemTable();

        $this->info('All tables migrated Successfuuly');
    }

    

    private function createAgriculteursTable()
    {
        if(!Schema::hasTable('agriculteurs')){
            Schema::create('agriculteurs', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->string('prenoms')->nullable();
                $table->string('sexe')->nullable();
                $table->integer('age')->nullable();
                $table->string('telephone');
                $table->string('region')->nullable();
                $table->string('ville');
                $table->string('village')->nullable();
                $table->string('ferme')->nullable();
                $table->string('association')->nullable();
                $table->timestamps();
            });
        }
        
    }
    private function createSaisonCultureTable(){
        if(!Schema::hasTable('saison_cultures')){
            Schema::create('saison_cultures', function (Blueprint $table) {
                $table->id();
                $table->integer('année');
                $table->string('mois_debut');
                $table->string('mois_fin');
                $table->timestamps();
            });
        }
    }

    private function createProjetsTable()
    {
        if(!Schema::hasTable('projets')){
            Schema::create('projets', function (Blueprint $table) {
                $table->id();
                $table->string('designation');
                $table->text('description');
                $table->string('document_descriptif');
                $table->unsignedBigInteger('agriculteur_id');
                $table->foreign('agriculteur_id')->references('id')->on('agriculteurs')->onDelete('cascade');
                $table->timestamps();
            });
        }
        
    }

    private function createParcellesTable()
    {
        if(!Schema::hasTable('parcelles')){
            Schema::create('parcelles', function (Blueprint $table) {
                $table->id();
                $table->string('lieu');
                $table->string('etendu');
                $table->unsignedBigInteger('agriculteur_id');
                $table->foreign('agriculteur_id')->references('id')->on('agriculteurs')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createVarietesTable()
    {
        if(!Schema::hasTable('varietes')){
            Schema::create('varietes', function (Blueprint $table) {
                $table->id();
                $table->string('libelle');
                $table->string('code');
                $table->unsignedBigInteger('agriculteur_id');
                $table->foreign('agriculteur_id')->references('id')->on('agriculteurs')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createCulturesTable()
    {
       if(Schema::hasTable('cultures')){
        Schema::table('cultures', function (Blueprint $table) {
            // $table->id();
            // $table->string('libelle');
            // $table->date('date_semence');
            // $table->longText('engrais_utilises');
            // $table->date('date_entretien_1');
            // $table->date('date_entretien_2')->nullable();
            // $table->date('date_entretien_3')->nullable();
            // $table->unsignedBigInteger('variete_id');
            // $table->foreign('variete_id')->references('id')->on('varietes')->onDelete('cascade');
            $table->foreignId('saison_culture_id')->constrained('saison_cultures');
            $table->foreignId('parcelle_id')->constrained('parcelles');
            //$table->timestamps();
        });
       }
    }
    private function createSaisonsTable()
    {
        if(!Schema::hasTable('saisons')){
            Schema::create('saisons', function (Blueprint $table) {
                $table->id();
                $table->integer('annee');
                $table->integer('mois');
                $table->date('debut');
                $table->date('fin');
                $table->timestamps();
            });
        }
        
    }

    private function createVentesTable()
    {
        if(!Schema::hasTable('ventes')){
            Schema::create('ventes', function (Blueprint $table) {
                $table->id();
                $table->string('description');
                $table->string('duree');
                $table->unsignedBigInteger('saison_id');
                $table->foreign('saison_id')->references('id')->on('saisons')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createProduitsTable()
    {
        if(!Schema::hasTable('produits')){
            Schema::create('produits', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->decimal('prix', 8, 2);
                $table->float('poids_base');
                $table->unsignedBigInteger('culture_id');
                $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createPublicitesTable()
    {
        if(!Schema::hasTable('publicites')){
            Schema::create('publicites', function (Blueprint $table) {
                $table->id();
                $table->string('libelle');
                $table->string('image_descriptive');
                $table->string('public_cible');
                $table->unsignedBigInteger('saison_id');
                $table->foreign('saison_id')->references('id')->on('saisons')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createVenteProduitTable()
    {
        if(!Schema::hasTable('vente_produit')){
            Schema::create('vente_produit', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('vente_id');
                $table->unsignedBigInteger('produit_id');
                $table->foreign('vente_id')->references('id')->on('ventes')->onDelete('cascade');
                $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createProduitPubliciteTable()
    {
        if(!Schema::hasTable('produit_publicite')){
            Schema::create('produit_publicite', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('produit_id');
                $table->unsignedBigInteger('publicite_id');
                $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
                $table->foreign('publicite_id')->references('id')->on('publicites')->onDelete('cascade');
                $table->timestamps();
            });
        }
        
    }
    private function createImagesTable()
    {
        if(!Schema::hasTable('images')){
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->string('image_source');
                $table->string('description');
                $table->unsignedBigInteger('produit_id');
                $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
                $table->timestamps();
            });
        }  
    }

    private function createParticuliersTable()
    {
        if(!Schema::hasTable('particuliers')){
            Schema::create('particuliers', function (Blueprint $table) {
                $table->id();
                $table->string('noms');
                $table->string('prenoms');
                $table->string('sexe')->nullable();
                $table->string('compagnie')->nullable();
                $table->string('email')->nullable();
                $table->string('telephone');
                $table->string('ville');
                $table->string('region');
                $table->timestamps();
            });
        }
    }

    private function createCommandesTable()
    {
        if(!Schema::hasTable('commandes')){
            Schema::create('commandes', function (Blueprint $table) {
                $table->id();
                $table->string('adresse');
                $table->date('date_emission');
                $table->decimal('total', 8, 2);
                $table->unsignedBigInteger('particulier_id');
                $table->foreign('particulier_id')->references('id')->on('particuliers')->onDelete('cascade');
                $table->string('etat')->default('initial');
                $table->timestamps();
            });
        }
    }

    private function createInvestisseursTable()
    {
       if(!Schema::hasTable('investisseurs')){
        Schema::create('investisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('noms');
            $table->string('prenoms')->nullable();
            $table->string('sexe')->nullable();
            $table->string('email');
            $table->string('telephone');
            $table->string('ville')->nullable();
            $table->string('pays');
            $table->string('fonction');
            $table->timestamps();
        });
       }
    }
    private function createInvestisseurProjetTable()
    {

       if(!Schema::hasTable('investisseur_projet')){
        Schema::create('investisseur_projet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investisseur_id');
            $table->unsignedBigInteger('projet_id');
            $table->timestamps();

            $table->foreign('investisseur_id')->references('id')->on('investisseurs')->onDelete('cascade');
            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
        });
       }
    }

    private function createRecolteTable(){
        if(!Schema::hasTable('recoltes')){
            Schema::create('recoltes', function (Blueprint $table) {
                $table->id();
                $table->integer('mois');
                $table->integer('jour');
                $table->float('poids_engendre');
                $table->foreignId('saison_culture_id')->constrained('saison_cultures');
                $table->timestamps();
            });
        }
    }

    private function createPortefeuilAgriculteursTable(){
        if(!Schema::hasTable('agriculteurs_portefeuil')){
            Schema::create('agriculteurs_portefeuil', function (Blueprint $table){
                $table->id();
                $table->double('amount')->default(0);
                $table->foreignId('agriculteur_id')->constrained('agriculteurs')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }
    private function createPortefeuilPartTable(){
        if(!Schema::hasTable('particuliers_portefeuil')){
            Schema::create('particuliers_portefeuil', function (Blueprint $table){
                $table->id();
                $table->double('amount')->default(0);
                $table->foreignId('particulier_id')->constrained('particuliers')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function CreatePanierTable(){
        if(!Schema::hasTable('paniers')){
            Schema::create('paniers', function(Blueprint $table){
                $table->id();
                $table->foreignId('particulier_id')->constrained('particuliers')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function CreatePanierItemTable(){
        if(!Schema::hasTable('panier_items')){
            Schema::create('panier_items', function(Blueprint $table){
                $table->id();
                $table->integer('quantite');
                $table->double('prix');
                $table->foreignId('panier_id')->constrained('paniers')->onDelete('cascade');
                $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
                $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade')->nullable();
                $table->timestamps();
            });
        }
    }
}
