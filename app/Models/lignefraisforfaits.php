<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignefraisforfaits extends Model
{
    use HasFactory;

    protected $table = "lignefraisforfaits";

    protected $fillable = [
        'visiteur_id',
        'mois',
        'fraisforfaits_id',
        'quantite',
    ];

}
