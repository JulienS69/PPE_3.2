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
        Schema::create('lignefraisforfaits', function (Blueprint $table) {
            $table->increments('id'); //int(11)
            $table->unsignedInteger("visiteur_id");
            $table->string("mois");
            $table->unsignedInteger("fraisforfaits_id");
            $table->integer("quantite");
            $table->foreign("fraisforfaits_id")
                ->references("id")
                ->on("fraisforfaits");
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
        Schema::dropIfExists('ligne_frais_forfaits');
    }
}
