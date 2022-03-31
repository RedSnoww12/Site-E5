<?php
    class Instrument
    {
        private $nom;

        function __construct() {    }

        function __construct($nom) {
            $this->nom = $nom;
        }

        function __destruct() {
            echo "The Instrument was {$this->$nom}.";
        }
    }
    