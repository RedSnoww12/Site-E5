<?php
    class Person
    {
        protected $idP;
        protected $nom;
        protected $prenom;
        protected $adresse;
        protected $tel;
        protected $mail;

        function __construct($idP, $nom, $prenom, $adresse, $tel, $mail) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->tel = $tel;
            $this->mail = $mail;
            $this->idP = $idP;
        }

        function __destruct() {
        }

        public function setID($ID) {
            $this->idP = $idP;
        }
          
        public function getID() {
            return $this->idP;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function getAdresse() {
            return $this->adresse;
        }

        public function getTel() {
            return $this->tel;
        }

        public function getMail() {
            return $this->mail;
        }
    }
    