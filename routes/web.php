<?php

use App\Http\Controllers\FicheFraisController;
use App\Http\Controllers\FicheFraisHorsForfaitController;
use App\Http\Controllers\FicheFraisOpeReussieController;
use App\Http\Controllers\GenerationPDFController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModificationFichesFraisController;
use App\Http\Controllers\ModificationFichesFraisHorsForfaitsController;
use App\Http\Controllers\TelechargementFicheFraisController;
use App\Http\Controllers\VisualisationFicheFraisController;
use App\Http\Controllers\VisualisationFicheFraisHorsForfaitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Fiche de frais
Route::get('/fichefrais/generation', [FicheFraisController::class, 'index'])->name('fichefrais.index');
Route::post('/fichefrais/ajout', [FicheFraisController::class, 'store']);

//Fiche de frais hors forfait
Route::get('/fichefraishorsforfait/generation', [FicheFraisHorsForfaitController::class, 'index'])->name('fichefraishorsforfait.index');
Route::post('/fichefraishorsforfait/ajout', [FicheFraisHorsForfaitController::class, 'store']);


//Opération Réussie enregistrement fiche de frais.

Route::get('/enregistrementfichefraisreussie/generation', [FicheFraisOpeReussieController::class, 'index'])->name('enregistrementfichefraisreussie.index');

//Visualisation des fiches de frais.

Route::get('/VisualisationFicheFrais/generation', [VisualisationFicheFraisController::class, 'show'])->name('visualisationfichefrais.show');

Route::get('/VisualisationFicheFraisHorsForfait/generation', [VisualisationFicheFraisHorsForfaitController::class, 'show'])->name('visualisationfichefraishorsforfait.show');


// Route pour ce qui concerne la génération du PDF
Route::post('/GénérationPDFFF/generation', [GenerationPDFController::class, 'GenerationPDF'])->name('generation');

// Route pour ce qui concerne la génération du PDF
Route::get('/TelechargementFicheFrais/generation', [GenerationPDFController::class, 'index'])->name('TelechargementFicheFrais.index');

// Modification des fiches de frais
Route::get('/ModificationFicheFrais/modification/', [ModificationFichesFraisController::class, 'ModifierFF'])->name("ModifierFF");

// Modification des fiches de frais Hors Forfaits
Route::get('/ModificationFicheFraisHorsForfaits/modification', [ModificationFichesFraisHorsForfaitsController::class, 'ModifierFFHF'])->name("ModifierFFHF");

//Vérification des modifications des fiches de frais
Route::get('/ModificationFicheFrais/Verification_Modification', [ModificationFichesFraisController::class, 'Verification_Modification'])->name("verrifier_modif");

//Vérification des modifications des fiches de frais hors forfaits
Route::get('/ModificationFicheFraisHorsForfaits/Verification_ModificationFFHF', [ModificationFichesFraisHorsForfaitsController::class, 'Verification_ModificationFFHF'])->name("verrifier_modifFFHF");
