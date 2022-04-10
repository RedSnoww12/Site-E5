<?php
    class Student extends Person
    {
        private $level;
        private $listCours = array();

        function __construct($idP, $nom, $prenom, $adresse, $tel, $mail, $level = 1) {
            parent::__construct($idP, $nom, $prenom, $adresse, $tel, $mail);
            $this->level = $level;
        }



        function __destruct() {

        }
    }
    