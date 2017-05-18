<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = $_REQUEST['action'];
switch ($action) {
    case 'saisirFrais': {
        if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
            $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
        }
        break;
    }
    case 'validerMajFraisForfait': {
        $lesFrais = $_REQUEST['lesFrais'];
        $type_voiture = $_POST['select'];
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
            $pdo->majFicheFrais($idVisiteur, $mois, $type_voiture);
        } else {
            ajouterErreur("Les valeurs des frais doivent être numériques");
            include("vues/v_erreurs.php");
        }
        break;
    }
    case 'validerCreationFrais': {
        $dateFrais = $_REQUEST['dateFrais'];
        $libelle = $_REQUEST['libelle'];
        $montant = $_REQUEST['montant'];

        if (isset($_FILES['fichier'])) {
            $dossier = 'uploads/';
            $fichier = basename($_FILES['fichier']['name']);

            $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

            $fichierrandom = rand_string();

            $type = $_FILES['fichier']['type'];

            if (($type == "application/pdf")) {

                $fichier = $fichierrandom.'.pdf';

                if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    echo 'Upload effectué avec succès !';
                } else //Sinon (la fonction renvoie FALSE).
                {
                    echo 'Echec de l\'upload !';
                }


            } else {
                echo "That is not a pdf document";
            }


        }

        valideInfosFrais($dateFrais, $libelle, $montant);
        if (nbErreurs() != 0) {
            include("vues/v_erreurs.php");
        } else {
            $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $dateFrais, $montant, $fichierrandom);
        }
        break;
    }
    case 'supprimerFrais': {
        $idFrais = $_REQUEST['idFrais'];
        $pdo->supprimerFraisHorsForfait($idFrais);
        break;
    }
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
$lesVoitures = $pdo->getLesFraisVoiture($idVisiteur, $mois);
$fiche = $pdo->getFicheFrais($idVisiteur, $mois);

include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");
