<?php

namespace App\Http\Controllers;

use App\Models\Lignefraisforfaits;
use App\Models\User;
use App\Models\Visiteurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualisationFicheFraisController extends Controller
{

    public function show()
    {
        $id = Auth::user()->visiteur_id;

        $getFF = Lignefraisforfaits::addSelect(['visiteur_id as Numéro_du_Visiteur', 'fraisforfaits.libelle as type_de_frais', 'lignefraisforfaits.mois', 'lignefraisforfaits.quantite as Quantite_du_frais_selectionné'])
            ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->join('visiteurs', 'lignefraisforfaits.visiteur_id', '=', 'visiteurs.id')
            ->where('visiteurs.id', $id)
            ->get();

       return view('VisualisationFicheFrais', compact('getFF'));
   }

}
