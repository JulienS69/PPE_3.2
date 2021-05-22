@extends('layouts/app')

@section('extra-css')

    <link href="{{asset('css/operationreussie.css')}}"

@endsection

@section('content')
    <body>
        <div class="align-content-center">

            <div class="bs-callout bs-callout-success">
                <h4>Opération réussie !</h4>
                <p>La fiche de frais a bien été enregistrée.</p>
            </div>
                <a class="btn btn-primary text-center bg-success bg-gradient border-success shadow-lg" role="button"
               href="{{ url('/home') }}">Revenir à la page d'accueil</a>

        </div>
    </body>
@endsection
