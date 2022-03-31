<?php
    class Student extends Person
    {
        private $level;
        private $listCours = array();

        function __construct() {    }

        function __construct($level) {
            $this->level = $level;
        }

        function __destruct() {
            echo "The Student was {$this->nom}.";
        }
    }
    