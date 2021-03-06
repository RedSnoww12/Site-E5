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
	
	public function getIdPerson($nom,$prenom,$tel) {



		try {

			// $nom =    $unStudent->getNom() ;
			// $prenom =    $unStudent->getPrenom() ;
			// $tel =    $unStudent->getTel() ;       

			$req = "SELECT id from bd_zicmu.person
			where person.nom ='$nom' and person.prenom ='$prenom' and person.telephone='$tel';" ;

			$rs = self::$monPdo->prepare($req) ;

			$rs->setFetchMode(PDO::FETCH_OBJ);

			$rs->execute() ;

			$monIdPerson = $rs->fetch();

			return $monIdPerson->id;

		} 
		catch(Exception $e){
			echo 'Échec : ' . $e->getMessage();
		}
		catch (PDOException $e) {

			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}


	}
	
	
	
	public function getIdStudent($nom,$prenom,$tel) {



		try {

			// $nom =    $unStudent->getNom() ;
			// $prenom =    $unStudent->getPrenom() ;
			// $tel =    $unStudent->getTel() ;       

			$req = "SELECT students.id from bd_zicmu.students INNER JOIN person on students.id = person.id 
			where person.nom ='$nom' and person.prenom ='$prenom' and person.telephone='$tel';" ;

			$rs = self::$monPdo->prepare($req) ;

			$rs->setFetchMode(PDO::FETCH_OBJ);

			$rs->execute() ;

			$monIdStudent = $rs->fetch();

			return $monIdStudent->id;

		} 
		catch(Exception $e){
			echo 'Échec : ' . $e->getMessage();
		}
		catch (PDOException $e) {

			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}


	}
    
	public function getStudent($unIdStudent) {

		try {

			$req = "SELECT nom, prenom, adresse, telephone, mail, students.niveau as sLvl from person 
			INNER JOIN students on person.id = students.id
			where person.id = $unIdStudent;";


			$monPdoMusic = PdoMusic::getPdoMusic();

			$rs = $monPdoMusic::getMonPdo()->prepare($req) ;

			$rs->setFetchMode(PDO::FETCH_OBJ);

			$rs->execute() ;

			$monStudent = $rs->fetch();

			$monStudent = new Student($unIdStudent,$monStudent->nom,$monStudent->prenom, $monStudent->adresse, $monStudent->telephone, $monStudent->mail, $monStudent->sLvl) ;

			return $monStudent;

		} 
		catch (PDOException $e) {

			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}


	}

	public function selectStudents(){


		$students = [];
		$req = "SELECT person.id as pID, person.nom as pNom, person.prenom as pPrenom, person.telephone as pTel, person.adresse as pAdresse, person.mail as pMail, students.niveau as sNiveau from person
		INNER JOIN students on person.id = students.id;";



		$rs = self::$monPdo->prepare($req) ;

		$rs->execute();


		while ($donnees = $rs->fetch(PDO::FETCH_ASSOC)) {

			$students[$donnees["pID"]] = new Student($donnees["pID"],$donnees["pNom"],$donnees["pPrenom"],$donnees["pAdresse"], $donnees["pTel"], $donnees["pMail"],$donnees["sNiveau"]);
		}



		return $students ;
	}

	public   function insertStudent($nom,$prenom,$adresse,$mail,$tel,$idCours,$lesCours){ 

		try {
			//creat student into person		
			$nom=strtoupper($nom);
			$prenom=strtoupper($prenom);

			$req = "insert into bd_zicmu.person (nom,prenom,adresse,mail,telephone) values ('".$nom."','".$prenom."','".$adresse."','".$mail."','".$tel."');";

			//$monPdoMusic = PdoMusic::getPdoMusic();

			//$rs = $monPdoMusic::getMonPdo()->prepare($req) ;

			$rs = self::$monPdo->prepare($req) ;

			$succed=$rs->execute();

			if($succed){
				//Get the last student creat into person and put him into student
				$idPerson = $this->getIdPerson($nom,$prenom,$tel);

				$req = "INSERT INTO bd_zicmu.students value ('$idPerson','1');";
				$rs = self::$monPdo->prepare($req) ;

				$succed=$rs->execute();


				//if the inscription succed decrement nbplace of the cours where the student is insert
				$lesCours[$idCours]->nbPlaceDebit();
				$newNbPlace = $lesCours[$idCours]->getNbPlace();

				$req = "update bd_zicmu.cours set cours.nbPlace='$newNbPlace' where cours.id='$idCours';";
				$rs = self::$monPdo->prepare($req);

				$succed=$rs->execute();

				if ($succed) {
					$idStudent = $this->getIdStudent($nom,$prenom,$tel);
					$req = "INSERT INTO bd_zicmu.inscription (idStudent, idCours) values ('$idStudent', '$idCours');";
					$rs = self::$monPdo->prepare($req);
					$succed=$rs->execute();
				}
				else{

				}
			}
			else{
				throw new Exception("Error lors de l'inserstion du client");
			}

		} 
		catch (PDOException $e) {
		
			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}


	}




	function selectLesInscri(){
		
		try{

			$inscri = [];
	
			$req = "SELECT students.id as sId, paye as payee, cours.id as cID from bd_zicmu.inscription 
			INNER JOIN students ON inscription.idStudent = students.id 
			INNER JOIN cours ON inscription.idCours = cours.id;";

			$rs = self::$monPdo->prepare($req) ;
				
			$rs->execute() ;
			
			while ($donnees = $rs->fetch(PDO::FETCH_ASSOC)) {

				$unIdStudent = $donnees["sId"];
				$student = $this->getStudent($unIdStudent);

				$idCours = $donnees["cID"];

				$inscri[$unIdStudent][$idCours] = new Inscription($student, $idCours, 1);
			}
			return $inscri;
		}
		catch (PDOException $e) {
	
			echo 'Échec lors de la connexion : ' . $e->getMessage();

		}



	}

}
    
  
