<?php
    class Inscription
    {
        private $student;
        private $cours;
        private $payee;

        function __construct($student, $cours, $payee=1) {
            $this->student = $student;
            $this->cours = $cours;
            $this->payee = $payee;
        }

        function __destruct() {
        }

        function getPersonNom(){
            return $this->student->getNom();
        }
        function getPersonPrenom(){
            return $this->student->getPrenom();
        }

        function getPersonID(){
            return $this->student->getID();
        }

        function getPayee(){
            return $this->payee;
        }

        function getIdCours(){
            return $this->cours;
        }
    }
    