<?php

namespace App\Http\Controllers;

use App\Models\Fichefrais;
use App\Models\Fraisforfaits;
use App\Models\Lignefraisforfaits;
use App\Models\Lignefraishorsforfaits;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use FontLib\Table\Type\post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerationPDFController extends Controller
{
    public function index()
    {
        return view('TelechargementFicheFrais');
    }


    public function GenerationPDF(Request $request)
    {
        /*
        $mois = $request->input('moisconcerne');
        $pdfff = Auth::user()->visiteur_id;
        //$mois = $request->input('moisFF');
        //  $ab = new Lignefraisforfaits();
        //  $option = new Fraisforfaits();
        //   $option ->visiteur_id = Auth::user()->id;
        //  $ab ->id_fichefrais  = $option->id;
        //  $option ->libelle = $request->libelle;
/*
        // Modifier les options avant de générer le PDF.
         PDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 130,
        ]);

        $Generelespdf = LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->where([['visiteur_id', $pdfff], ['mois', $mois]])
            ->get();

        $_POST['Nuits'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->where([['visiteur_id', $pdfff], ['libelle', 'Nuitee']])
            ->sum('quantite')) * 80;

        $_POST['NbNuits'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['libelle', 'Nuitee']])
                ->sum('quantite'));

        $_POST['Repas'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['libelle', 'Repas Restaurant']])
                ->sum('quantite')) * 25;

        $_POST['nbRepas'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->where([['visiteur_id', $pdfff], ['libelle', 'Repas Restaurant']])
            ->sum('quantite'));

        $_POST['Kilometrage'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['libelle', 'Frais Kilometrique']])
                ->sum('quantite')) * 0.62;

        $_POST['NbKilometres'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->where([['visiteur_id', $pdfff], ['libelle', 'Frais Kilometrique']])
            ->sum('quantite'));



        $Generelespdf2 = LigneFraisForfaits::where([['visiteur_id', $pdfff]])->get();//['mois', $mois]])->get();
      //  $donnees = Fichefrais::where([['visiteur_id', 'fraisforfaits_id', $option]])->get();
*/
        $user = Auth::user()->id;
        $pdfff = Auth::user()->visiteur_id;

        $mois = $request->input('moisconcerne');

        if ($mois != null) {

            $lepdf = Lignefraisforfaits::addSelect('fraisforfaits.libelle as libelle', 'quantite')
                ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where('mois', $mois)
                ->get();

            $_POST['NbForfaitEtape'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Forfait Etape']])
                ->sum('quantite'));

            $_POST['Nuits'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                    ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Nuitee']])
                    ->sum('quantite')) * 80;

            $_POST['NbNuits'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Nuitee']])
                ->sum('quantite'));

            $_POST['Repas'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                    ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Repas Restaurant']])
                    ->sum('quantite')) * 25;

            $_POST['nbRepas'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Repas Restaurant']])
                ->sum('quantite'));

            $_POST['Kilometrage'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                    ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Frais Kilometrique']])
                    ->sum('quantite')) * 0.62;

            $_POST['NbKilometres'] = (LigneFraisForfaits::join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
                ->where([['visiteur_id', $pdfff], ['mois', $mois], ['libelle', 'Frais Kilometrique']])
                ->sum('quantite'));
        } else {
            return back()->with('fail', 'Impossible de prendre cette option');
        }

        // L'instance PDF avec une vue : resources/views/posts/show.blade.php
        //$pdf = PDF::loadView('GenerationPDF', compact('Generelespdf'));
        $pdf = PDF::loadView('GenerationPDF', compact('lepdf'));
        // Lancement du téléchargement du fichier PDF
        return $pdf->download("fichefrais" . ".pdf");
    }

    /*
    public function GenerationPDFFFHF(Request $request){
        $user = Auth::user()->id;
        $pdfff = Auth::user()->visiteur_id;

        $mois = $request->input('moisconcerne');

        if ($mois != null) {

            $FFHF = Lignefraishorsforfaits::addSelect('libelle', 'mois', 'date', 'montant')
                ->where(['visiteur_id', $pdfff], ['mois', $mois])
                ->get();

        } else {
            return back()->with('fail', 'Impossible de prendre cette option');
        }

        // L'instance PDF avec une vue : resources/views/posts/show.blade.php
        //$pdf = PDF::loadView('GenerationPDF', compact('Generelespdf'));
        $pdf = PDF::loadView('GenerationPDF', compact('FFHF'));
        // Lancement du téléchargement du fichier PDF
        return $pdf->download("fichefraishorsforfaits" . ".pdf");
    }
    */

    public function show(Request $request)
    {
        $user = Auth::user()->id;
        $mois = $request->input('moisconcerne');

        $lepdf = Lignefraisforfaits::addSelect('fraisforfaits.libelle as libelle', 'quantite')
            ->join('fraisforfaits', 'fraisforfaits.id', '=', 'lignefraisforfaits.fraisforfaits_id')
            ->where(['visiteur_id', $user], ['mois', $mois])
            ->get();
        return view('GenerationPDF', compact('lepdf'));
    }
}
