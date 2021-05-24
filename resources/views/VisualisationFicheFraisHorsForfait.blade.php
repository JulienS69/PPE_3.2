@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">
@section('extra-css')

    <link href="{{asset('css/styles.min.css')}}">
    <link rel="icon" href="images/pill.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

    <body>
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
                    <th id="trs-hd" class="col-lg-0">Changement ?</th>
                </tr>

            <!--@if(\PHPUnit\Framework\isEmpty($getFFHF))
                <tr class="warning no-result">
                    <td colspan="12"><i class="fa fa-warning"></i>Aucunes fiches de frais créées</td>
                </tr>
                @endif !-->
                @foreach($getFFHF as $FicheFraisHorsForfait)
                    <tr>
                        <td>{{$FicheFraisHorsForfait->visiteur_id}}</td>
                        <td>{{$FicheFraisHorsForfait->mois}}</td>
                        <td>{{$FicheFraisHorsForfait->libelle}}</td>
                        <td>{{$FicheFraisHorsForfait->date}}</td>
                        <td>{{$FicheFraisHorsForfait->montant}}€</td>
                        <td><button class="btn btn-success" style="margin-left: 5px;" type="submit"><i class="fa fa-check" style="font-size: 15px;"></i></button><button class="btn btn-warning" style="margin-left: 5px;" type="submit"><i class="fa fa-pencil-square-o" style="font-size: 15px;"></i></button></td>
                    </tr>
                    @endforeach
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

