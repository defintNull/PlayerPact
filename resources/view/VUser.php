<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/smartyloader.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/View.php");

    class VUser extends View {
        public function showHome($params) {
            $this->assignSmartyParams($params);
            $this->smarty->display("home.html");
        }

        public function showProfile($params){
            $this->assignSmartyParams($params);
            $this->smarty->display("profilePage.html");
        }

        public function showPrivacyPage($params){
            $this->assignSmartyParams($params);
            $this->smarty->display("privacy.html");
        }

        public function showChatSection($params){
            $this->assignSmartyParams($params);
            $this->smarty->display("chatSection.html");
        }
    }
?>