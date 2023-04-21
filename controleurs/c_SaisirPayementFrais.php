<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {

    case 'SaisirPayement':
        $visiteur = $pdo->GetFicheVisiteur();
        $moisVisiteur = $pdo->getLesMoisVisiteur();

        include 'vues/v_saisirlespayement.php';
        break;

    case 'FicheForfait':

        $levisiteur = $_POST['visiteur'];
        $lemois = $_POST['mois'];

        $_SESSION['user'] = $levisiteur;
        $_SESSION['mois'] = $lemois;
        
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, $lemois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, $lemois);
        $etat = $pdo->getEtatFiche($levisiteur, $lemois);


        include 'vues/v_FraisForfait.php';

        break;

    case 'modifierstatut':

        $levisiteur =  $_SESSION['user'];
        $lemois = $_SESSION['mois'];
        $pdo->majEtatFicheFrais($levisiteur, $lemois, "MP");
        include 'vues/v_modifierstatut.php';
        break;

    case 'rembourse':
        $levisiteur =  $_SESSION['user'];
        $lemois = $_SESSION['mois'];
        $pdo->majEtatFicheFrais($levisiteur, $lemois, "RB");
        include 'vues/v_fraisrembourse.php';
        break;
}
