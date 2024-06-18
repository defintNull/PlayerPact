<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EAdmin.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EProfile.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/utility/USession.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EModerator.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/VAdmin.php");

class CAdmin
{
    private function checkSession($session)
    {
        $user = $session->load("admin");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EAdmin", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
    }

    public function home()
    {
        $session = USession::getInstance();
        $admin = $session->load("admin");

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($admin->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($admin->getImage());
        }

        $params = array("username" => $admin->getUsername() . " (admin)",
                        "profilePicture" => $PPImageURL);
        $view = new VAdmin();
        $view->showHome($params);
    }
    function manageMods()
    {
        $session = USession::getInstance();
        $admin = $session->load("admin");

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($admin->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($admin->getImage());
        }

        $params = array("username" => $admin->getUsername() . " (admin)",
                        "profilePicture" => $PPImageURL);
        $view = new VAdmin();
        $view->showModsPage($params);
    }

    function sql()
    {
        $session = USession::getInstance();
        $admin = $session->load("admin");

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($admin->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($admin->getImage());
        }

        $params = array("username" => $admin->getUsername() . " (admin)",
                        "profilePicture" => $PPImageURL);
        $view = new VAdmin();
        $view->showSQLPage($params);
    }

    public function loadModerators(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElements("EModerator", $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $mod = new EModerator($res[$i]["id"], $res[$i]["username"], $res[$i]["password"], $res[$i]["name"], $res[$i]["surname"], $res[$i]["birthDate"], $res[$i]["email"], $res[$i]["image"]);
            $values[] = array(
                "id" => $mod->getId(),
                "username" => $mod->getUsername(),
                "email" => $mod->getEmail(),
                "image" => base64_encode($mod->getImage())
            );
        }
        //echo var_dump(array($values,$count));
        return array($values, $count);
    }

    public function createMod($info = "ok", $name = "ok", $surname = "ok", $birthdate = "ok", $email = "ok", $username = "ok", $password = "ok")
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load("admin");

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $view = new VAdmin();
        $params = array(
            "name" => $name,
            "surname" => $surname,
            "birthdate" => $birthdate,
            "email" => $email,
            "username" => $username,
            "password" => $password,
            "info" => $info
        );
        $view->showModCreationPage($params);
    }

    public function confirmModCreation()
    {
        $missing = $this->checkMissing();

        if ($missing == array()) {
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

                if ($file_size > 5 * 1024 * 1024) {
                    header("Location: /admin/createMod?info=tooBig"); // Aggiungere messaggio a schermo
                    exit();
                }

                $allowedfileExtensions = array('jpg', 'jpeg', 'png');
                $file_name_cmps = explode(".", $file_name);
                $file_extension = strtolower(end($file_name_cmps));

                if (in_array($file_extension, $allowedfileExtensions)) {
                    $image = addslashes(file_get_contents($file_tmp_path));
                } else {
                    header("Location: /admin/createMod?info=error");
                    exit();
                }
            }

            $moderator = new EModerator(1, $username, $password, $name, $surname, $birthdate, $email, $image);
            $profile = new EProfile(1, "moderator", $username, $password, $email);

            $existing = $this->checkExisting();

            if (count($existing) > 0) {
                header("Location: /admin/createMod?info=error&" . http_build_query($existing));
                exit();
            }

            $pm = new FPersistentManager();
            if (!$pm->store($moderator) || !$pm->store($profile)) {
                header("Location: /admin/createMod?info=error&");
                exit();
            }
            header("Location: /admin/manageMods");
            exit();
        }
        header("Location: /admin/createMod?info=error&" . http_build_query($missing));
        exit();
    }
    private static function checkMissing()
    {
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
        if ($name == "") {
            $missing["name"] = "missing";
        }

        if ($surname == "") {
            $missing["surname"] = "missing";
        }

        if ($birthdate == "") {
            $missing["birthdate"] = "missing";
        }

        if ($email == "") {
            $missing["email"] = "missing";
        }

        if ($username == "") {
            $missing["username"] = "missing";
        }

        if ($password == "") {
            $missing["password"] = "missing";
        }

        return $missing;
    }

    private static function checkExisting()
    {
        $email = $_POST["email"];
        $username = $_POST["username"];

        $pm = new FPersistentManager();
        $existing = array();

        $check = $pm->load("EProfile", array("username" => $username));
        if ($check != array()) {
            $existing["username"] = "existing";
        }
        $check = $pm->load("EProfile", array("email" => $email));
        if ($check != array()) {
            $existing["email"] = "existing";
        }

        return $existing;
    }

    // Mettilo nella registrazione
    private static function check($s)
    {
        if (!preg_match("/^[a-zA-Z0-9à-üÀ-Ü#!_%]*$/", $s)) {
            return false;
        }
        return true;
    }
}
