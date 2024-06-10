<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VLogin.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EProfile.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");


    class CLogin {
        public function home() {
            $session = USession::getInstance();
            $user = $session->load("user");
            if($user != null){
                header("Location: /user/home");
                exit();
            }
            $this->login();
        }

        public function login(string $check="ok") {
            $view = new VLogin();
            $view->show($check);
        }

        public function registration($info = "ok", $name="ok", $surname="ok", $birthdate="ok", $email="ok", $username="ok", $password="ok") {
            $view = new VLogin();
            $params = array("name" => $name, 
                            "surname" => $surname, 
                            "birthdate" => $birthdate, 
                            "email" => $email, 
                            "username" => $username, 
                            "password" => $password,
                            "info" => $info);
            $view->registration($params);
        }

        public function loginRedirect() {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $check = $this->authentication($username, $password);
            
            if($check) {
                header("Location: /user/home");
                exit();
            }
            header("Location: /login/login?check=false");
            exit();
        }

        private static function authentication(string $username, string $password) {
            //CLogin::check($username);
            //CLogin::check($password);

            $pm = new FPersistentManager();
            $values = array("username" => $username, "password" => $password);
            $profile = $pm->load("Eprofile", $values);
            
            if($profile != array()) {
                $profile = $profile[0];

                if($profile["type"] == "user") {
                    unset($profile["type"]);
                    $val = $pm->load("EUser", $values)[0];
                    $user = new EUser($val["id"],$val["username"],$val["password"],$val["name"],$val["surname"],$val["birthDate"],$val["email"],$val["image"]);

                    $session = USession::getInstance();
                    $session->set("user",$user);

                } elseif($profile["type"] == "mod") {
                    $val = $pm->load("EMod", $values)[0];
                    $user = new EMod($val["id"],$val["username"],$val["password"],$val["name"],$val["surname"],$val["birthDate"],$val["email"],$val["image"]);

                    $session = USession::getInstance();
                    $session->set("user",$user); // DA CAPIRE SE LA CHIAVE VA LASCIATA USER O VA MESSA A MOD O ADMIN
                    
                } elseif($profile["type"] == "admin") {
                    $val = $pm->load("EAdmin", $values)[0];
                    $user = new EAdmin($val["id"],$val["username"],$val["password"],$val["name"],$val["surname"],$val["birthDate"],$val["email"],$val["image"]);

                    $session = USession::getInstance();
                    $session->set("user",$user);
                }
                
                return true;
            }
            return false;
        }

        public function register() {
            $missing = $this->checkMissing();
            
            if($missing == array()) {
                $name = $_POST["name"];
                $surname = $_POST["surname"];
                $birthdate = $_POST["birthdate"];
                $email = $_POST["email"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                $image = null;

                if (isset($_FILES["profilepicture"]['name']) && $_FILES["profilepicture"]['error'] == 0) {
                    $file_tmp_path = $_FILES["profilepicture"]['tmp_name'];
                    $file_name = $_FILES["profilepicture"]['name'];
                    $file_size = $_FILES["profilepicture"]['size']; // in byte

                    if($file_size > 5*1024*1024){
                        header("Location: /login/registration?info=tooBig"); // Aggiungere messaggio a schermo
                        exit();
                    }
            
                    $allowedfileExtensions = array('jpg', 'jpeg', 'png');
                    $file_name_cmps = explode(".", $file_name);
                    $file_extension = strtolower(end($file_name_cmps));
            
                    if (in_array($file_extension, $allowedfileExtensions)) {
                        $image = addslashes(file_get_contents($file_tmp_path));
                    } else{
                        header("Location: /login/registration?info=error");
                        exit();
                    }
                } else{
                    header("Location: /login/registration?info=error");
                    exit();
                }

                $user = new EUser(1, $username, $password, $name, $surname, $birthdate, $email, $image);
                $profile = new EProfile(1, "user", $username, $password, $email);
                
                $existing = $this->checkExisting();
                
                if(count($existing) > 0){
                    header("Location: /login/registration?info=error&".http_build_query($existing));
                    exit();
                }

                $pm = new FPersistentManager();
                if(!$pm->store($user) || !$pm->store($profile)){
                    header("Location: /login/registration?info=error&");
                    exit();
                }
                header("Location: /login");
                exit();
            }
            header("Location: /login/registration?info=error&".http_build_query($missing));
            exit();
        }

        private static function checkMissing() {
            //funzione da fare per formattare stringe per prevenire sql injection
            //Aggiungere controllo se già esiste l'utente
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $birthdate = $_POST["birthdate"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            $missing = array();

            // Controllo sui campi vuoti
            if($name == ""){
                $missing["name"] = "missing";
            }

            if($surname == ""){
                $missing["surname"] = "missing";
            }

            if($birthdate == ""){
                $missing["birthdate"] = "missing";
            }

            if($email == ""){
                $missing["email"] = "missing";
            }

            if($username == ""){
                $missing["username"] = "missing";
            }

            if($password == ""){
                $missing["password"] = "missing";
            }

            return $missing;
        }

        private static function checkExisting() {
            $email = $_POST["email"];
            $username = $_POST["username"];

            $pm = new FPersistentManager();
            $existing = array();

            $check = $pm->load("EProfile", array("username" => $username));
            if($check != array()){
                $existing["username"] = "existing";
            }
            $check = $pm->load("EProfile", array("email" => $email));
            if($check != array()){
                $existing["email"] = "existing";
            }

            return $existing;
        }

        public function logout(){
            $session = USession::getInstance();
            $session->end();
            header("Location: /user/home");
            exit();
        }
    }
?>