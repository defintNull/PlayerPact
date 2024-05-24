<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");

    class VError {
        private $smarty;

        public function show() {
            $this->smarty = SmartyLoader::loadSmarty();
            $this->smarty->display("404.html");
        }
    }
?>