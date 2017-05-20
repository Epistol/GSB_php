<?php
session_start();
ini_set('display_errors', 'on');
error_reporting(E_ALL);
require_once("include/fct.inc.php");

require_once("include/class.pdogsb.inc.php");
include("vues/v_entete.php");
define("ROOT", __DIR__ ."/");

function rand_string() {
	return md5(uniqid(mt_rand(), true));
}


$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if (!isset($_REQUEST['uc']) || !$estConnecte) {
	$_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
switch ($uc) {
	case 'connexion': {
		include("controleurs/c_connexion.php");
		break;
	}
	case 'gererFrais' : {
		include("controleurs/c_gererFrais.php");
		break;
	}
	case 'etatFrais' : {
		include("controleurs/c_etatFrais.php");
		break;
	}
}
include("vues/v_pied.php");


