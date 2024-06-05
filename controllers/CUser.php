<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");

    class CUser {
        public function home() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            $authenticated = false;
            if($user != null){
                $username = $user->getUsername();
                $authenticated = true;
            }

            $view = new VUser();
            $params = array("authenticated" => $authenticated,
                            "username" => $username);
            $view->showHome($params);
        }

        public function profile() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showProfile($params);
        }

        public function saved() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showProfile($params);
        }

        public function participated() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showProfile($params);
        }

        public function chats() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showChatSection($params);
        }

        public function privacy() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username,
                            "censuredPassword" => "*");
            $view->showPrivacyPage($params);
        }
    }
?>