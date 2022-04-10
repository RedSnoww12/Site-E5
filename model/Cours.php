<?php
    include_once("./model/Person.php");
    include_once("./model/Instrument.php");
    include_once("./model/Teacher.php");
    class Cours
    {
        private $prof;
        private $instrument;
        private $Date;
        private $nbPlace;
        private $idCours;
        private $listStudents = array();

        function __construct($idCours,$prof, $instrument, $Date, $nbPlace) {
            $this->prof = $prof;
            $this->instrument = $instrument;
            $this->Date = $Date;
            $this->nbPlace = $nbPlace;
            $this->idCours = $idCours;
        }

        function __destruct() {

        }


        function nbPlaceDebit(){
            $this->nbPlace = $this->nbPlace-1;
        }

        function getInstrumentNom(){
            return $this->instrument->getNom();
        }

        function getPersonNom(){
            return $this->prof->getNom();
        }

        function getDate(){
            return $this->Date;
        }
        function getNbPlace(){
            return $this->nbPlace;
        }
        function getIdCours(){
            return $this->idCours;
        }
    }
    