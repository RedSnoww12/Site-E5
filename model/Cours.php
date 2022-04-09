<?php
    class Cours
    {
        private $prof = new Teacher();
        private $instrument = new Instrument();
        private $Date;
        private $nbPlace;
        private $idCours;
        private $listStudents = array();

        function __construct() {    }

        function __construct($idCours,$prof, $instrument, $Date, $nbPlace) {
            $this->prof = $prof;
            $this->instrument = $instrument;
            $this->Date = $Date;
            $this->nbPlace = $nbPlace;
            $this->idCours = $idCours;
        }

        function __destruct() {
            echo "The Teacher's cours was {$this->prof}.";
        }

        function nbPlaceDebit(){
            $this->nbPlace = $nbPlace-1;
        }
    }
    