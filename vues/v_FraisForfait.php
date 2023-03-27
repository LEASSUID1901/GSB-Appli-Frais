<?php


?>

<form method="post" action="index.php?uc=SaisirPayement&action=FicheForfait">

    <div class="panel panel-info">
        <div class="panel-heading">Eléments forfaitisés</div>
        <table class="table table-bordered table-responsive">
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {


                    $libelle = $unFraisForfait['libelle']; ?>
                    <th> <?php echo htmlspecialchars($libelle) ?></th>
                <?php
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {

                    $quantite = $unFraisForfait['quantite']; ?>
                    <td class="qteForfait"><?php echo $quantite ?> </td>
                <?php
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach ($lesFraisForfait as $unFraisForfait) {
                    $idFrais = $unFraisForfait['idfrais'];

                    $quantite = $unFraisForfait['quantite']; ?>
                   <?php
                        }
                            ?>
            </tr>
        </table>

       
</form>
</div>

<form method="post" action="index.php?uc=validerFrais&action=modifierhorsforfait">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait - justificatifs reçus</div>
        <table class="table table-bordered table-responsive">
            <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
            </tr>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $date = $unFraisHorsForfait['date'];
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $montant = $unFraisHorsForfait['montant']; ?>
                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
       
    </div>
    <a href= "index.php?uc=SaisirPayementFrais&action=modifierstatut&visiteur=<?=$levisiteur ?>">
    <button type= "button" class="btn btn-primary">Mettre en paiement </button>
</form>
