<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");

    class VPost {
        private $smarty;
        private $authenticated = false;

        public function __construct() {
            $this->smarty = SmartyLoader::loadSmarty();
        }

        public function show($type) {
            session_start();
            
            
            if(isset($_SESSION["username"])){
                $this->authenticated = true;
            }

            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("type", $type); // INSERIRE LOGICA TIPO
            $this->smarty->assign("className", "post_section");
            $this->smarty->assign("classId", "post-list");

            $date = date("Y/m/d");
            $time = date("H:i:s");

            $this->smarty->assign("date", $date);
            $this->smarty->assign("time", $time);
            $this->smarty->display("postSection.html");
        }

        public function showComments($postid,$user,$posttitle,$description,$datetime) {
            $this->smarty->assign("authenticated", $this->authenticated);
            $this->smarty->assign("type", "comment"); // INSERIRE LOGICA TIPO
            $this->smarty->assign("posttitle",$posttitle);
            $this->smarty->assign("postId", $postid);
            $this->smarty->assign("user", $user);
            $this->smarty->assign("description", $description);
            $this->smarty->assign("datetime", $datetime);

            $date = date("Y/m/d");
            $time = date("H:i:s");

            $this->smarty->assign("date", $date);
            $this->smarty->assign("time", $time);

            $this->smarty->display("post.html");
        }
    }
?>