<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");

    class VHome {
        private $smarty;
        private $authenticated = false;

        public function show($authenticated) {
            $this->smarty = SmartyLoader::loadSmarty();

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("username", "");
            $this->smarty->display("home.html");
        }

    }
?>