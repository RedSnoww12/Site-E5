<?php
    class Cours
    {
        private $prof = new Person();
        private $instrument = new Instrument();
        private $Date;
        private $nbPlace;
        private $listStudents = array();

        function __construct() {    }

        function __construct($prof, $instrument, $Date, $nbPlace) {
            $this->prof = $prof;
            $this->instrument = $instrument;
            $this->Date = $Date;
            $this->nbPlace = $nbPlace;
        }

        function __destruct() {
            echo "The Teacher's cours was {$this->prof}.";
        }
    }
    