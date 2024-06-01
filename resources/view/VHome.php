<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/View.php");

    class VHome extends View {
        public function show($params) {
            $this->assignSmartyParams($params);
            $this->smarty->display("home.html");
        }
    }
?>