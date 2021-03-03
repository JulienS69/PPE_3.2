<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use FontLib\Table\Type\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    //retourner les vues
    public function generateExpenseSheet(){
        return view('VueAjoutFicheFrais');
    }

    public function validAddExpenseSheet(){
        return view('vueVerifAjoutFicheFrais');
    }

    //retourner les ajout a la base de données pour le visiteur connecté

    public function sendDataToDataBase(Request $request){
        //insertion de la ligne de frais "specifique" dans la bdd
        DB::table('ligne_frais_forfaits')
            ->insert([
                'visiteur_id' => $request->visiteur,
                'mois' => $request->mois,
                'FraisForfait_id' => $request->tag,
                'quantite' => $request->amount,
            ]);
        return view('vueVerifAjoutFicheFrais');
    }

    public function sendDataToDataBaseBis(Request $request){
        DB::table('ligne_frais_hors_forfaits')
            ->insert([
                'visiteur_id' => $request->visiteur,
                'mois'=> $request->mois,
                'libelle'=> $request->libelle,
                'date'=> $request->date,
                'montant'=> $request->montant,
            ]);
        return view('vueVerifAjoutFicheFrais');
    }

    //recupération des listes du visiteur connecté

    public function getAllExpenseOfCurrentUser(){
        $User = Auth::user()->visiteur_id;
        $Expenses = DB::table('ligne_frais_forfaits')
            ->select('mois', 'FraisForfait_id', 'quantite')
            ->where('visiteur_id', $User)
            ->get();
        return view('vueListeFicheFrais',compact('Expenses'));
    }

    public function getAllExpenseOfCurrentUserBis(){
        $User = Auth::user()->visiteur_id;
        $ExpensesBis = DB::table('ligne_frais_hors_forfaits')
            ->select('mois', 'libelle', 'date', 'montant')
            ->where('visiteur_id', $User)
            ->get();
        return view('vueListeFicheFraisHF',compact('ExpensesBis'));
    }

    // Modification des lignes de frais

    public function modifyExpenseOfCurrentUser(Request $request){
        $mois = $request->input('moisExpense');
        $modifyExpenses = DB::table('ligne_frais_forfaits')
            ->select('mois', 'FraisForfait_id', 'quantite')
            ->where([
                ['mois',$mois],
            ])
            ->get();
        return view('vueModifFicheFrais',compact('modifyExpenses'));
    }

    public function modifyExpenseOfCurrentUserHF(Request $request){
        $mois = $request->input('moisExpense');
        $date = $request->input('dateExpense');
        $modifyExpenseBis = DB::table('ligne_frais_hors_forfaits')
            ->select('mois', 'libelle', 'date', 'montant')
            ->where([
                ['mois', $mois],
                ['date', $date],
            ])
            ->get();
        return view('vueModifFicheFraisHF',compact('modifyExpenseBis'));
    }

    //Application des modification d'une fiche de frais du visiteur connecté

    public function applyModifyExpenseOfCurrentUser(Request $request){
        $mois = $request->input('moisModif');
        $type = $request->input('typeModif');
        $newqte = $request->input('qteModif');
        DB::table('ligne_frais_forfaits')
            ->where([
                ['mois', $mois],
                ['FraisForfait_id', $type]
            ])
            ->update(
                [
                    'quantite' => $newqte
                ]);
        return view('vueVerifModifFicheFrais');
    }

    public function applyModifyExpenseOfCurrentUserBis(Request $request){
        $mois = $request->input('moisModif');
        $nvxMontant = $request->input('montantmodif');
        $date = $request->input('dateModif');
        DB::table('lignefraishorsforfaits')
            ->where([
                ['mois', $mois],
                ['date', $date]
            ])
            ->update(
                [
                    'montant' => $nvxMontant,
                ]);
        return view('vueVerifModifFicheFrais');
    }

    // Génération du pdf des fiches de frais

    public function getValueToLoadOnPDF(){
        return View('PreDownLoad');
    }



    public function downloadPDF(Request $request){
        $User = Auth::user()->visiteur_id;
        $mois = $request->input('moisFF');
        $Expenses = DB::table('lignefraisforfaits')
            ->select('mois', 'Fraisforfait_id', 'quantite')
            ->where([
                ['visiteur_id', $User],
                ['mois', $mois],
            ])
            ->get();

        $pdf = PDF::loadView("ficheFrais", compact('Expenses'));
        return $pdf->download("fichedefrais-". $mois ."pdf");

    }

}
