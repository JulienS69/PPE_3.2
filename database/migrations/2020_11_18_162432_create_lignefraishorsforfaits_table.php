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
            $table->char('id')->autoIncrement()->primary();
            $table->char("visiteur_id");
            $table->string("mois");
            $table->string("libelle")->default(null);
            $table->date("date")->default(null);
            $table->double("montant")->default(null);
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
