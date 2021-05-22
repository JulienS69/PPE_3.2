@extends('layouts/app')

@section('extra-css')

    <link href="{{asset('css/cffhf.css')}}"

@endsection

@section('content')
    <div class="container">
        <div class="col" style="text-align: center;">
            <h1 style="font-size: 30px;font-family: Ubuntu, sans-serif;text-align: center;margin-left: 10%;margin-top: 30px;margin-right: 95px;">
                Création d'une fiche de frais hors forfait</h1>
        </div>
        <form class="align-content-center" id="contactForm" action="/fichefraishorsforfait/ajout" method="post">
            @csrf
            <div class="has-feedback form-group mb-3" style="height: 70px;width: 350px;"><label class="form-label"
                                                                                                for="from_name"
                                                                                                style="font-size: 20px;">Id
                    Visiteur</label><input class="form-control" type="text" value="{{$visiteur->visiteur_id}}" style="width: 300px;height: 30px;"
                                           readonly=""></div>

            <div class="has-feedback form-group mb-3" style="width: 350px;"><label class="form-label" for="from_email"
                                                                                   style="font-size: 20px;">Date d'engagement
                    </label><input class="form-control" type="date" name="datengagement"></div>

            <div class="has-feedback form-group mb-3" style="height: 70px;width: 320px;"><label class="form-label"
                                                                                                for="from_name"
                                                                                                style="font-size: 20px;">Motif
                    de frais</label><input class="form-control" type="text" name="motiffrais"></div>

      <label class="form-label" for="from_email"
                                                style="font-size: 20px;margin-bottom: 15px;">Montant du frais<input
                    class="form-control" type="text" placeholder="Ex : 25.00 €" name="montant"></label>
            <br>
        <button class="btn btn-primary" type="submit" style="text-align: center;margin-top: 25px;margin-left: 0px;">
            Valider la fiche de frais
        </button>



@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
