@extends('Templates/template')

@section('titrePage')
    Information Visiteur
@endsection

@section('titreItem')
    <h1>Information du Visiteur</h1>
@endsection

@section('contenu')
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>prenom</th>
            <th>login</th>
            <th>adresse</th>
            <th>CP</th>
            <th>ville</th>
            <th>DateEmbauche</th>
        </tr>
        </thead>
        @foreach($lesVisiteurs as $unVisiteur)
            <tr>
                <td>{{$unVisiteur->id}}</td>
                <td>{{$unVisiteur->nom}}</td>
                <td>{{$unVisiteur->prenom}}</td>
                <td>{{$unVisiteur->login}}</td>
                <td>{{$unVisiteur->adresse}}</td>
                <td>{{$unVisiteur->CP}}</td>
                <td>{{$unVisiteur->ville}}</td>
                <td>{{$unVisiteur->DateEmbauche}}</td>
            </tr>
        @endforeach
    </table>
