<?php
    class Teacher extends Person
    {
        private $salaire;

        function __construct($idP, $nom, $prenom, $adresse, $tel, $mail, $salaire = 0) {
            parent::__construct($idP, $nom, $prenom, $adresse, $tel, $mail);
            $this->salaire = $salaire;
        }

        function __destruct() {

        }
    }
    