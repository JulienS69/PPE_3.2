<?php

namespace App\Http\Controllers;

use App\Models\Fraisforfaits;
use App\Models\Lignefraisforfaits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModificationFichesFraisController extends Controller
{
    // Modification d'une fiche de frais

    public function ModifierFF(Request $request){

        $mois = $request->input('mois');
     
        $id = Auth::user()->visiteur_id;

        $RecupFF = LigneFraisForfaits::addSelect('fraisforfaits.libelle as Type_de_Frais', 'mois', 'quantite')
            ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->where('mois', $mois)
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
        return view('ModificationFicheFrais',compact('RecupFF'));
    }

    //Application des modifications de la fiche

    public function Verification_Modification(Request $request){
        $mois = $request->input('mois');
        $type = $request->input('typefrais');
        $quantite = $request->input('quantitefraisselectionne');

        $id = Fraisforfaits::addSelect('id')->where('libelle', $type)->first();

        LigneFraisForfaits::where([['mois', $mois], ['fraisforfaits_id' , $id->id]])->update(['quantite' => $quantite]);

        /*DB::table('ligne_frais_forfaits')
            ->where([
                ['mois', $mois],
                ['FraisForfait_id', $type]
            ])
            ->update(
                [
                    'quantite' => $newqte
                ]);*/

        return view('OperationValideModifFicheFrais');
    }
}
