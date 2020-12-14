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
        Schema::create('fichefrais', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("visiteur_id");
            $table->string("mois");
            $table->integer("nbJustificatifs");
            $table->double("montantValide");
            $table->date("dateModif");
            $table->unsignedInteger("etat_id");
            $table->foreign("visiteur_id")
                ->references("id")
                ->on("visiteurs");
            $table->foreign("etat_id")
                ->references("id")
                ->on("etats");
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
