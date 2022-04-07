<?php 


if(!isset($_REQUEST['action']))
{ 
    $action = 'accueil';

}
else
{ 
    
    $action = $_REQUEST['action'];
    
    
}
include("vues/v_entete.php") ;

 require_once ("modele/class.pdomusic.inc.php");

$monPdoMusic = PdoMusic::getPdoMusic();
switch ($action)
{
    
        case 'accueil':
           
            // Inclusion de l'entête
       include("vues/v_accueil.php");
            
    
            
         break ;
            
             case 'voirCours' :   
               
   $lesSeances = $monPdoMusic->getLesSeances() ;
                    
               
        
   include("vues/v_seances.php");
        
      break;
    
   case 'inscrire' :
  
         
        require_once ("modele/class.pdomusic.inc.php");
      
        
        $numero = $_REQUEST['numero'];;
        
     
        
      
       
        include("vues/v_formulaireInscription.php");
        break;  
    
    case 'voirInscriptions' :
     
      
      
        include("vues/v_inscriptions.php");
        break;
    
        default :  include("vues/v_accueil.php");
        break ;
}

include("vues/v_pied.php") ;

?>