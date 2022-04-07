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
 * @author Salim
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoMusic{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=bdmusique';   		
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
 
 * Appel : $instancePdoGsb = PdoMusic::getPdoMusic();
 
 * @return l'unique objet de la classe PdoMusic
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

 
}
 


    
    
    
  
