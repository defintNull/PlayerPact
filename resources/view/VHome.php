<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    echo $_SERVER["DOCUMENT_ROOT"]."/smartyloader.php";

    class VHome {
        private $smarty;
        private $authenticated = false;

        public function __construct() {
            session_start();
            $this->smarty = SmartyLoader::loadSmarty();
            $_SESSION["username"] = "ghigo";
            if(isset($_SESSION["username"])){
                $this->authenticated = true;
                $username = $_SESSION["username"];
            }
            else{
                $username = "";
            }

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("username", $username);
            $this->smarty->display("prova.html");
        }

    }
    $a = new VHome();
?>