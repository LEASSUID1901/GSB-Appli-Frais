<?php
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {

case 'SaisirPayement':
        $visiteur = $pdo->GetFicheVisiteur();
        include 'vues/v_saisirlespayement.php';
        break;

    case 'FicheForfait':

        $levisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $lesFraisForfait = $pdo->getLesFraisForfait($levisiteur, "202212");
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($levisiteur, "202212");
        include 'vues/v_FraisForfait.php';
        break;

    case 'modifierstatut':
        $levisiteur = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        $pdo-> majEtatFicheFrais($levisiteur,"202212","MP");
        include 'vues/v_modifierstatut.php';
}