<?php
    class Instrument
    {
        private $nom;

        function __construct($nom) {
            $this->nom = $nom;
        }

        function __destruct() {
        }

        function getNom(){
            return $this->nom;
        }
    }
    