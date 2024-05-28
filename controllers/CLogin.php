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
            echo var_dump($_POST);
        }

        private static function authentication(string $username, string $password) {
            CLogin::check($username);
            CLogin::check($password);

            $pm = new FPersistentManager();
            $values = array("username" => $username, "password" => $password);
            $res = $pm->load("EUser", $values); // DA CAMBIARE CON EPERSON
            
            if($res != array()) {
                $res = $res[0];
                $user = new EUser($res["id"],$res["username"],$res["password"],$res["name"],$res["surname"],$res["birthDate"],$res["email"],$res["image"]);

                $session = USession::getInstance();
                $session->set("User",$user);
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