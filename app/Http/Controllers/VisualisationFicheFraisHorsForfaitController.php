<?php

namespace App\Http\Controllers;

use App\Models\Lignefraishorsforfaits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualisationFicheFraisHorsForfaitController extends Controller
{
    public function show()
    {
        $id = Auth::user()->visiteur_id;
        $getFFHF = Lignefraishorsforfaits::where('visiteur_id', $id)->get();
        return view('VisualisationFicheFraisHorsForfait', compact('getFFHF'));
    }
}
