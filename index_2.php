<?php 
     require_once("modele/class.pdomusic.inc.php");
      require_once ("business/Seance.php");     
      require_once ("modele/SeanceDAO.php");
      require_once ("business/Adherent.php");  
      require_once ("modele/AdherentDAO.php");  
      require_once ("business/Inscription.php");
      require_once ("modele/InscriptionDAO.php");  
      
      session_start();
       
 if (!isset($_SESSION["passage"]))  {   
 $_SESSION["passage"] = 1 ;
 
 }
 
 else {
     
   $_SESSION["passage"] = 2 ;  
 }
if ($_SESSION["passage"]==1) {
    
    echo "1er Passage" ;
   
 $uneInscriptionDAO = new InscriptionDAO() ;
 
 $listSeances = $uneInscriptionDAO->selectSeancesAdherents();  
 

$_SESSION["seances"]  = $listSeances ; 

   
}
   
if(!isset($_REQUEST['action']))
{ $action = 'accueil';}
else
{ $action = $_REQUEST['action'];}

//if ($action != "pdfReservation") {
    include("vues/v_entete.php") ;
//}

switch ($action)
{
    
        case 'accueil':
           
            // Inclusion de l'en-t?te
       include("vues/v_accueil.php");
            
         
            
         break ;
            
                case 'voirCours' :
              

$lesCours  = $_SESSION["seances"]  ;       
 include("vues/v_cours.php");
        
      break;
    
     case 'inscrire' :
  
 
    $numero = $_REQUEST['numero'];;
      
    $unAdherentDAO = new AdherentDAO() ;
      
    $lesAdherents =  $unAdherentDAO->select() ;
    
   
       
        include("vues/v_formulaireInscription.php");
        break;
    
    
     case 'validerInscription' :

      require_once ("modele/class.pdomusic.inc.php");
     $choix = $_REQUEST["choix"] ;
         
 $inscription = array();

     
     
     switch($choix) {    
         
        case 1 : 
     

      $unIdSeance = $_REQUEST["numero"] ;
      
      $uneSeanceDAO = new SeanceDAO() ;
      
      $unAdherentDAO = new AdherentDAO() ;
      
       $uneInscriptionDAO = new InscriptionDAO() ;
      
      $listSeances = $_SESSION["seances"] ;
      
    
     $maSeance = $listSeances[$unIdSeance] ;
      
    
$nom =  $_REQUEST["nom"];

$prenom = $_REQUEST["prenom"];

$tel =  $_REQUEST["tel"];
    
   $unAdherent = new Adherent(1,$nom,$prenom,$tel) ;
    
   $unAdherentDAO->creerAdherent($unAdherent) ;
 
   $idAdherent = $unAdherentDAO->getIdAdherent($unAdherent) ;
   
   $unAdherent = $unAdherentDAO->getAdherent($idAdherent) ;
   
   $maSeance->ajouterAdherent($unAdherent) ;
   
   $uneInscriptionDAO->creerInscription($unIdSeance,$idAdherent) ;

 $_SESSION["seances"] = $listSeances;

         
       include("vues/v_confirmeInscription.php");  
       
       break ;
       
        case 2 :
           
        $uneSeanceDAO = new SeanceDAO() ;
             
        $unAdherentDAO = new AdherentDAO() ;
        
     $uneInscriptionDAO = new InscriptionDAO() ;
            
        $idAdherent = $_REQUEST["adherent"] ;
        $unIdSeance = $_REQUEST["numero"] ;  
        
        $listSeances = $_SESSION["seances"] ;
        $maSeance = $listSeances[$unIdSeance] ;
         
     
        
        $unAdherent = $unAdherentDAO->getAdherent($idAdherent) ;
  
  
       $maSeance->ajouterAdherent($unAdherent) ;  
        
   
       $uneInscriptionDAO->creerInscription($unIdSeance,$idAdherent) ;
        
  
         
         $_SESSION["seances"] = $listSeances;
         
         $nom = $unAdherent->getNom();
         
         $prenom = $unAdherent->getPrenom();
         
       include("vues/v_confirmeInscription.php");  
       
       break ;
            
     }
       
         
         break ;
    
    case 'voirInscriptions' :
 
 
            
     $uneIscriptionDAO= new InscriptionDAO() ;
     

    $lesInscriptions = $uneIscriptionDAO->select();
 
         
      include("vues/v_inscriptions.php");
       break;
    
     case 'voirAdherentsSeance' :

      $listSeances = $_SESSION["seances"] ;
         
       include("vues/v_coursAdherents.php");
        break;
    
    
    case 'voirAdherents' :
 
            
       $unIdSeance = $_REQUEST["numero"] ; 
       
       $uneSeanceDAO = new SeanceDAO() ;
      
       $listSeances = $_SESSION["seances"] ;
     
      $maSeance = $listSeances[$unIdSeance] ;
      
    
       
      $lesAdherents = $maSeance->getList() ;
      

      
       include("vues/v_adherents.php");
       break;
    
    case 'pdfInscription' :
 

        
     $uneIscriptionDAO= new InscriptionDAO() ;
        
        $numAdherent= $_REQUEST['numAdherent'];
        
        $numSeance= $_REQUEST['numSeance'];
        
        $inscription =  $uneIscriptionDAO->getInscription($numAdherent, $numSeance);
       
       
        include("vues/pdf_inscription.php");
        
        $res = creerPdfInscription($inscription) ;
        
        
        
        
        break;


case 'suppInscription' :
    
 
            
        $uneSeanceDAO = new SeanceDAO() ;
             
        $unAdherentDAO = new AdherentDAO() ;
        
         
        $numAdherent= $_REQUEST['numAdherent'];
        
        $unIdSeance= $_REQUEST['numSeance'];
            
        $unAdherent = $unAdherentDAO->getAdherent($numAdherent) ;
        
        $listSeances = $_SESSION["seances"] ;
        $maSeance = $listSeances[$unIdSeance] ;
         
    
        $uneIscriptionDAO= new InscriptionDAO() ;
       
        
        $inscription =  $uneIscriptionDAO->getInscription($numAdherent, $unIdSeance);
        
        
       $maSeance->supprimerAdherent($unAdherent) ;
        
      
  
  $uneIscriptionDAO->delete($inscription) ;
  
   
   $lesInscriptions = $uneIscriptionDAO->select();
   
    $lesAdherents = $maSeance->getList() ;
      
    $supp = $_REQUEST['supp'];
    
    if ($supp==1) {
      
         include("vues/v_inscriptions.php");    
    }
    
    else {
   include("vues/v_adherents.php");
    }
    
   
        
        
        break;
    
    
}

include("vues/v_pied.php") ;

    



?>