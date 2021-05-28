<?php

namespace App\Http\Controllers;

use App\Models\Lignefraishorsforfaits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FicheFraisHorsForfaitController extends Controller
{
    public function index()
    {
        $name = Auth::user()->name;
        $visiteur = User::where('name', $name)->first();
        return view('CreationFicheFraisHorsForfait', compact("visiteur"));
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $FicheFHFExiste = false;

       /* $recupdate = Lignefraishorsforfaits::addSelect('visiteur_id', 'date')
            ->where('visiteur_id', $id)
            ->first();
        foreach ($recupdate as $recupunedate){
            //Tester chaque date récupérée pour voir si elle existe déjà
            if ($recupunedate[1] = $request->date){
                $FicheFHFExiste = true;
            }
        }
       */
       // if ($FicheFHFExiste != true){
        $cffhf = new Lignefraishorsforfaits();
        $cffhf->visiteur_id = Auth::user()->id;
        $cffhf->date = $request->date;
        $cffhf->libelle = $request->motiffrais;
        $cffhf->montant = $request->montant;
        $cffhf->mois = $request->datengagement;
        $cffhf->save();
        return view('OperationValideFicheFraisHorsForfaits');
    }

}
