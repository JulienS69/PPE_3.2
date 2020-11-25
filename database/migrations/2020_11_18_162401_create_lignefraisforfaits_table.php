<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignefraisforfaitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_frais_forfaits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("visiteur_id");
            $table->string("mois");
            $table->unsignedInteger("frais_forfaits_id");
            $table->integer("quantité");

            $table->foreign("frais_forfaits_id")
                ->references("id")
                ->on("frais_forfaits");

            $table->foreign("visiteur_id")
                ->references("id")
                ->on("visiteur");

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
        Schema::dropIfExists('lignefraisforfaits');
    }
}
