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
       $getFF = Lignefraisforfaits::where('visiteur_id', $id)->get();
       return view('VisualisationFicheFrais', compact('getFF'));
   }

}
