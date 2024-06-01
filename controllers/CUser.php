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
            $createPostLink = "/login";
            if($user != null){
                $username = $user->getUsername();
                $authenticated = true;
                $createPostLink = "/post/create";
            }

            $params = array("authenticated" => $authenticated,
                            "username" => $username,
                            "createPostLink" => $createPostLink);
            $view->show($params);
        }
    }
?>