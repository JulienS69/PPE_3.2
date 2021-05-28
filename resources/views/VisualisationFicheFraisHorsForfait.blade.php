<!-- Vue qui consiste à afficher toutes les fiches de frais hors forfait de l'utilisateur connecté-->

@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">
@section('extra-css')

    <link href="{{asset('css/styles.min.css')}}">
    <link rel="icon" href="images/pill.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

    <body>
    <div class="form-row" style="margin-top: 15px;">
        <div class="col">
            <h1 style="font-size: 25px;font-family: 'Lobster Two', cursive, sans-serif;text-align: center;margin-left: 15%;">
                Consulter ou Modifier des Fiches de Frais Hors Forfaits</h1>
        </div>
    </div>
    <br>
    <br>
    <div class="col-md-12 search-table-col">
        <div class="table-responsive table table-hover table-bordered results">
            <table class="table table-hover table-bordered" style="align-content: center">
                <thead class="bill-header cs" style="text-align: center; align-content: center">
                <tr>
                    <th id="trs-hd" class="col-lg-0">ID du Visiteur</th>
                    <th id="trs-hd" class="col-lg-0">Mois</th>
                    <th id="trs-hd" class="col-lg-0">Libelle</th>
                    <th id="trs-hd" class="col-lg-0">Date</th>
                    <th id="trs-hd" class="col-lg-0">Montant</th>
                <!--  <th id="trs-hd" class="col-lg-0">Télécharger la fiche</th> -->
                    <th id="trs-hd" class="col-lg-0">Modification</th>
                </tr>

            <!--@if(\PHPUnit\Framework\isEmpty($getFFHF))
                <tr class="warning no-result">
                    <td colspan="12"><i class="fa fa-warning"></i>Aucunes fiches de frais créées</td>
                </tr>
                @endif !-->

                <!-- Foreach permettant de récupérer la variable définit dans notre controller ($getFFHF) qui récupère l'intégralité des fiches de frais hors forfaits
                entrées par le visiteurs précédement et pour chaque colonnes on affiche l'id du visiteur, le mois, le libelle, la date et le montant de la fiches renseigné par l'utilisateur lors
                 de la création de la fiche -->
                <form action="{{route('ModifierFFHF')}}" method="get">
                @foreach($getFFHF as $FicheFraisHorsForfait)
                    <tr>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFraisHorsForfait->visiteur_id}}" name="visiteurid" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFraisHorsForfait->mois}}" name="mois" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFraisHorsForfait->libelle}}" name="libelle" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFraisHorsForfait->date}}" name="date" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFraisHorsForfait->montant}}"€ name="montant" readonly></td>

                        <!--
                        <form action="{{route('generation')}}" method="post">
                            @csrf
                        <td>
                            <button class="btn btn-success" style="margin-left: 5px;" type="submit">
                                <i class="fas fa-file-download" style="font-size: 15px;"></i></button>
                        </td>
                        </form>
                        -->
                           <td> </button><button class="btn btn-warning" style="margin-left: 5px;" type="submit"><i class="fa fa-pencil-square-o" style="font-size: 15px;"></i></button></td>
                    </tr>
                    @endforeach
                </form>
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
    </body>

    @endsection
    @section('extra-js')
        <script src={{asset('js/visuelfiche.js')}}>
    @endsection

