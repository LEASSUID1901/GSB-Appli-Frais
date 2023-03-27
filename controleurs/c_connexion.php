<?php
/**
 * Gestion de la connexion
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
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';
    break;
case 'valideConnexion':
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);//Stock la variable login récuperer dans le formulaire
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING); //Stock la variable mdp récuperer dans le formulaire 
    $visiteur = $pdo->getInfosVisiteur($login, $mdp,); //Verifier que tous correspond à la base de donnée
    if (!is_array($visiteur)) { // Si ca ne correspond pas
        ajouterErreur('Login ou mot de passe incorrect');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
    } else {
        $id = $visiteur['id'];
        $nom = $visiteur['nom'];
        $prenom = $visiteur['prenom'];
        $type= $visiteur['nom2'];
        $id2= $visiteur['id2'];
        connecter($id, $nom, $prenom, $type,$id2); //permet de stocker dans une variable $session les info du visiteur
        header('Location: index.php');//header fonction qui nous permet de charger la page
    }
    break;
default:
    include 'vues/v_connexion.php';
    break;
}
