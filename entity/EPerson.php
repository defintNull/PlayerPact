<?php
    include_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FInterface.php");

    class EPerson implements FInterface {

        protected $id;
        protected $username;
        protected $password;
        protected $name;
        protected $surname;
        protected $birthDate;
        protected $email;
        protected $image;

        public function __construct($id, $username, $password, $name, $surname, $birthDate, $email, $image) {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->surname = $surname;
            $this->birthDate = $birthDate;
            $this->email = $email;
            $this->image = $image;
        }

        public function getId() {
            return $this->id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getValues() {
            $v = array(
                "id" => $this->id,
                "username" => $this->username,
                "password" => $this->password,
                "name" => $this->name,
                "surname" => $this->surname,
                "birthdate" => $this->birthDate,
                "email" => $this->email,
                "image" => $this->image
            );
            return $v;
        }
        
    }
?>