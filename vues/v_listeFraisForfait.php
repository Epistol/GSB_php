<div id="contenu">
    <h2>Renseigner ma fiche de frais du mois <?= $numMois . "-" . $numAnnee ?></h2>

    <form method="POST" action="index.php?uc=gererFrais&action=validerMajFraisForfait">
        <div class="corpsForm">

            <fieldset>
                <legend>Eléments forfaitisés
                </legend>
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                $idFrais = $unFrais['idfrais'];
                $libelle = $unFrais['libelle'];
                $quantite = $unFrais['quantite'];
                ?>
                <p>
                    <label for="idFrais"><?= $libelle ?></label>
                    <input type="text" id="idFrais" name="lesFrais[<?= $idFrais ?>]" size="10" maxlength="5"
                           value="<?= $quantite ?>">


                    <?php
                    }
                    ?>
                </p>
                <p>
                    <label for="select">Forfait fiscal (voiture)</label>
                    <select name="select">
                        <?php
                        $id_voiture = $fiche[0][6];


                        foreach ($lesVoitures as $voiture) {

                            $idv = $voiture[0];
                            $libellev = $voiture[1];
                            $carbu = $voiture[2];


                            if ($id_voiture == $idv) {
                                $selected = 'selected="selected"';
                            } else {
                                $selected = '';
                            }

                            ?>


                            <option value="<?= $idv ?>" <?= $selected ?> ><?= $libellev . " " . $carbu ?></option>

                            <?php
                        } ?>

                    </select>


                </p>
            </fieldset>
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20"/>
                <input id="annuler" type="reset" value="Effacer" size="20"/>
            </p>
        </div>

    </form>
