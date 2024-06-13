<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");

    class EProfile implements FInterface {

        protected $userId;
        protected $type;
        protected $username;
        protected $password;
        protected $email;

        public function __construct($userId, $type, $username, $password, $email) {
            $this->userId = $userId;
            $this->type = $type;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }

        public function getUserId() {
            return $this->userId;
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

        public function getEmail() {
            return $this->email;
        }

        public function getValues() {
            $v = array(
                "id" => $this->userId,
                "type" => $this->type,
                "username" => $this->username,
                "password" => $this->password,
                "email" => $this->email
            );
            return $v;
        }
        
    }
?>