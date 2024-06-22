<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EAdmin.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EProfile.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/utility/USession.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EModerator.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/view/VAdmin.php");

/**
 * Manage admin related operations in controller level
 *
 * Manages all the admin related operations, like adding and
 * deleting moderators or interact with DB at a low level.
 *
 * @package Playerpact\Controllers
 */
class CAdmin
{
    /**
     * Check current session
     *
     * Checks if the current session is valid, that is to say if
     * the admin is still in DB or not
     *
     * @param $session The session to check
     * 
     */
    private function checkSession($session)
    {
        $admin = $session->load("admin");
        if ($admin != null) {
            $pm = new FPersistentManager();
            $checkAdmin = $pm->load("EAdmin", array("id" => $admin->getId()));
            if ($checkAdmin == array()) {
                $session->end();
            }
        }
    }

    /**
     * Admin home page controller
     *
     * Manages the visualization of the admin home page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
    public function home()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

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

    /**
     * Moderators management page
     *
     * Manages the visualization of the moderators management page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
    function manageMods()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

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

    /**
     * SQL query page
     *
     * Manages the visualization of the SQL query page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
    function sql()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

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

    /**
     * Moderator load
     *
     * Loads moderators according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of moderators loaded.
     * 
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadModerators(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElements("EModerator", $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $mod = new EModerator($res[$i]["id"], $res[$i]["username"], $res[$i]["password"], $res[$i]["name"], $res[$i]["surname"], $res[$i]["birthDate"], $res[$i]["email"], $res[$i]["image"]);
            $values[] = array(
                "id" => $mod->getId(),
                "username" => $mod->getUsername(),
                "email" => $mod->getEmail()
            );
            if($mod->getImage() != ""){
                $values[$i]["image"] = base64_encode($mod->getImage());
            } else {
                $values[$i]["image"] = "/public/defaultPropic.png";
            }
        }
        return array($values, $count);
    }

    /**
     * Moderator creation page
     *
     * Manages the visualization of the SQL query page, with session check,
     * view initialization and the call to the relative show method. View parameters
     * are used for error visualization.
     * 
     */    
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

    /**
     * Create moderator
     *
     * Adds to DB, through PM, a new moderator with all the data given in the
     * moderator creation page.
     * 
     */
    public function confirmModCreation()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $missing = $this->checkMissing();

        if ($missing == array()) {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $birthdate = $_POST["birthdate"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            $birthdayCheck = explode("-", $birthdate);

            $bad = array();

            if (!CAdmin::check($name)) {
                $bad["name"] = "bad";
            }
            if (!CAdmin::check($surname)) {
                $bad["surname"] = "bad";
            }
            if (!CAdmin::check($birthdate)) {
                $bad["birthdate"] = "bad";
            }
            if (!CAdmin::check($email)) {
                $bad["email"] = "bad";
            }
            if (!CAdmin::check($username)) {
                $bad["username"] = "bad";
            }
            if (!CAdmin::check($password)) {
                $bad["password"] = "bad";
            }

            $d1 = new DateTime($birthdate);
            $d2 = new DateTime(date("Y-m-d"));

            if(!checkdate($birthdayCheck[1], $birthdayCheck[2], $birthdayCheck[0]) || $d1 > $d2) {
                $bad["birthdate"] = "not valid";
            }
            if(count($bad) > 0) {
                header("Location: /admin/createMod?info=error&" . http_build_query($bad));
                exit();
            }

            $image = null;

            if (isset($_FILES["profilepicture"]['name']) && $_FILES["profilepicture"]['error'] == 0) {
                $file_tmp_path = $_FILES["profilepicture"]['tmp_name'];
                $file_name = $_FILES["profilepicture"]['name'];
                $file_size = $_FILES["profilepicture"]['size'];

                if ($file_size > 5 * 1024 * 1024) {
                    header("Location: /admin/createMod?info=tooBig");
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

            $password = password_hash($password, PASSWORD_DEFAULT);

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

    /**
     * Check for missing fields
     *
     * Checks if required fields in moderator creation page are not empty.
     * 
     * @return array
     */
    private static function checkMissing()
    {
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $birthdate = $_POST["birthdate"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $missing = array();

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

    /**
     * Check for existing username/email
     *
     * Checks if username and email are not already in use.
     * 
     * @return array
     */
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

    /**
     * Check for illegal characters
     *
     * Checks if required fields contains or not some illegal characters
     * to prevent SQL injections.
     * 
     * @param string $s The string to check
     * 
     * @return boolean
     */
    private static function check(string $s)
    {
        if (!preg_match("/^[a-zA-Z0-9à-üÀ-Ü\/@.#!_\-]*$/", $s)) {
            return false;
        }
        return true;
    }

    /**
     * Execute query as admin
     *
     * Upload into DB, through PM, the query to be executed and shows the result.
     */
    public function query() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($admin->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($admin->getImage());
        }

        $query = $_POST['sqlquery'];

        $pm = new FPersistentManager();
        $error = false;
        try {
        $result = $pm->query($query);
        } catch (Exception $e) {
            $error = true;
            $result = $e;
        }

        $view = new VAdmin();
        $params = array('username'=> $admin->getUsername() . " (admin)",
                        'profilePicture' => $PPImageURL);
        if(!$error){
            $params['result'] = json_encode($result);
        } else {
            $params['result'] = $result;
        }
        $view->showSQLPage($params);
    }

    /**
     * Delete selected moderator
     *
     * Deletes a moderator depending on his id
     */
    public function deleteMod() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('admin');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $modId = $_POST["modId"];

        $pm = new FPersistentManager();
        $mod = $pm->load("EModerator", array("id" => $modId))[0];
        $pm->delete("EModerator", array("id" => $modId));
        $pm->delete("EProfile", array("username" => $mod["username"], "type" => "moderator"));
    }
}
