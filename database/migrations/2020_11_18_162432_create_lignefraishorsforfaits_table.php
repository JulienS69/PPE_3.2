<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignefraishorsforfaitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignefraishorsforfaits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("visiteur_id");
            $table->string("mois")->nullable();
            $table->string("libelle");
            $table->date("date");
            $table->double("montant");
            $table->foreign("visiteur_id")
                ->references("id")
                ->on("visiteurs");
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
        Schema::dropIfExists('lignefraishorsforfaits');
    }
}
