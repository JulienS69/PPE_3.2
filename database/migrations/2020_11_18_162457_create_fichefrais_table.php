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
            $table->unsignedInteger("visiteur_id");
            $table->date("mois");
            $table->integer("nbJustificatifs");
            $table->double("montantValide");
            $table->date("dateModif");
            $table->unsignedInteger("idEtat");
            $table->foreign("visiteur_id")
                ->references("id")
                ->on("visiteurs");
            $table->foreign("idEtat")
                ->references("id")
                ->on("etats");
            $table->timestamps();
        });

        DB::unprepared("ALTER TABLE `fichefrais` ADD PRIMARY KEY (`visiteur_id`,`mois`)");
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
