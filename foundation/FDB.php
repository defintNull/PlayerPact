<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/envloader.php");

    class FDB {
        private $db;
        private $instance;

        private function __construct() {

            try{
                $this->db = new PDO("mysql:host=".$_ENV["DB_HOST"].";dename=".$_ENV["DB_NAME"],$_ENV["DB_USER_NAME"],$_ENV["DB_PASSWORD"]);
            } catch(PDOException $e) {
                echo "Errore: ". $e->getMessage();
            }

        }

        function getInstance() {

        }

        function connect() {

        }

        function query() {

        }

        function close() {

        }

        function store() {

        }

        function load() {

        }

        function delete() {

        }

        function update() {

        }

        function exists() {
            
        }
    }
?>