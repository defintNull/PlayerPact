<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");

    class EProfile implements FInterface {

        protected $iduser;
        protected $type;
        protected $username;
        protected $password;

        public function __construct($iduser, $type, $username, $password) {
            $this->iduser = $iduser;
            $this->type = $type;
            $this->username = $username;
            $this->password = $password;
        }

        public function getIdUser() {
            return $this->iduser;
        }

        public function getType() {
            return $this->type;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getValues() {
            $v = array(
                "id" => $this->iduser,
                "type" => $this->type,
                "username" => $this->username,
                "password" => $this->password
            );
            return $v;
        }
        
    }
?>