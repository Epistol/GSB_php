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
<script>
    // Default export is a4 paper, portrait, using milimeters for units

    var doc = new jsPDF();

    doc.text(50, 10, 'REMBOURSEMENT DE FRAIS ENGAGES');
    doc.text(10,30, 'Visiteur');
    doc.text(80, 30,  ' <?= $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?> ');
    doc.text(10,40,'Mois');
    doc.text(30,40,'<?=  $mois ?>');
    doc.rect(10, 50, 80, 100);
    doc.canvas.height = 72 * 11;
    doc.canvas.width = 72 * 8.5;
    doc.addHTML("	<?php
	    foreach ($lesFraisForfait as $unFraisForfait) {
	    $libelle = $unFraisForfait['libelle'];
	    ?>
        <th> <?= $libelle ?></th>
	    <?php
		    }
		    ?>", 20,50);
    $( "#target" ).click(function() {
        doc.save('reboursement.pdf');
    });


</script>
