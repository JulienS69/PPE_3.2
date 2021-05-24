@extends('layouts/app')

@section('extra-css')

    <link href="{{asset('css/cff.css')}}">
        <link rel="icon" href="{{asset('images/pill.ico')}}">
@endsection

@section('content')

    <div class="text-center">
        <div class="container text-center">
            <form class="align-content-center" id="contactForm" action="/fichefrais/ajout" method="post">
                @csrf
                <div class="form-row" style="margin-top: 15px;">
                    <div class="col">
                        <h1 style="font-size: 30px;font-family: Ubuntu, sans-serif;text-align: center;margin-left: 15%;">
                            Création d'une Fiche de Frais</h1>
                    </div>
                </div>
                <div class="form-row text-left" style="padding: 0px;margin-top: 25px;">
                    <div class="col-md-6" id="message" style="width: 50px;height: 331px;min-width: 0px;">
                        <div class="form-group has-feedback" style="height: 70px;width: 350px;"><label for="from_name"
                                                                                                       style="font-size: 20px;">Id
                                Visiteur</label><input class="form-control" type="text" style="width: 300px;height: 30px;"
                                                       value="{{$visiteur->visiteur_id}}" readonly=""></div>
                        <div class="form-group has-feedback" style="width: 350px;"><label for="from_email"
                                                                                          style="font-size: 20px;">Mois
                                concerné</label><input class="form-control" name="mois" type="month"></div>
                        <div class="form-group has-feedback" style="height: 70px;width: 320px;"><label for="from_name"
                                                                                                       style="font-size: 20px;">Type
                                de frais</label><select name="option" class="custom-select custom-select-sm d-xl-flex"
                                                        style="width: 300px;height: 30px;">
                                <option value="Selectionner une option">Selectionner une option</option>
                                <option name="Forfait Etape">Forfait Etape</option>
                                <option name="Nuitee">Nuitée</option>
                                <option name="Repas">Repas</option>
                                <option name="Kilometrique">Kilométrage</option>
                            </select></div>
                        <div class="form-group has-feedback"><label for="from_phone" style="font-size: 20px;">Quantité
                                du frais sélectionné<input class="form-control" name="quantite"
                                                           type="number"><br><br></label>
                            <button class="btn btn-primary" type="submit"
                                    style=" text-align: center;margin-top: 0px;margin-left: -260px;">Valider la fiche de frais
                            </button>
                        </div>
                    </div>
@endsection
