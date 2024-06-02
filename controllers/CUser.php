<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VHome.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");

    class CUser {
        public function home() {
            $view = new VHome();

            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            $authenticated = false;
            if($user != null){
                $username = $user->getUsername();
                $authenticated = true;
            }

            $params = array("authenticated" => $authenticated,
                            "username" => $username);
            $view->show($params);
        }
    }
?>