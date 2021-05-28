<!-- Vue permettant la création d'une fiche de frais hors forfait -->

@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">
@section('extra-css')

    <link href="{{asset('css/cffhf.css')}}" @endsection @section('content') <div class="container">

    <div class="form-row" style="margin-top: 15px;">
        <div class="col">
            <h1 style="font-size: 25px;font-family: 'Lobster Two', cursive, sans-serif;text-align: center;margin-left: 15%;">
                Création d'une Fiche de Frais Hors Forfait</h1>
        </div>
    </div>

    <form class="align-content-center" id="contactForm" action="/fichefraishorsforfait/ajout" method="post">
        @csrf
        <!-- Label ou est renseigné l'id du visiteur connecté récupérer à l'aide d'une variable créee dans le Controller -->
        <div class="has-feedback form-group mb-3" style="height: 70px;width: 350px;"><label class="form-label" for="from_name" style="font-size: 20px;">Id
                Visiteur</label><input class="form-control" type="text" value="{{$visiteur->visiteur_id}}" style="width: 300px;height: 30px;" readonly=""></div>
            <!-- Type de champs "date" afin de récupérer le jour, le mois et l'année -->
        <div class="has-feedback form-group mb-3" style="width: 350px;"><label class="form-label" for="from_email" style="font-size: 20px;">Date
                d'engagement
            </label><input class="form-control" type="date" name="date"></div>
            <!-- Champs libre ou est demandé d'entrer le motif du frais.-->
        <div class="has-feedback form-group mb-3" style="height: 70px;width: 320px;"><label class="form-label" for="from_name" style="font-size: 20px;">Motif
                de frais</label><input class="form-control" type="text" name="motiffrais"></div>
            <!-- Champs libre ou est demandé d'entrer le montant du frais-->
        <label class="form-label" for="from_email" style="font-size: 20px;margin-bottom: 15px;">Montant du frais<input class="form-control" type="text" placeholder="Ex : 25.00 €" name="montant"></label>
            <!-- Type de champs "month" afin de récupérer le mois et l'année -->
        <div class="has-feedback form-group mb-3" style="width: 350px;"><label class="form-label" for="from_email" style="font-size: 20px;">Mois
                Concerné
            </label><input class="form-control" type="month" name="datengagement"></div>
        <br>
            <!-- Bouton de type submit permettant l'envoi du formulaire dans la base de données.-->
            <button class="btn btn-primary" type="submit" style="text-align: center;margin-top: 25px;margin-left: 0px;">
                Valider la fiche de frais
            </button>

        @endsection


        @section('extra-js')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        @endsection
