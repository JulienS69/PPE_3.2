<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteurs extends Model
{
    use HasFactory;

    protected $table = "visiteurs";

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'cp',
        'ville',
        'dateembauche',
    ];
}
