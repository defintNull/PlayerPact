<?php
    class EPerson {

        private $id;
        private $username;
        private $password;
        private $name;
        private $surname;
        private $birthDate;
        private $email;
        private $image;

        public function getValues() {
            $v = array(
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