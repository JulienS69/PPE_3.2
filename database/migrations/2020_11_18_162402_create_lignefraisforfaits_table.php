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
            $table->char('id')->primary(); //int(11)
            $table->char("visiteur_id");
            $table->string("mois");
            $table->char("frais-forfaits_id");
            $table->integer("quantite")->default(null);
            $table->foreign("visiteur_id")
                ->references("id")
                ->on("visiteurs");
            $table->foreign("frais-forfaits_id")
                ->references("id")
                ->on("fraisforfaits");
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
