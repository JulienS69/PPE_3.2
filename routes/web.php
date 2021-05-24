<?php

use App\Http\Controllers\FicheFraisController;
use App\Http\Controllers\FicheFraisHorsForfaitController;
use App\Http\Controllers\FicheFraisOpeReussieController;
use App\Http\Controllers\HomeController;
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
