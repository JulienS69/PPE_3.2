<!-- Vue permettant l'affichage d'un message de réussite pour la validation d'une fiche de frais renseigné par un visiteur dans la base de données -->

@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">


@section('extra-css')
    <link href="{{asset('css/operationreussie.css')}}"
@endsection

@section('content')
    <body>
    <div class="container" style="margin-left: 800px; margin-top: 50px">

        <div class="bs-callout bs-callout-success">
            <h4>Opération réussie !</h4>
            <p>La fiche de frais hors forfaits a bien été enregistrée.</p>
        </div>
        <a class="btn btn-primary text-center bg-success bg-gradient border-success shadow-lg" role="button" href="{{ url('/home') }}">Revenir à la page d'accueil</a>

    </div>
    </body>
@endsection
