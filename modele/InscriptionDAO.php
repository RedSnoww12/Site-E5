<?php


 require_once ("modele/class.pdomusic.inc.php"); 
 require_once ("business/Inscription.php");  
 require_once ("business/Seance.php");     
 require_once ("business/Adherent.php");
 
 
Class InscriptionDAO {
    
    
  
 
  public function insertInto(Inscription $inscription) {
      
      
    $req='INSERT INTO inscription(idSeance, idAdherent)
    VALUES(:uneSeance, :unAdherent)';

    $monPdoMusic = PdoMusic::getPdoMusic();

    $requete = $monPdoMusic::getMonPdo()->prepare($req) ;

    $requete->bindValue
    (':uneSeance', $inscription->getSeance()->getIdSeance(),PDO::PARAM_INT);
    $requete->bindValue
    (':unAdherent', $inscription->getAdherent()->getIdAdherent(), PDO::PARAM_INT);
    
    $requete->execute();
    
    }
    function creerInscription($numSeance,$idAdherent) {
    
    try {
            
    $requete="insert into inscription(idSeance,idAdherent) values(".htmlspecialchars($numSeance).",".htmlspecialchars($idAdherent).")"; 
        
      $monPdoMusic = PdoMusic::getPdoMusic(); 
    $rs = $monPdoMusic::getMonPdo()->prepare($requete) ;
    $rs->execute() ;     

    } 

    catch (PDOException $e) {
      
        echo 'Échec lors de la connexion : ' . $e->getMessage();

    }
  


  }   



  public function select(){

    $inscriptions = [];
    $req='SELECT * from inscription I, Adherent A, Seance S where A.IdAdherent = I.IdAdherent and I.idSeance = S.idSeance
    ORDER BY A.idAdherent';


    $monPdoMusic = PdoMusic::getPdoMusic();

    $requete = $monPdoMusic::getMonPdo()->prepare($req) ;
    
    $requete->execute();
    
    while ($donnees = $requete ->fetch(PDO::FETCH_ASSOC)) {
        
      $inscriptions[] = new Inscription($donnees);
    }
    
      
    
    return $inscriptions ;
  }
        
  public function update(Inscription $inscription) {

    $req='
    UPDATE inscription
    SET idSeance = :unIdSeance
    WHERE idAdherent = :unIdAdherent
    ';

    $monPdoMusic = PdoMusic::getPdoMusic();

    $rs = $monPdoMusic::getMonPdo()->prepare($req) ;


    $rs->bindValue(':unIdSeance', $inscription->getSeance()->getIdSeance(),
    PDO::PARAM_INT);
    $rs->bindValue(':unIdAdherent', $inscription->getAdherent()->getIdAdherent(),
    PDO::PARAM_INT);
    
    $rs->execute();
  }
 
  public function delete(Inscription $inscription) {
    
      
    $req='
    DELETE FROM inscription
    WHERE idAdherent = '.$inscription->getAdherent()->getIdAdherent().' and idSeance = '.$inscription->getSeance()->getidSeance()
    ;
    echo $req ;
      $monPdoMusic = PdoMusic::getPdoMusic();
    $rs = $monPdoMusic::getMonPdo()->exec($req);
  }
  
 
 
  public function selectSeancesAdherents(){
      

    $seances = [];
    $req='
    SELECT * from seance '
    ;


    $monPdoMusic = PdoMusic::getPdoMusic();

    $requete = $monPdoMusic::getMonPdo()->prepare($req) ;
    
    $requete->execute();
    
    while ($donnees = $requete ->fetch(PDO::FETCH_ASSOC)) {
    
      $seances[$donnees["idSeance"]] = new Seance($donnees["idSeance"],$donnees["dateSeance"],$donnees["idInstrument"],$donnees["idProf"]);
        
      $idSeance = $donnees["idSeance"] ;
      

          
      $req="
      SELECT * from inscription I, adherent A where I.idSeance= $idSeance and A.idAdherent = I.idAdherent"  ;

      $requete1 = $monPdoMusic::getMonPdo()->prepare($req) ;
      
      $requete1->execute();    



      while ($donnees1 = $requete1 ->fetch(PDO::FETCH_OBJ)) {
          
        $unAdherent = new Adherent($donnees1->idAdherent,$donnees1->nomAdherent,$donnees1->prenomAdherent,$donnees1->telAdherent);
      
        $seances[$donnees["idSeance"]]->ajouterAdherent($unAdherent);

      }
    
    }
    return $seances ;
  
  }
 
   public function getInscription($unIdAdherent,$unIdSeance) {
    
     try {
       

$req = "SELECT * from inscription I, Adherent A, Seance S where A.IdAdherent = $unIdAdherent and I.idSeance = $unIdSeance and A.idAdherent = I.IdAdherent and S.idSeance = I.idSeance
ORDER BY A.idAdherent"
;



$monPdoMusic = PdoMusic::getPdoMusic();

$rs = $monPdoMusic::getMonPdo()->prepare($req) ;


$rs->execute() ;

$donnees = $rs ->fetch(PDO::FETCH_ASSOC) ;

$uneInscription = new Inscription($donnees) ;

return $uneInscription;

} 
catch (PDOException $e) {
   
    echo 'Échec lors de la connexion : ' . $e->getMessage();

}


    }  
 

 }
    
      
  