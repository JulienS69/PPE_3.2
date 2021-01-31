<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisiteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visiteurs', function (Blueprint $table) {
            $table->char('id')->primary();
            $table->string("nom");
            $table->string("prenom");
            $table->string("login");
            $table->string("mdp");
            $table->string("adresse");
            $table->string("cp");
            $table->string("ville");
            $table->date("dateembauche");
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
        Schema::dropIfExists('visiteurs');
    }
}
