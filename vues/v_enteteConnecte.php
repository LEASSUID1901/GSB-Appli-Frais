<?php
/**
 * Vue Entête
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
?>
<?php include("v_entete.php"); 
?>
            <div class="header">
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h1>
                            <img src="./images/logo.jpg" class="img-responsive" 
                                 alt="Laboratoire Galaxy-Swiss Bourdin" 
                                 title="Laboratoire Galaxy-Swiss Bourdin">
                        </h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-right" role="tablist">
                            <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                                <a href="index.php">
                                    <span class="glyphicon glyphicon-home"></span>
                                    Accueil
                                </a>
                            </li>
                            <?php
                            if ($_SESSION['id2']==2) {
                                 ?>
                            <li <?php if ($uc == 'validerFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=validerFrais&action=choisirFrais">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Valider fiche de frais
                                </a>
                            </li>
                            <li <?php if ($uc == 'SaisirPayementFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=SaisirPayementFrais&action=SaisirPayement">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Saisir payement fiche de frais
                                </a>
                            </li>
                            <?php
                            } 
                            if ($_SESSION['id2']==1) { 
                                ?>
                            <li <?php if ($uc == 'etatFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=gererFrais&action=saisirFrais">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Renseigner la fiche de frais
                                </a>
                            </li>
                            <li <?php if ($uc == 'etatFrais') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    Afficher mes fiches de frais
                                </a>
                            </li>
                            <?php }
                            
                            ?>  
                            <li 
                            <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                                <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    Déconnexion
                                </a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
                            
                        