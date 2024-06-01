<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VLogin.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");


    class CLogin {
        public function login(string $check="true") {
            $view = new VLogin();
            $view->show($check);
        }

        public function registration() {
            $view = new VLogin();
            $view->registration();
        }

        public function home() {
            $this->login();
        }

        public function redirect() {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $check = $this->authentication($username,$password);

            if($check) {
                //header("Location:/user/home");
            } else {
                //header("Location:/login/login?check=false");
            }
        }

        public function register() {
            echo var_dump($_FILES);
        }

        private static function authentication(string $username, string $password) {
            CLogin::check($username);
            CLogin::check($password);

            $pm = new FPersistentManager();
            $values = array("username" => $username, "password" => $password);
            $profile = $pm->load("Eprofile", $values); // DA CAMBIARE CON EPERSON
            
            if($profile != array()) {
                $profile = $profile[0];

                if($profile["type"] == "user") {
                    unset($profile["type"]);
                    $userval = $pm->load("EUser", $profile)[0];
                    $user = new EUser($userval["id"],$userval["username"],$userval["password"],$userval["name"],$userval["surname"],$userval["birthDate"],$userval["email"],$userval["image"]);

                    $session = USession::getInstance();
                    $session->set("User",$user);

                } elseif($profile["type"] == "mod") {
                    $userval = $pm->load("EMod", $profile)[0];
                    $user = new EUser($userval["id"],$userval["username"],$userval["password"],$userval["name"],$userval["surname"],$userval["birthDate"],$userval["email"],$userval["image"]);

                    $session = USession::getInstance();
                    $session->set("User",$user);
                    
                } elseif($profile["type"] == "admin") {
                    $userval = $pm->load("EAdmin", $profile)[0];
                    $user = new EUser($userval["id"],$userval["username"],$userval["password"],$userval["name"],$userval["surname"],$userval["birthDate"],$userval["email"],$userval["image"]);

                    $session = USession::getInstance();
                    $session->set("User",$user);
                }
                
                return true;
            } else {
                return false;
            }
        }

        private static function check(string $string) {
            //funzione da fare per formattare stringe per prevenire sql injection
        }
    }
?>