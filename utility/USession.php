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
            session_unset();
            session_destroy();
        }

        public function set(string $key, $obj) {
            $serial = serialize($obj);
            $_SESSION[$key] = $serial;
        }

        public function load(string $key) {
            $obj = unserialize($_SESSION[$key]);
            return $obj;
        }

        public function exist() : bool {
            if(session_status() === PHP_SESSION_NONE) {
                return false;
            } else {
                return true;
            }
        } 
    }
?>