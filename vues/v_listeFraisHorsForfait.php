<table class="listeLegere">
    <caption>Descriptif des éléments hors forfait
    </caption>
    <tr>
        <th class="date">Date</th>
        <th class="libelle">Libellé</th>
        <th class="montant">Montant</th>
        <th class="fichier">Fichier</th>
        <th class="action">&nbsp;</th>
    </tr>

    <?php
    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
        $libelle = $unFraisHorsForfait['libelle'];
        $date = $unFraisHorsForfait['date'];
        $montant = $unFraisHorsForfait['montant'];
        $id = $unFraisHorsForfait['id'];
        $fichier = $unFraisHorsForfait['file_name'];
        ?>
        <tr>
            <td> <?= $date ?></td>
            <td><?= $libelle ?></td>
            <td><?= $montant ?></td>
            <td><?php if($fichier != NULL) {echo '<a href="' . 'uploads/'.  $fichier . '.pdf' . '">Zambla/20</a> ' ; }  ?></td>
            <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?= $id ?>"
                   onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
        </tr>
        <?php

    }
    ?>

</table>
<form action="index.php?uc=gererFrais&action=validerCreationFrais" method="post" enctype="multipart/form-data">
    <div class="corpsForm">

        <fieldset>
            <legend>Nouvel élément hors forfait
            </legend>
            <p>
                <label for="txtDateHF">Date (jj/mm/aaaa): </label>
                <input type="text" class="datepicker" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value=""/>
            </p>
            <p>
                <label for="txtLibelleHF">Libellé</label>
                <input type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value=""/>
            </p>
            <p>
                <label for="txtMontantHF">Montant : </label>
                <input type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value=""/>
            </p>
            <p>

                <input type="file" name="fichier">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            </p>
        </fieldset>
    </div>
    <div class="piedForm">
        <p>
            <input id="ajouter" type="submit" value="Ajouter" size="20"/>
            <input id="effacer" type="reset" value="Effacer" size="20"/>
        </p>
    </div>

</form>
</div>
  

