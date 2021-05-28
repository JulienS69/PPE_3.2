<?php

namespace App\Http\Controllers;

use App\Models\fichefrais;
use App\Models\fraisforfaits;
use App\Models\lignefraisforfaits;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

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
        $id = new fraisforfaits();
        if ($request->input('option') == 'Selectionner une option') {
            return back()->with('fail', 'Impossible de prendre cette option');
        }
        if ($request->input('option') == 'Forfait Etape') {
            $id = 1;
        } elseif ($request->input('option') == 'Nuitée') {
            $id = 2;
        } elseif ($request->input('option') == 'Repas') {
            $id = 3;
        } else {
            $id = 4;
        };
        $cfff = new lignefraisforfaits();
        $cfff->visiteur_id = Auth::user()->id;
        $cfff->mois = $request->mois;
        $cfff->quantite = $request->quantite;
        $cfff->fraisforfaits_id = $id;
        // Permet de gerer les erreurs SQL
        try {
            $save = $cfff->save();
            return view('OperationValideFicheFrais');
        }
        // Si une erreur SQL est capturé alors une erreur est retourné sous forme de text.
        catch (Exception $e) {
            return back()->with('fail', 'Impossible de choisir le même type de frais pour un même mois');
        }
    }
}
