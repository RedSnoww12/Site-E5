<?php

   require_once ("modele/class.pdomusic.inc.php");
     
    require_once ("business/Seance.php");


Class SeanceDAO{
    
    public function getSeance($unIdSeance) {
    
 
    
        try {
    

            $req = "Select * from seance where idSeance = $unIdSeance";

            $monPdoMusic = PdoMusic::getPdoMusic();

            $rs = $monPdoMusic::getMonPdo()->prepare($req) ;

            $rs->setFetchMode(PDO::FETCH_OBJ);

            $rs->execute() ;

            $maSeance = $rs->fetch();

            $uneSeance = new Seance($maSeance->idSeance,$maSeance->dateSeance,$maSeance->idInstrument,$maSeance->idProf) ;
            return $uneSeance;

        } 
        catch (PDOException $e) {
        
            echo 'Échec lors de la connexion : ' . $e->getMessage();

        }


    }







    public function select(){
    
        require_once ("modele/class.pdomusic.inc.php"); 
        require_once ("business/Seance.php"); 

        $seances = [];
        $req='SELECT * from seance';
        


        $monPdoMusic = PdoMusic::getPdoMusic();

        $requete = $monPdoMusic::getMonPdo()->prepare($req) ;
        
        $requete->execute();
        
        while ($donnees = $requete ->fetch(PDO::FETCH_ASSOC)) {
            $seances[$donnees["idSeance"]] = new Seance($donnees["idSeance"],$donnees["dateSeance"],$donnees["idInstrument"],$donnees["idProf"]);
        }
        
        
        
        return $seances ;
    }

}


