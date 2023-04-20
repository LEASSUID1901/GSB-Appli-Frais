<?php

/**
 * Gestion des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */




$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'choisirFrais':

        $visiteur = $pdo->GetFicheVisiteur();
        $moisVisiteur = $pdo->getLesMoisVisiteur();

        include 'vues/v_validerFrais.php';
        break;

    case 'detailFiche':
        $levisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $lemois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        //cretaion de session pour stocker les données en session
        $_SESSION['user'] = $levisiteur;
        $_SESSION['mois'] = $lemois;


        if (!$pdo->estPremierFraisMois($levisiteur, $lemois)) {
            $error_message = "aucune fiche de frais n'est disponible pour le visiteur pour ce mois ci";
            //possibilite d'inclure les parametres $levisiteur et $lemois dans le message
            $visiteur = $pdo->GetFicheVisiteur();
            $moisVisiteur = $pdo->getLesMoisVisiteur();
            include 'vues/v_validerFrais.php';
        } else {
            $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $lemois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $lemois);
            include 'vues/v_validerDetail.php';
        }
        break;

    case 'modifierforfait':
        $levisiteur = $_SESSION['user'];
        $lemois = $_SESSION['mois'];
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $lemois);
        $pdo->majFraisForfait($levisiteur, $lemois, $_POST);
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $lemois);
        include 'vues/v_validerDetail.php';
        break;

    case 'supprimerhorsforfait':
        $levisiteur = $_SESSION['user'];
        $lemois = $_SESSION['mois'];
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $lemois);
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $lemois);
        $nb = count($lesFraisHorsForfait);
        echo ("test");
        var_dump($pdo->getDate(2));


        for ($i = 1; $i <= $nb; $i++) {
            if (isset($_POST['id' . $i])) {

                //recuperer la date du jour
                // le cas ou les dates sont superieure a 10 du mois 
                // maj de l'état 
                //appel de la fonction

                $libelle = $pdo->getlibelle($_POST['id' . $i]);
                if (strstr($libelle, 'REFUSE') == false) {
                    $nvlibelle = "REFUSE :" . $libelle;
                    $idl = $_POST['id' . $i];
                    $pdo->majFraisHorsForfait($nvlibelle, $idl);
                    $pdo->getDate($_POST['id' . $i]);
                } else {
                    echo "frais deja supprimé !";
                }
                //$joursFormat = substr($mois['mois'], 6, 2);
                //$moisFormates[$mois['mois']] = array('jours' => $joursFormat,);
            }
        }
        include 'vues/v_validerDetail.php';
        break;

    case 'validerfiche':
        $levisiteur = $_SESSION['user'];
        $lemois = $_SESSION['mois'];
        $pdo->majEtatFicheFrais($levisiteur,  $lemois, "VA"); //Modifie le statut
        include 'vues/v_statutValider.php';
        break;
}
