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

        public function registration() {
            $this->smarty->display("registration.html");
        }
    }
?>