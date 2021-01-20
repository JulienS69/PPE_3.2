@extends('Templates/template')

@section('titrePage')
    Liste des fiches frais
@endsection

@section('titreItem')
    <h1>Toutes les fiches frais</h1>
@endsection

    @section('contenu')
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>idvis</th>
            <th>mois</th>
            <th>nbJustificatifs</th>
            <th>montantValide</th>
            <th>dateModif</th>
            <th>etat id</th>
        </tr>
        </thead>
    @foreach($fichefrais as $fichefrai)
            <tr>
                <td>{{$fichefrai->id}}</td>
                <td>{{$fichefrai->visiteur_id}}</td>
                <td>{{$fichefrai->mois}}</td>
                <td>{{$fichefrai->nbJustificatifs}}</td>
                <td>{{$fichefrai->montantValide}}</td>
                <td>{{$fichefrai->dateModif}}</td>
                <td>{{$fichefrai->etat_id}}</td>
            </tr>
    @endforeach
</table>
