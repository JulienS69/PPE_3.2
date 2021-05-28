<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Fiche de frais</title>
</head>

<body>

<h1 style="text-align: center">Fiche de frais</h1>
<p style="text-align: center;text-decoration: underline">Récapitulatif du mois</p>
<br/>
<p style="text-decoration: underline"><strong>Information sur la fiche de frais</strong></p>

<label>Prénom du visiteur : <strong>{{Auth::user()->name}}</strong></label><br/>

<label>Identifiant : <strong>{{Auth::user()->visiteur_id}}</strong></label>
<br/><br/><br/><br/>

@if(Session::get('fail'))
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Erreur !</h4>
            <p class="mb-0">{{Session::get('fail')}}</p>
        </div>
    @endif

    <Label>Type de frais : <strong>Forfait Etape</strong></Label><br/>
    <label>Quantité sur le mois : <strong>{{$_POST['NbForfaitEtape']}}</strong></label><br/><br/><br/>

    <Label>Type de frais : <strong>Nuits</strong></Label><br/>
    <label>Quantité sur le mois : <strong>{{$_POST['NbNuits']}}</strong></label><br/>
    <label>Montant total du frais : <strong>{{$_POST['Nuits']}} €</strong></label><br/><br/><br/>



    <Label>Type de frais : <strong>Repas</strong></Label><br/>
    <label>Quantité sur le mois : <strong>{{$_POST['nbRepas']}}</strong></label><br/>
    <label>Montant total du frais : <strong>{{$_POST['Repas']}} €</strong></label><br/><br/><br/>



    <Label>Type de frais : <strong>Frais Kilométrique</strong></Label><br/>
    <label>Quantité sur le mois : <strong>{{$_POST['NbKilometres']}} km</strong></label><br/>
    <label>Montant total du frais : <strong>{{$_POST['Kilometrage']}} €</strong></label><br/><br/><br/>




<br>
<br><br>
<p style="text-decoration: underline"><strong>Tarif des Frais</strong></p>
<p><strong>Nuitée : 80,00€/nuit</strong></p>
<p><strong>Repas : 25,00€/repas</strong></p>
<p><strong>Kilomètre : 0.62€/Km</strong></p>

</body>
</html>
