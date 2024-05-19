<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");

    class VPost {
        private $smarty;
        private $authenticated = false;

        public function __construct() {
            
        }

        public function getPostElements(string $type,int $offset,int $limit,string $datetime) {

            if($type == "standard" || $type == "sell" || $type == "team") {
                $controller = new CPost();
                $res = $controller->loadPosts($type,$limit,$offset,$datetime);
                $count = count($res);
                return array($res,$count);
            } else {
                // REINDIRIZZAMENTO BAD REQUEST
            }

        }

        public function print() {
            session_start();
            $this->smarty = SmartyLoader::loadSmarty();
            
            //$_SESSION["username"] = "pippo";
            if(isset($_SESSION["username"])){
                $this->authenticated = true;
                $username = $_SESSION["username"];
            }
            else{
                $username = "";
            }

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("username", $username);
            $this->smarty->assign("type", "standard"); // INSERIRE LOGICA TIPO

            $sisdatetime = getdate();
            $date = date("Y/m/d");
            $time = date("H:i:s");

            $this->smarty->assign("date", $date);
            $this->smarty->assign("time", $time);
            $this->smarty->display("post.html");
        }

    }

?>