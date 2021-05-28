<?php

namespace App\Http\Controllers;

use App\Models\Lignefraisforfaits;
use App\Models\Lignefraishorsforfaits;
use Illuminate\Http\Request;

class ModificationFichesFraisHorsForfaitsController extends Controller
{
    // Modification d'une fiche de frais

    public function ModifierFFHF(Request $request){

        $mois = $request->input('mois');
        $date = $request->input('date');

        $RecupFFHF = Lignefraishorsforfaits::addSelect('libelle', 'mois', 'date', 'montant')
            ->where([['mois', $mois], ['date', $date]])
            ->first();

        /*  $getFF = Lignefraisforfaits::addSelect(['visiteur_id as Numéro_du_Visiteur', 'fraisforfaits.libelle as type_de_frais', 'lignefraisforfaits.mois as mois', 'lignefraisforfaits.quantite as Quantite_du_frais_selectionné'])
              ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
              ->join('visiteurs', 'lignefraisforfaits.visiteur_id', '=', 'visiteurs.id')
              ->where('visiteurs.id', $id)
              ->first();
  */
        /*$modifyExpenses = DB::table('ligne_frais_forfaits')
            ->select('mois', 'FraisForfait_id', 'quantite')
            ->where([
                ['mois',$mois],
            ])
            ->get();*/
        return view('ModificationFicheFraisHorsForfait',compact('RecupFFHF'));

    }

    //Application des modifications de la fiche

    public function Verification_ModificationFFHF(Request $request){
        $mois = $request->input('mois');
        $libelle = $request->input('libelle');
        $date = $request->input('date');
        $montant = $request->input('montant');


        Lignefraishorsforfaits::where([['mois', $mois], ['date', $date]])
            ->update(['montant'=> $montant]);

        /*DB::table('ligne_frais_forfaits')
            ->where([
                ['mois', $mois],
                ['FraisForfait_id', $type]
            ])
            ->update(
                [
                    'quantite' => $newqte
                ]);*/

        return view('OperationValideModifFicheFraisHF');
    }
}
