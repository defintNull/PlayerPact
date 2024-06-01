<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");

    class VLogin {
        private $smarty;

        public function __construct() {
            $this->smarty = SmartyLoader::loadSmarty();
        }

        public function show(string $check="true") {
            $this->smarty->assign("check",$check);
            $this->smarty->display("login.html");
        }

        public function registration($name, $surname, $birthdate, $email, $username, $password) {
            $this->smarty->assign("name", $name);
            $this->smarty->assign("surname", $surname);
            $this->smarty->assign("birthdate", $birthdate);
            $this->smarty->assign("email", $email);
            $this->smarty->assign("username", $username);
            $this->smarty->assign("password", $password);
            $this->smarty->display("registration.html");
        }
    }
?>