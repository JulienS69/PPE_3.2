@extends('layouts/app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
<link href="{{asset('css/telechargementpdf.min.css')}}">
<link rel="icon" href="{{asset('images/pill.ico')}}">
@section('content')
    <body>
    <div class="container">
        <div class="form-row" style="margin-top: 15px;">
            <div class="col">
                <h1 style="font-size: 25px;font-family: 'Lobster Two', cursive, sans-serif;text-align: center;margin-left: 15%;">
                    Télécharger des fiches de frais</h1>
            </div>
        </div>
        <form action="{{route('generation')}}" method="post">
            <div class="has-feedback form-group mb-3" style="width: 350px;"><label class="form-label" for="from_email" style="font-size: 20px;">Mois concerné :</label><br>
                <input id="id" type="month" name=moisconcerne>
                @csrf
                <td>
                    <button id="download" class="btn btn-success font-monospace link-light bg-success shadow"
                            type="submit" style="margin-top: 20px;">Télécharger la fiche
                    </button>
                </td>
        </form>
    </div>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="assets/js/script.min.js?h=2726605393a9d5ce6fffbdb1d19f9baa"></script>
    </body>
