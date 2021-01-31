<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('visiteurs')->insert(
            [
                'id' => '1',
                'nom' => 'SEUX',
                'prenom' => 'Julien',
                'login' => 'Login',
                'mdp' => 'Mdp',
                'adresse' => 'Adresse',
                'cp' => 'CP',
                'ville' => 'Ville',
                'dateEmbauche' => '2021-01-01',
            ]);

        DB::table('users')->insert(
            [
                'name'=>'Julien',
                'email'=>'julien.seux69@gmail.com',
                'password'=>bcrypt('azerty'),
                'id_visiteur'=>'1'
            ]
        );

        DB::table('visiteurs')->insert(
            [
                'id' => '2',
                'nom' => 'KANANKE_ACHARIGE',
                'prenom' => 'Sahan',
                'login' => 'Login',
                'mdp' => 'Mdp',
                'adresse' => 'Adresse',
                'cp' => 'CP',
                'ville' => 'Ville',
                'dateEmbauche' => '2021-01-02',
            ]);

        DB::table('users')->insert(
            [
                'name'=>'Sahan',
                'email'=>'email@gmail.com',
                'password'=>bcrypt('azerty'),
                'id_visiteur'=> '2',
            ]);

    }
}
