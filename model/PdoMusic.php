<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application Ziqmu.
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoMusic qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Sacha
 * @version    1.0
 */

class PdoMusic{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=bd_zicmu';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
        private static $monPdo;
	private static $monPdoMusic=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoMusic::$monPdo = new PDO(PdoMusic::$serveur.';'.PdoMusic::$bdd, PdoMusic::$user, PdoMusic::$mdp); 
		PdoMusic::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoMusic::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoMusic(){
		if(PdoMusic::$monPdoMusic==null){
			PdoMusic::$monPdoMusic= new PdoMusic();
		}
		return PdoMusic::$monPdoMusic;  
	}
        
        public  static function getMonPdo(){
		
		return PdoMusic::$monPdo;  
	}

	/*     
		<?php
		$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (?, ?)");
		$stmt->bindParam(1, $name);
		$stmt->bindParam(2, $value);

		// insertion d'une ligne
		$name = 'one';
		$value = 1;
		$stmt->execute();
	*/

 

	public   function getLesCours(){ 

		try {
		
			$cours = array();

			$req = "Select person.nom, instrument.nom, jourDate, nbPlace from cours
			INNER JOIN professeur ON cours.idProf = professeur.id
			INNER JOIN person ON professeur.id = person.id
			INNER JOIN instrument ON cours.idInstrument = instrument.id;";

			//$monPdoMusic = PdoMusic::getPdoMusic();

			//$rs = $monPdoMusic::getMonPdo()->prepare($req) ;

			$rs = self::$monPdo->prepare($req) ;

			$rs->execute() ;

			$cours = $rs->fetchAll();
			return $cours;

		} 
		catch (PDOException $e) {
		
			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}


	}

}
    
    
    
  
