<?php
/**
 * Gestion de l'accueil
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

if ($estConnecte) {
    if ($_SESSION['id2']==1){
    include 'vues/v_accueil.php';
    }
    if ($_SESSION['id2']==2){
    include 'vues/v_accueilcomptable.php';
    }  

}else {
    include 'vues/v_connexion.php';
}

//$_GET / Afficher les données dans l'URL
//$_POST VIA LE FORMULAIRE 
//$_SESSION : stock la donnée dans le serveur pour l'authentification, 
//valeur qui peut etre récupéré dans n'importe quelle page