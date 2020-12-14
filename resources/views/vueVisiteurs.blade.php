@extends('Templates/template')

@section('titrePage')
    Liste des Visiteurs
@endsection

@section('titreItem')
    <h1>Tous les Visiteurs</h1>
@endsection

@section('contenu')
    <table class="table table-bordered table-stiped">
        <thead>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Rue</th>
        <th>CodePostal</th>
        <th>Ville</th>
        <th>DateEmbauche</th>
        </thead>
        @foreach($visiteurs as $visiteur)
            <tr>
                <td> {{$visiteur->id}} </td>
                <td> {{$visiteur->nom}} </td>
                <td> {{$visiteur->prenom}} </td>
                <td> {{$visiteur->login}} </td>
                <td> {{$visiteur->mdp}} </td>
                <td> {{$visiteur->adresse}} </td>
                <td> {{$visiteur->cp}} </td>
                <td> {{$visiteur->ville}} </td>
                <td> {{$visiteur->dateembauche}} </td>
            </tr>
        @endforeach
    </table>
@endsection
