<?php
    class USession {
        private static $instance;

        private function __construct() {

        }

        static function getInstance() : USession {
            if(self::$instance == null) {
                self::$instance = new USession();
            }
            return self::$instance;
        }

        public function start() {
            session_start();
        }

        public function end() {
            // Non so se manca uno start o se prende $_SESSION anche così
            if(isset($_SESSION["user"])){ // Da vedere se usare user o altro
                session_unset();
                session_abort();
            }
        }

        public function set(string $key, $obj) {
            $_SESSION[$key] = $obj;
        }

        public function load(string $key) {
            return $_SESSION[$key];
        }
    }
?>