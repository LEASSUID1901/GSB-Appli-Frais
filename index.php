<?php
/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php'; // empecher que le require se repete
require_once 'includes/class.pdogsb.inc.php';
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
require 'vues/v_entete.php';
if ($estConnecte) {
    // Entete specifique pour les visiteurs ou comptable
    include 'vues/v_enteteConnecte.php';
}

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING); //Lire 'uc' dans l'URL'
// Je pars dans la page connexion dans un cas :
// si 'uc' existe et que je ne suis pas connecté
if ($uc && !$estConnecte) {
    $uc = 'connexion'; 
// Je suis connecté mais 'uc' est vide (Pas d'apparition dans L'Url)
} elseif (empty($uc)) {
    $uc = 'accueil';
}
switch ($uc) { //switch=if
case 'connexion':
    include 'controleurs/c_connexion.php';
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
case 'SaisirPayementFrais':
include 'controleurs/c_SaisirPayementFrais.php';
    break;
}
require 'vues/v_pied.php';
// comme include pour récuperer le header seulement 'require' arrete le programme entierement  