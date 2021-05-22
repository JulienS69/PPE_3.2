<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraisforfaits extends Model
{
    use HasFactory;

    protected $table = 'fraisforfaits';

    protected $fillable = [
      'libelle',
      'montant'
    ];
}
