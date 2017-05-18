Programme d'actualisation des lignes des tables,
cette mise à jour peut prendre plusieurs minutes...
<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
include("include/fct.inc.php");

/* Modification des paramètres de connexion */

$serveur = 'mysql:host=localhost';
$bdd = 'dbname=201617_gsb_mlebeau';
$user = 'mlebeau';
$mdp = 'Michael_63#';

/* fin paramètres*/

$pdo = new PDO($serveur . ';' . $bdd, $user, $mdp);
$pdo->query("SET CHARACTER SET utf8");

set_time_limit(0);
creationFichesFrais($pdo);
creationFraisForfait($pdo);
creationFraisHorsForfait($pdo);
majFicheFrais($pdo);

?>