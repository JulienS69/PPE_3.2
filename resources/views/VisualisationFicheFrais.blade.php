<!-- Vue qui consiste à afficher toutes les fiches de frais de l'utilisateur connecté-->

@extends('layouts/app')
<link rel="icon" href="{{asset('images/pill.ico')}}">

@section('extra-css')

    <link href="{{asset('css/visualisationfichefrais.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
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
                Consulter ou Modifier des Fiches de Frais</h1>
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
                    <th id="trs-hd" class="col-lg-0">Type de frais</th>
                    <th id="trs-hd" class="col-lg-0">Quantité</th>
                   <!-- <th id="trs-hd" class="col-lg-0">Télécharger la fiche</th> -->
                    <th id="trs-hd" class="col-lg-0">Modification</th>

                </tr>
                <!--@if(\PHPUnit\Framework\isEmpty($getFF))
                    <tr class="warning no-result">
                        <td colspan="12"><i class="fa fa-warning"></i>Aucunes fiches de frais créées</td>
                    </tr>
                @endif !-->

                <!-- Foreach permettant de récupérer la variable définit dans notre controller ($getFF) qui récupère l'intégralité des fiches de frais
                 entrées par le visiteurs précédement et pour chaque colonnes on affiche l'id du visiteur, le mois et la quantité renseigné par l'utilisateur lors
                 de la création de la fiche -->
                <form action="{{route('ModifierFF')}}" method="get">
                @foreach($getFF as $FicheFrais)
                    <tr>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFrais->Numéro_du_Visiteur}}" name="visiteurid" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFrais->mois}}" name="mois" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFrais->type_de_frais}}" name="typefrais" readonly></td>
                        <td><input style="text-align: center" class="form-control" type="text" value="{{$FicheFrais->Quantite_du_frais_selectionné}}" name="quantitefraisselectionne" readonly></td>
                        <td>
                            <a href="{{route('ModifierFF')}}">
                            <button class="btn btn-warning" style="margin-left: 5px;" type="submit" name="button">
                                <i class="fa fa-pencil-square-o" style="font-size: 15px;"></i>
                            </button>
                            </a>
                        </td>
                    </tr>
                      <!--  <form action="{{route('generation')}}" method="post">
                            <td>
                                <button class="btn btn-success" style="margin-left: 5px;" type="submit">
                                    <i class="fas fa-file-download" style="font-size: 15px;"></i></button>
                            </td>
                        </form>
                        -->
                @endforeach
                </form>
                </thead>
            </table>
        </div>
    </div>
    </body>

@endsection
@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src={{asset('js/visuelfiche.js')}}>
@endsection

