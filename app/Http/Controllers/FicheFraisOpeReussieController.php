<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FicheFraisOpeReussieController extends Controller
{
    public function index()
    {
        return view('OperationValideFicheFrais');
    }
}
