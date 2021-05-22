<?php

namespace App\Http\Controllers;

use App\Models\fichefrais;
use App\Models\fraisforfaits;
use App\Models\lignefraisforfaits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheFraisController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;
        $visiteur = User::where('name', $name)->first();
        return view('CreationFicheFrais', compact('visiteur'));
    }

    public function store(Request $request)
    {
        $cff = new fraisforfaits();
        if ($request->input('option') == 'Nuitee') {
            $cff->libelle = 'Nuitée';
        } elseif ($request->input('option') == 'Repas') {
            $cff->libelle= 'Repas';
        } else {
            $cff->libelle= 'Kilométrage';
        }
        $cff->save();
        $cfff = new lignefraisforfaits();
        $cfff->visiteur_id = Auth::user()->id;
        $cfff->mois = $request->mois;
        $cfff->quantite = $request->quantite;
        $cfff->fraisforfaits_id = $cff->id;
        $cfff->save();

            //return view('');
    }

}
