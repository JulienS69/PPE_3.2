<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visiteur extends Model
{
    use HasFactory;
    protected $fillable = ['id','nom', 'prenom', 'login', 'mdp', 'adresse','cp', 'ville', 'dateembauche'];




/**
 * Classe d'accès aux données.
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=gsbfrais';
    private static $user = 'usergsbfrais';
    private static $mdp = 'julienjadesahan';
    private static $monPdo;
    private static $monPdoGsb = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
        PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct()
    {
        PdoGsb::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoGsb()
    {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;
    }

    /**
     * Retourne les informations d'un visiteur
     * @param $login
     * @param $mdp
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosVisiteur($login, $mdp)
    {
        $req = "select visiteurs.id as id, visiteurs.nom as nom, visiteurs.prenom as prenom, visiteurs.idType as type from visiteurs
		where visiteurs.login=:login and visiteurs.mdp=:mdp";
        $res = PdoGSB::$monPdo->prepare($req);
        $res->bindParam(':login', $login);
        $res->bindParam(':mdp', $mdp);
        $res->execute();
        $ligne = $res->fetch();
        return $ligne;
    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
     * concernées par les deux arguments
     * La boucle foreach ne peut être utilisée ici car on procède
     * à une modification de la structure itérée - transformation du champ date-
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
     */
    public function getLesFraisHorsForfait($idVisiteur, $mois)
    {
        $req = "select * from lignefraishorsforfaits where lignefraishorsforfaits.idvisiteur ='$idVisiteur'";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        $nbLignes = count($lesLignes);
        for ($i = 0; $i < $nbLignes; $i++) {
            $date = $lesLignes[$i]['date'];
            $lesLignes[$i]['date'] = dateAnglaisVersFrancais($date);
        }
        return $lesLignes;
    }

    /**
     * Retourne le nombre de justificatif d'un visiteur pour un mois donné
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return le nombre entier de justificatifs
     */
    public function getNbjustificatifs($idVisiteur, $mois)
    {
        $req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetch();
        return $laLigne['nb'];
    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
     * concernées par les deux arguments
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif
     */
    public function getLesFraisForfait($idVisiteur, $mois)
    {
        $req = "select fraisforfaits.id as idfrais, fraisforfaits.libelle as libelle, fraisforfaits.montant as montant,
		lignefraisforfaits.quantite as quantite from lignefraisforfaits inner join fraisforfaits
		on fraisforfaits.id = lignefraisforfaits.idfraisforfait
		where lignefraisforfaits.idvisiteur ='$idVisiteur' and lignefraisforfaits.mois='$mois'
		order by lignefraisforfaits.idfraisforfait";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne tous les id de la table FraisForfait
     * @return un tableau associatif
     */
    public function getLesIdFrais()
    {
        $req = "select fraisforfaits.id as idfrais from fraisforfaits order by fraisforfaits.id";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Met à jour la table ligneFraisForfait
     * Met à jour la table ligneFraisForfait pour un visiteur et
     * un mois donné en enregistrant les nouveaux montants
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
     * @return un tableau associatif
     */
    public function majFraisForfait($idVisiteur, $mois, $lesFrais)
    {
        $lesCles = array_keys($lesFrais);
        foreach ($lesCles as $unIdFrais) {
            $qte = $lesFrais[$unIdFrais];
            $req = "update lignefraisforfaits set lignefraisforfaits.quantite = $qte
			where lignefraisforfaits.idvisiteur = '$idVisiteur' and lignefraisforfaits.mois = '$mois'
			and lignefraisforfaits.idfraisforfait = '$unIdFrais'";
            PdoGsb::$monPdo->exec($req);
        }

    }

    /**
     * met à jour le nombre de justificatifs de la table ficheFrais
     * pour le mois et le visiteur concerné
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     */
    public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs)
    {
        $req = "update fichefrais set nbjustificatifs = $nbJustificatifs
		where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
        PdoGsb::$monPdo->exec($req);
    }

    /**
     * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return vrai ou faux
     */
    public function estPremierFraisMois($idVisiteur, $mois)
    {
        $ok = false;
        $req = "select count(*) as nblignesfrais from fichefrais
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetch();
        if ($laLigne['nblignesfrais'] == 0) {
            $ok = true;
        }
        return $ok;
    }

    /**
     * Retourne le dernier mois en cours d'un visiteur
     * @param $idVisiteur
     * @return le mois sous la forme aaaamm
     */
    public function dernierMoisSaisi($idVisiteur)
    {
        $req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetch();
        $dernierMois = $laLigne['dernierMois'];
        return $dernierMois;
    }

    /**
     * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
     * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
     * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     */
    public function creeNouvellesLignesFrais($idVisiteur, $mois)
    {
        $dernierMois = $this->dernierMoisSaisi($idVisiteur);
        $laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur, $dernierMois);
        if ($laDerniereFiche['idEtat'] == 'CR') {
            $this->majEtatFicheFrais($idVisiteur, $dernierMois, 'CL');

        }
        $req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat)
		values('$idVisiteur','$mois',0,0,now(),'CR')";
        PdoGsb::$monPdo->exec($req);
        $lesIdFrais = $this->getLesIdFrais();
        foreach ($lesIdFrais as $uneLigneIdFrais) {
            $unIdFrais = $uneLigneIdFrais['idfrais'];
            $req = "insert into lignefraisforfaits(idvisiteur,mois,idFraisForfait,quantite)
			values('$idVisiteur','$mois','$unIdFrais',0)";
            PdoGsb::$monPdo->exec($req);
        }
    }

    /**
     * Crée un nouveau frais hors forfait pour un visiteur un mois donné
     * à partir des informations fournies en paramètre
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @param $libelle : le libelle du frais
     * @param $date : la date du frais au format français jj//mm/aaaa
     * @param $montant : le montant
     */
    public function creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant)
    {
        $dateFr = dateFrancaisVersAnglais($date);
        $req = "insert into lignefraishorsforfaits
		values('','$idVisiteur','$mois','$libelle','$dateFr','$montant')";
        PdoGsb::$monPdo->exec($req);
    }

    /**
     * Supprime le frais hors forfait dont l'id est passé en argument
     * @param $idFrais
     */
    public function supprimerFraisHorsForfait($idFrais)
    {
        $req = "delete from lignefraishorsforfaits where lignefraishorsforfaits.id =$idFrais ";
        PdoGsb::$monPdo->exec($req);
    }

    /**
     * Retourne les mois pour lesquel un visiteur a une fiche de frais
     * @param $idVisiteur
     * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
     */
    public function getLesMoisDisponibles($idVisiteur)
    {
        $req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur'
		order by fichefrais.mois desc ";
        $res = PdoGsb::$monPdo->query($req);
        $lesMois = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois["$mois"] = array(
                "mois" => "$mois",
                "numAnnee" => "$numAnnee",
                "numMois" => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;
    }


    /**
     * Retourne l'id de tous les visiteurs qui possèdent une fiche de frais
     */
    public function getIdLesVisiteurs()
    {
        $req = "SELECT idVisiteur FROM fichefrais WHERE idEtat = 'CL' GROUP BY idVisiteur";
        $res = PdoGsb::$monPdo->query($req);
        $lesVisiteurs = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $id = $laLigne['idVisiteur'];
            $lesVisiteurs["$id"] = array(
                "id" => "$id",
            );
            $laLigne = $res->fetch();
        }
        return $lesVisiteurs;
    }


    //Renvoie les mois des fiches que possèdent un visiteur
    public function getFicheLeVisiteur()
    {
        $req = "SELECT mois FROM fichefrais WHERE idEtat = 'CL' GROUP BY mois";
        $res = PdoGsb::$monPdo->query($req);
        $lesMois = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois["$mois"] = array(
                "mois" => "$mois",
                "numAnnee" => "$numAnnee",
                "numMois" => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;

    }


    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
     */
    public function getLesInfosFicheFrais($idVisiteur, $mois)
    {
        $req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs,
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id
			where fichefrais.idVisiteur ='$idVisiteur' and fichefrais.mois = '$mois' and idEtat='VA'";

        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetch();
        return $laLigne;
    }

    /**
     * Modifie l'état et la date de modification d'une fiche de frais
     * Modifie le champ idEtat et met la date de modif à aujourd'hui
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     */

    public function majEtatFicheFrais($idVisiteur, $mois, $etat)
    {
        $req = "update ficheFrais set idEtat = '$etat', dateModif = now()
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
        PdoGsb::$monPdo->exec($req);
    }

    /**
     *Recupère les fiches de frais qui sont à l'état valide('VA')
     */

    public function getFicheValide()
    {
        $req = " SELECT fichefrais.idVisiteur as id, visiteurs.nom as nom, visiteurs.prenom as prenom
				FROM fichefrais
				JOIN etats
				ON fichefrais.idEtat=etat.id
				JOIN visiteurs
				ON fichefrais.idVisiteur=visiteurs.id
				WHERE fichefrais.idEtat='VA' ";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    /**
     *Récupère les informations d'une fiche valide et correspondant a l'id de la fiche passée en paramètre (l'idVisiteur en fait)
     * @param idFiche
     */

    public function getInfoFicheValide($idFiche)
    {
        $req = " SELECT idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat
			   FROM ficheFrais
			   WHERE idVisiteur='$idFiche' and idEtat='VA'";
        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }


    /**
     *Récupère les information de la table ligne de frais concernant la fiche passée en paramètre
     * @param idFiche
     */

    public function getInfosFraisParFiche($idFiche)
    {
        $req = " SELECT libelle, montant, quantite
			   FROM lignefraisforfaits l
			   JOIN fraisforfaits f
			   ON l.idFraisForfait=f.id
			   WHERE idVisiteur='$idFiche'";

        $res = PdoGsb::$monPdo->query($req);
        $laLigne = $res->fetchAll();
        return $laLigne;
    }

    /**
     *Passe l'état d'une fiche a Mise en Paiement('MP')
     * @param idFiche    id de la fiche dont on doit changer l'état
     */

    public function MajPaiement($idFiche)
    {
        $req = "UPDATE ficheFrais
		  SET idEtat='MP', dateModif = now()
		  WHERE idVisiteur='$idFiche' AND idEtat='VA'";
        PdoGsb::$monPdo->exec($req);

    }


    //Retourne les fiches de forfaits à partir de l'id du visiteur et du mois
    public function retourneFicheforfait($id, $mois)
    {
        $req = "SELECT fichefrais.idVisiteur, fichefrais.mois, libelle, quantite, idFraisForfait FROM lignefraisforfaits
	INNER JOIN fraisforfaits ON lignefraisforfaits.idFraisForfait=fraisforfaits.id
	INNER JOIN fichefrais ON lignefraisforfaits.idVisiteur=fichefrais.idVisiteur
	WHERE fichefrais.idVisiteur='$id' AND fichefrais.mois='$mois' AND lignefraisforfaits.mois='$mois' AND idEtat='CL'";
        $res = PdoGsb::$monPdo->query($req);
        $lesFraisForfait = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $quantite = $laLigne['quantite'];
            $libelle = $laLigne['libelle'];
            $idVisiteur = $laLigne['idVisiteur'];
            $idFraisForfait = $laLigne['idFraisForfait'];
            $mois = $laLigne['mois'];
            $lesFraisForfait["$libelle"] = array(
                "quantite" => "$quantite",
                "libelle" => "$libelle",
                "idVisiteur" => "$idVisiteur",
                "mois" => "$mois",
                "idFraisForfait" => "$idFraisForfait",
            );
            $laLigne = $res->fetch();
        }
        return $lesFraisForfait;
    }


//Retourne les fiches hors forfait à partir de l'id du visiteur et du mois
    public function retourneFicheHorsforfait($idV, $mois)
    {
        $req = "SELECT id, libelle, montant, date FROM lignefraishorsforfaits
	INNER JOIN fichefrais ON lignefraishorsforfaits.idVisiteur=fichefrais.idVisiteur
	WHERE fichefrais.idVisiteur='$idV' AND fichefrais.mois='$mois' AND lignefraishorsforfaits.mois='$mois' AND idEtat='CL'";
        $res = PdoGsb::$monPdo->query($req);


        $lesFraisHorsForfait = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $libelle = $laLigne['libelle'];
            $montant = $laLigne['montant'];
            $id = $laLigne['id'];
            $date = $laLigne['date'];
            $lesFraisHorsForfait["$libelle"] = array(
                "libelle" => "$libelle",
                "montant" => "$montant",
                "id" => "$id",
                "date" => "$date",
            );
            $laLigne = $res->fetch();
        }
        return $lesFraisHorsForfait;
    }


//Modifie la quantite du frais à partir de la nouvelle quantité donné en paramètre
    public function modifierQteFicheFrais($id, $mois, $idFrais, $nouvQte)
    {
        $req = "UPDATE lignefraisforfaits SET quantite ='$nouvQte'
	  WHERE idVisiteur='$id' AND mois='$mois' AND idFraisForfait='$idFrais'";
        $res = PdoGsb::$monPdo->query($req);

    }

//On ajoute la mention 'REFUSE' devant le libelle de la fiche qu'on reporte
    public function ligneFraisRefuse($id)
    {
        $req = "UPDATE lignefraishorsforfait
	  SET libelle= CONCAT('REFUSE ', libelle) WHERE id='$id'";
        $res = PdoGsb::$monPdo->query($req);

    }


//Permet de vérifier si la fiche hors forfait n'a pas été payé avant le 10 du mois
//Retourne 1 si le délai est dépassé
    public function reportNonFacture($id)
    {
        $req = " SELECT COUNT(*) FROM lignefraishorsforfait WHERE id='$id' AND DAY(date)>=10";
        $res = PdoGsb::$monPdo->query($req);
        $ligne = $res->fetchColumn();

        return $ligne;

    }


//Reporte la fiche hors forfait au mois suivant
    public function ajoutHorsForfaitMoisSuivant($idV, $mois, $libelle, $dateComplete, $montant)
    {
        $req = " INSERT INTO lignefraishorsforfait (idVisiteur, mois, libelle, date, montant) VALUES ('$idV', '$mois', '$libelle', '$dateComplete' , '$montant')";
        $res = PdoGsb::$monPdo->query($req);


    }

//Supprime la fiche hors forfait
    public function supprimFraisRepousse($id)
    {
        $req = "DELETE FROM lignefraishorsforfait
	  WHERE id= $id";
        $res = PdoGsb::$monPdo->query($req);

    }

//Renvoie 1 si une fiche pour le mois suivant existe déja, sinon 0
    public function verifMoisSuivExiste($idV, $mois)
    {
        $req = " SELECT COUNT(*) FROM fichefrais WHERE idVisiteur ='$idV' AND mois='$mois'";
        $res = PdoGsb::$monPdo->query($req);
        $nb = $res->rowCount();

        return $nb;
    }


//Creer une fiche de frais pour le mois suivant
    public function creerFicheMoisSuiv($idV, $mois)
    {
        $req = "INSERT INTO fichefrais VALUES('$idV', '$mois', 0, 0, CURDATE(), 'CR')";
        $res = PdoGsb::$monPdo->query($req);
    }


//Valide la fiche
    public function valideFiche($idV, $mois)
    {
        $req = "UPDATE fichefrais
	   SET dateModif= (SELECT CURDATE()), idEtat='VA'
	   WHERE idVisiteur='$idV' AND mois='$mois'";
        $res = PdoGsb::$monPdo->query($req);
    }


    public function moisParVis($idv)
    {
        $req = "SELECT mois FROM fichefrais WHERE idVisiteur='$idv' AND idEtat='CL'";
        $res = PdoGsb::$monPdo->query($req);
        $lesMoisDuVis = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $mois = $laLigne['mois'];
            $lesMoisDuVis["$mois"] = array(
                "mois" => "$mois",
            );
            $laLigne = $res->fetch();
        }
        return $lesMoisDuVis;
    }


}


