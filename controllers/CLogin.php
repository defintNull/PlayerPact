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

        public function registration($name="true", $surname="true", $birthdate="true", $email="true", $username="true", $password="true") {
            $view = new VLogin();
            $view->registration($name, $surname, $birthdate, $email, $username, $password);
        }

        public function home() {
            $this->login();
        }

        public function loginRedirect() {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $check = $this->authentication($username, $password);
            
            if($check) {
                header("Location:/user/home");
                exit();
            }
            header("Location:/login/login?check=false");
            exit();
        }

        private static function authentication(string $username, string $password) {
            //CLogin::check($username);
            //CLogin::check($password);

            $pm = new FPersistentManager();
            $values = array("username" => $username, "password" => $password);
            $res = $pm->load("EUser", $values); // DA CAMBIARE CON EPERSON
            
            if($res != array()) {
                $res = $res[0];
                $user = new EUser($res["id"],$res["username"],$res["password"],$res["name"],$res["surname"],$res["birthDate"],$res["email"],$res["image"]);

                $session = USession::getInstance();
                $session->start();
                $session->set("user", $user);
                return true;
            }
            return false;
        }

        public function register() {
            $missing = $this->check();
            if($missing == array()) {
                header("Location:/user/home?authenticated=true");
                exit();
            }
            header("Location:/login/registration?".http_build_query($missing));
            exit();
        }

        private static function check() {
            //funzione da fare per formattare stringe per prevenire sql injection
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $birthdate = $_POST["birthdate"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            $missing = array();

            if($name == ""){
                $missing["name"] = "false";
            } else {
                $missing["name"] = "true";
            }

            if($surname == ""){
                $missing["surname"] = "false";
            } else {
                $missing["surname"] = "true";
            }

            if($birthdate == ""){
                $missing["birthdate"] = "false";
            } else {
                $missing["birthdate"] = "true";
            }

            if($email == ""){
                $missing["email"] = "false";
            } else {
                $missing["email"] = "true";
            }

            if($username == ""){
                $missing["username"] = "false";
            } else {
                $missing["username"] = "true";
            }

            if($password == ""){
                $missing["password"] = "false";
            } else {
                $missing["password"] = "true";
            }

            return $missing;
        }
    }
?>