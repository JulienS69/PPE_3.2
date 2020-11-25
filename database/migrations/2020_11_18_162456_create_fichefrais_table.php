<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichefraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_frais', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("visiteur_id");
            $table->string("mois");
            $table->integer("nbJustificatifs");
            $table->double("montantValide");
            $table->date("dateModif");
            $table->unsignedInteger("etat_id");

            $table->foreign("visiteur_id")
                ->references("id")
                ->on("visiteur");

            $table->foreign("etat_id")
                ->references("id")
                ->on("etat");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichefrais');
    }
}
