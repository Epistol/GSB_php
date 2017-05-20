<div id="aexport">
<h3>Fiche de frais du mois <?= $numMois . "-" . $numAnnee ?> :
</h3>

<button class="button  is-info" id="target">
    Export PDF
</button>
<div class="encadre">
    <p>
        Etat : <?= $libEtat ?> depuis le <?= $dateModif ?> <br> Montant validé : <?= $montantValide ?>

        <?php
        $mois = $_SESSION['mois'];
        $mois = substr_replace($mois, '/', -2, 0);
        ?>

    </p>
    <table class="listeLegere">
        <caption>Eléments forfaitisés</caption>
        <tr>
			<?php
			foreach ($lesFraisForfait as $unFraisForfait) {
				$libelle = $unFraisForfait['libelle'];
				?>
                <th> <?= $libelle ?></th>
				<?php
			}
			?>
            <th>Voiture fiscale</th>
        </tr>
        <tr>
			<?php
			foreach ($lesFraisForfait as $unFraisForfait) {
				$quantite = $unFraisForfait['quantite'];
				?>
                <td class="qteForfait"><?= $quantite[0] ?> </td>
				<?php
			}
			?>

            <td class="qteForfait">
				<?= $nom_voiture[0]['Type_Vehiculecol'];  ?>
            </td>


        </tr>
    </table>
    <table class="listeLegere">
        <caption>Descriptif des éléments hors forfait -<?= $nbJustificatifs ?> justificatifs reçus -
        </caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>
        </tr>
		<?php
		foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
			?>
            <tr>
                <td><?= $date ?></td>
                <td><?= $libelle ?></td>
                <td><?= $montant ?></td>
            </tr>
			<?php
		}
		?>
    </table>
</div>
</div>
</div>

<script>
    // Default export is a4 paper, portrait, using milimeters for units

    var specialElementHandlers = {
        '#editor': function (element,renderer) {
            return true;
        }
    };

    $( "#target" ).click(function() {

        var doc = new jsPDF();
        doc.fromHTML($('#aexport').html(), 1, 1, {
            'width': 170,'elementHandlers': specialElementHandlers
        });
        doc.save('reboursement.pdf');
    });


</script>
