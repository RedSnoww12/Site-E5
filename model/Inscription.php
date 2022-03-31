<?php
    class Inscription
    {
        private $student = new Student();
        private $cours = new Cours();
        private $payee;

        function __construct() {    }

        function __construct($student, $cours, $payee) {
            $this->$salaire = $salaire;
            $this->$cours = $cours;
            $this->$payee = $payee;
        }

        function __destruct() {
        }

    }
    