<?php


 require_once ("modele/class.pdomusic.inc.php");
     
 require_once ("business/Adherent.php"); 

 
    Class AdherentDAO {
    
    
   
    
    
    
        public function creerAdherent($unAdherent)  {
            
        
            try {


                $req="insert into adherent(idAdherent,nomAdherent,prenomAdherent,telAdherent) values(null,'".htmlspecialchars($unAdherent->getNom())."','".htmlspecialchars($unAdherent->getPrenom())."','".htmlspecialchars($unAdherent->getTel())."')"; 


                $monPdoMusic = PdoMusic::getPdoMusic();


                $rs = $monPdoMusic::getMonPdo()->prepare($req) ;


                $rs->execute() ;



            } 
            catch (PDOException $e) {

                echo 'Échec lors de la connexion : ' . $e->getMessage();

            }


        }
        
        
        public function getIdAdherent($unAdherent) {



            try {

                $nom =    $unAdherent->getNom() ;
                $prenom =    $unAdherent->getPrenom() ;
                $tel =    $unAdherent->getTel() ;       

                $req = "SELECT idAdherent from Adherent where nomAdherent = '$nom' and prenomAdherent = '$prenom' and telAdherent = '$tel'  " ;

                echo $req ;

                $monPdoMusic = PdoMusic::getPdoMusic();

                $rs = $monPdoMusic::getMonPdo()->prepare($req) ;

                $rs->setFetchMode(PDO::FETCH_OBJ);

                $rs->execute() ;

                $monAdherent = $rs->fetch();


                return $monAdherent->idAdherent;

            } 
            catch (PDOException $e) {

                echo 'Échec lors de la connexion : ' . $e->getMessage();

            }


        }

        public function getAdherent($unIdAdherent) {



            try {



                $req = "SELECT nomAdherent, prenomAdherent,telAdherent from Adherent where idAdherent = $unIdAdherent" ;



                $monPdoMusic = PdoMusic::getPdoMusic();

                $rs = $monPdoMusic::getMonPdo()->prepare($req) ;

                $rs->setFetchMode(PDO::FETCH_OBJ);

                $rs->execute() ;

                $monAdherent = $rs->fetch();

                $unAdherent = new Adherent($unIdAdherent,$monAdherent->nomAdherent,$monAdherent->prenomAdherent,$monAdherent->telAdherent ) ;

                return $unAdherent;

            } 
            catch (PDOException $e) {

                echo 'Échec lors de la connexion : ' . $e->getMessage();

        }


        }  

        public function select(){



            $adherents = [];
            $req='
            SELECT * from adherent'
            ;



            $monPdoMusic = PdoMusic::getPdoMusic();

            $requete = $monPdoMusic::getMonPdo()->prepare($req) ;

            $requete->execute();

            while ($donnees = $requete ->fetch(PDO::FETCH_ASSOC)) {

                $adherents[] = new Adherent($donnees["idAdherent"],$donnees["nomAdherent"],$donnees["prenomAdherent"],$donnees["telAdherent"]);
            }



            return $adherents ;
        }
        
    }
    
    
    
    
