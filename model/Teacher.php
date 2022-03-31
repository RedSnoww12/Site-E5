<?php
    class Teacher extends Person
    {
        private $salaire;

        function __construct() {    }

        function __construct($salaire) {
            $this->$salaire = $salaire;
        }

        function __destruct() {
            echo "The Teacher was {$this->nom}.";
        }
    }
    