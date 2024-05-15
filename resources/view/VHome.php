<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    echo $_SERVER["DOCUMENT_ROOT"]."/smartyloader.php";

    class VHome {
        private $smarty;

        public function __construct() {
            $this->smarty = SmartyLoader::loadSmarty();
            
            $this->smarty->assign("name", "Mario");
            $this->smarty->display("prova.tpl");
        }

    }
    $a = new VHome();
?>