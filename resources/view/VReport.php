<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/View.php");

    class VReport extends View {
        private $smarty;
        private $authenticated = false;

        public function __construct() {
            
        }

        public function show() {
            session_start();
            $this->smarty = SmartyLoader::loadSmarty();
            
            if(isset($_SESSION["username"])){
                $this->authenticated = true;
            }

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("type", "userList"); // INSERIRE LOGICA TIPO
            $this->smarty->assign("className", "report_section");
            $this->smarty->assign("classId", "report-list");

            $sisdatetime = getdate();
            $date = date("Y/m/d");
            $time = date("H:i:s");

            $this->smarty->assign("date", $date);
            $this->smarty->assign("time", $time);
            $this->smarty->display("post.html");
        }

    }

?>