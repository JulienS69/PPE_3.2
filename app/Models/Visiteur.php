<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visiteur extends Model
{
    use HasFactory;
    protected $fillable = ['id','nom', 'prenom', 'login', 'mdp', 'adresse','cp', 'ville', 'dateembauche'];

}

