<?php
    class Person
    {
        private $nom;
        private $prenom;
        private $adresse;
        private $tel;
        private $mail;

        function __construct() {    }

        function __construct($nom, $prenom, $adresse, $tel, $mail) {
            $this->name = $name;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->tel = $tel;
            $this->mail = $mail;
        }

        function __destruct() {
            echo "The Person was {$this->nom}.";
        }
    }
    