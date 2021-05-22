<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('visiteurs')->insert(
            [
                'nom' => 'SEUX',
                'prenom' => 'Julien',
                'adresse' => '10 rue des eaux vives',
                'cp' => '38090',
                'ville' => 'Villefontaine',
                'dateembauche' => '2020-02-19',

            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'jseux',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'visiteur_id' => '1',
            ]
        );

        DB::table('etats')->insert(
            [
                'id' => '1',
                'libelle' => 'Saisie Cloturee',
            ]
        );
        DB::table('etats')->insert(
            [
                'id' => '2',
                'libelle' => 'Fiche creer, saisie en cours',
            ],
        );
        DB::table('etats')->insert(
            [
                'id' => '3',
                'libelle' => 'Renboursee',
            ]
        );
        DB::table('etats')->insert(
            [
                'id' => '4',
                'libelle' => 'Validee et mise en paiment',
            ]
        );

    }
}
