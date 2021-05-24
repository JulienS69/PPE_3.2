<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignefraishorsforfaits extends Model
{
    use HasFactory;

    protected $table = "lignefraishorsforfaits";

    protected $fillable = [
        'visiteur_id',
        'libelle',
        'date',
        'montant',
    ];
}
