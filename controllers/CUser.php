<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VHome.php");
    
    class CUser {
        public function home() {
            $view = new VHome();
            $view->show(false);
        }
    }
?>