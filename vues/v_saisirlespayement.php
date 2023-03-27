<h2>Fiches de frais visiteurs </h2>

<h3>Sélectionner un visiteur: </h3>
<form action="index.php?uc=SaisirPayementFrais&action=FicheForfait" method="post" role="form">
    <div class="form-group">
        <select name="visiteur"class="form-select" aria-label="Default select example">
        <?php foreach ($visiteur as $unVisiteur) { ?>
                <option value="<?php echo $unVisiteur['id'] ?>"> <?php echo $unVisiteur['nom']."  ".$unVisiteur['prenom'] ?></option>
            <?php
            }
            ?>
            </option>
        </select>
        <input id="ok" type="submit" value="valider" class="btn btn-success" role="button">
    </div>
    </div>
</form>   