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

 //On a besoind de l'id du visiteur pour générer une fiche de frais.
 //On la stock dans la variable idvisiteur issue de la variable
 // du tableau session généré par l'authentification
$idVisiteur = $_SESSION['idVisiteur']; //récuperer les données de la session

//La fonction date renvoie la date du jour
$mois = getMois(date('d/m/Y'));
//fonction substr qui retourne une partie de la chaine de caractère
//Elle va extraireune partie de 0 a 4: Les 2 parametre d'après
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);

//lis 'action' dans l'url (input_get) et le stock dans la variable $action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); 
switch ($action) {
case 'saisirFrais':
    //PDO = requete sql : va donc se connecter à la base de donnée pour voir sil possede fiche de frais
    if ($pdo->estPremierFraisMois($idVisiteur, $mois)) { //S'il trouve une fiche frais
        $pdo->creeNouvellesLignesFrais($idVisiteur, $mois); // Cree
    }
    break;
case 'validerMajFraisForfait':
    $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_SANITIZE_STRING);
    if (lesQteFraisValides($lesFrais)) {
        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
    } else {
        ajouterErreur('Les valeurs des frais doivent être numériques');
        include 'vues/v_erreurs.php';
    }
    break;
case 'validerCreationFrais':
    $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING); //dateFrais récuperer grace à l'attribut name de imput
    $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
    $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
    var_dump($montant);
    valideInfosFrais($dateFrais, $libelle, $montant);
    if (nbErreurs() != 0) {
        include 'vues/v_erreurs.php';
    } else {
        $pdo->creeNouveauFraisHorsForfait(
            $idVisiteur,
            $mois,
            $libelle,
            $dateFrais,
            $montant
        );
    }
    break;
case 'supprimerFrais':
    $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
    $pdo->supprimerFraisHorsForfait($idFrais);
    break;
}
// 1.au click sur la page renseigner la fiche de frais 
// il ya une insertion dans la table lignefraisforfait
//contenant l'id visiteur et le mois en cours avec une quantité à 0
//2. Chez nous on vois qu'on recupère les données inseré
// par défaut à 0 et on construit le formulaire 
// grace à fraisforfait pour construire le formulaire

//Cette fonction va renvoyer un tableau 
// Contenant les élements remboursable pour le visiteur en question 
// Qui est inserer dans la teble ligne forfait lors de l'affichage 
// de la page plus haut
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
require 'vues/v_listeFraisForfait.php';
require 'vues/v_listeFraisHorsForfait.php';
