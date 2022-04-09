<?php
require_once("./model./PdoMusic.php");

$monPdo = PdoMusic::getPdoMusic();

if(!isset($_REQUEST['action']))
{
$action = 'accueil';
}
else {
$action = $_REQUEST['action'];
}
// vue qui crée l’en-tête de la page
include("vues/v_entete.php") ;
switch($action)
{
    case 'accueil':
        // vue qui crée le contenu de la page d’accueil
        include("vues/v_accueuil.php");
        break;
    case 'formulaire':
        // vue qui crée le contenu de la page inscription
        include("vues/v_inscription.php");
        break;
    case 'inscriptionSucced':
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $idCours = $_GET['idCours'];
        try {
            $monPdo->insertStudent($nom,$prenom,$adresse,$mail,$telephone,$idCours);
        } catch (\Throwable $th) {
            throw $th;
        }
        include("vues/v_accueuil.php");
        break;    
    case 'cours':

        $lesCours= $monPdo->getLesCours();
        //var_dump($lesCours);
        include("vues/v_cours.php");

        
        break;
    default:
        include("vues/v_accueuil.php");
        break;
}
// vue qui crée le pied de page
include("vues/v_pied.php") ;
?>