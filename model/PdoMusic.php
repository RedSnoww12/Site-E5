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


		require_once("./model/Person.php");
		require_once("./model/Teacher.php");
		require_once("./model/Student.php");
		require_once("./model/Instrument.php");
		require_once("./model/Cours.php");
		
		try {
		
			$LesCours = array();

			$req = "Select person.id as pId, person.nom as pNom, person.prenom as pPrenom, person.adresse as pAdresse, person.telephone as pTel, person.mail as pMail, instrument.nom as iNom, jourDate, nbPlace, cours.id as cId from cours
			INNER JOIN professeur ON cours.idProf = professeur.id
			INNER JOIN person ON professeur.id = person.id
			INNER JOIN instrument ON cours.idInstrument = instrument.id
			WHERE nbPlace>0;";

			//$monPdoMusic = PdoMusic::getPdoMusic();

			//$rs = $monPdoMusic::getMonPdo()->prepare($req) ;

			$rs = self::$monPdo->prepare($req) ;

			$rs->execute() ;

			while ($donnees = $rs->fetch(PDO::FETCH_ASSOC)) {
				$Teacher1 = new Teacher($donnees["pId"],$donnees["pNom"],$donnees["pPrenom"],$donnees["pAdresse"],$donnees["pTel"],$donnees["pMail"]);
				$Instrument1 = new Instrument($donnees["iNom"]);
				$LesCours[$donnees["cId"]] = new Cours($donnees["cId"], $Teacher1, $Instrument1, $donnees["jourDate"], $donnees["nbPlace"]);
			}
			return $LesCours;

		} 
		catch (PDOException $e) {
		
			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}


	}


    
	public   function insertStudent($nom,$prenom,$adresse,$mail,$tel,$idCours,$lesCours){ 

		try {
		
			$req = "insert into bd_zicmu.person (nom,prenom,adresse,mail,telephone) values ('".$nom."','".$prenom."','".$adresse."','".$mail."','".$tel."');";

			//$monPdoMusic = PdoMusic::getPdoMusic();

			//$rs = $monPdoMusic::getMonPdo()->prepare($req) ;

			$rs = self::$monPdo->prepare($req) ;

			$succed=$rs->execute();

			if($succed){
				$lesCours[$idCours]->nbPlaceDebit();
				$newNbPlace = $lesCours[$idCours]->getNbPlace();

				$req = "update bd_zicmu.cours set cours.nbPlace='$newNbPlace' where cours.id='$idCours';";
				$rs = self::$monPdo->prepare($req);

				$succed=$rs->execute() ;
			}
			else{
				throw new Exception("Error lors de l'inserstion du client");
			}

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

			$rs = self::$monPdo->prepare($req) ;

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



			$req = "SELECT person.id, person.nom, person.prenom, person.telephone, person.adresse, person.mail, students.niveau from person
			INNER JOIN students on person.id = students.id";


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

	public function selectStudents(){



		$adherents = [];
		$req = "SELECT person.id, person.nom, person.prenom, person.telephone, person.adresse, person.mail, students.niveau from person
		INNER JOIN students on person.id = students.id";



		$monPdoMusic = PdoMusic::getPdoMusic();

		$requete = $monPdoMusic::getMonPdo()->prepare($req) ;

		$requete->execute();

		while ($donnees = $requete ->fetch(PDO::FETCH_ASSOC)) {

			$adherents[] = new Adherent($donnees["idAdherent"],$donnees["nomAdherent"],$donnees["prenomAdherent"],$donnees["telAdherent"]);
		}



		return $adherents ;
	}

	public function selectCours(){
    

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
    
  
