<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/View.php");

    class VPost extends View {
        public function show($params) {
            $this->assignSmartyParams($params);

            $this->smarty->assign("date", date("Y/m/d")); // Date
            $this->smarty->assign("time", date("H:i:s")); // Time
            $this->smarty->display("postSection.html");
        }

        public function showComments($params) {
            $this->assignSmartyParams($params);
            $this->smarty->assign("type", "comment");

            $this->smarty->assign("date", date("Y/m/d"));
            $this->smarty->assign("time", date("H:i:s"));

            $this->smarty->display("post.html");
        }

        public function showSelectNewPost(){
            $this->smarty->display("selectNewPost.html");
        }
    }
?>