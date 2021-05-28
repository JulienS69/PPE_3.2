@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">
@section('extra-css')

    <link href="{{asset('css/visualisationfichefrais.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="col">
            <h1 style="font-size: 25px;font-family: 'Lobster Two', cursive, sans-serif;text-align: center;margin-left: 15%;">
                Modifier la fiche de frais</h1>
        </div>
    </div>
    <br>
    <div class="col-md-12 search-table-col">
        <div class="table-responsive table table-hover table-bordered results">
            <table class="table table-hover table-bordered" style="align-content: center">
                <thead class="bill-header cs" style="text-align: center; align-content: center">
                <tr>
                    <th id="trs-hd" class="col-lg-0">Mois</th>
                    <th id="trs-hd" class="col-lg-0">Type de frais</th>
                    <th id="trs-hd" class="col-lg-0">Quantité du frais</th>
                    <th id="trs-hd" class="col-lg-0">Valider les modifications</th>
                </tr>
    <form action="{{route('verrifier_modif')}}" method="get" >
        <tr>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$RecupFF->mois}}" name="mois" readonly></td>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$RecupFF->Type_de_Frais}}" name="typefrais" readonly></td>
            <td><input style="text-align: center" class="form-control" type="text" value="{{$RecupFF->quantite}}" name="quantitefraisselectionne"></td>
            <td><button class="btn btn-success" style="margin-left: 5px;" type="submit" value="valider la modification">
                    <i class="fa fa-check" style="font-size: 15px;"></i>
                </button></td>
        </tr>
    </form>
@endsection
