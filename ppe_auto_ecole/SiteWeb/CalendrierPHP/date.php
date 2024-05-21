<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Date {
    // Propriétés
    var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    var $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    // Méthode pour obtenir les événements
    public function getEvents($year){
        try {
            // Connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=autoecole;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparation de la requête avec des paramètres
            $req = $bdd->prepare("SELECT Titre_lecon, Date_lecon, H_debut, H_fin FROM Lecon WHERE YEAR(Date_lecon)=? AND IdM=?");
            // Exécution de la requête avec les valeurs des paramètres
            $req->execute([$year, $_SESSION['IDM']]);

            // Récupération des résultats
            $r = array();
            while($d = $req->fetch(PDO::FETCH_OBJ)){
                $r[strtotime($d->Date_lecon)][$d->H_debut][$d->H_fin] = $d->Titre_lecon;
            }

            return $r;
        } catch(PDOException $e) {
            // Gestion des erreurs PDO
            echo "Erreur PDO : " . $e->getMessage();
            return array(); // Retourne un tableau vide en cas d'erreur
        }
    }

    // Méthode pour obtenir tous les jours d'une année
    public function getAll($year){
        $r = array();
        
        $date = new DateTime($year.'-01-01');
        
        while($date->format('Y') <= $year){        
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0', '7', $date->format('w'));
            $r[$y][$m][$d] = $w;
            $date->add(new DateInterval('P1D'));
        }
        return $r;
    }
}

?>

