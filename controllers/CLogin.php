<?php

require_once realpath(__DIR__."/../view/VLogin.php");
require_once realpath(__DIR__."/../foundation/FPersistentManager.php");
require_once realpath(__DIR__."/../entity/EUser.php");
require_once realpath(__DIR__."/../entity/EModerator.php");
require_once realpath(__DIR__."/../entity/EAdmin.php");
require_once realpath(__DIR__."/../entity/EProfile.php");
require_once realpath(__DIR__."/../utility/USession.php");
require_once realpath(__DIR__."/../entity/EBannedUser.php");

/**
 * Manage the login/logout operations
 *
 * Manages the operations regarding login and logout
 *
 * @package Playerpact\Controllers
 */
class CLogin
{
    /**
     * Redirect to login method
     *
     * This function simply redirect the call to /login to /login/login
     *
     */
    public function home()
    {
        $this->login();
    }

     /**
     * Shows login page or redirect if already logged in
     *
     * Checks the values stored into the session cookie and redirect the client
     * to the corresponding home page. If there are no clients stored into the current session,
     * it shows the login page.
     * 
     * @param string $check This string is useful for showing any errors.
     * @param string $date This string shows the date until the ban removing if a banned user tries to login.
     */
    public function login(string $check = "ok", $date = "")
    {
        $session = USession::getInstance();
        $user = $session->load("user");
        $mod = $session->load("moderator");
        $admin = $session->load("admin");

        if ($user != null) {
            header("Location: /user/home");
            exit();
        }
        if ($mod != null) {
            $session->end();
            header("Location: /moderator/home");
            exit();
        }
        if ($admin != null) {
            $session->end();
            header("Location: /admin/home");
            exit();
        }

        $view = new VLogin();
        $view->show($check, $date);
    }

    /**
     * Registration page
     *
     * Shows the registration page. The parameters are useful for showing any errors.
     * 
     * @param string $info This string manages the error message on screen
     * @param string $name This string manages the name related error message on screen
     * @param string $surname This string manages the surname related error message on screen
     * @param string $birthdate This string manages the birthdate related error message on screen
     * @param string $email This string manages the email related error message on screen
     * @param string $username This string manages the username related error message on screen
     * @param string $password This string manages the password related error message on screen
     */
    public function registration(string $info = "ok", string $name = "ok", string $surname = "ok", string $birthdate = "ok", string $email = "ok", string $username = "ok", string $password = "ok")
    {
        $view = new VLogin();
        $params = array(
            "name" => $name,
            "surname" => $surname,
            "birthdate" => $birthdate,
            "email" => $email,
            "username" => $username,
            "password" => $password,
            "info" => $info
        );
        $view->registration($params);
    }

     /**
     * Redirect to home page
     *
     * Checks username and passwords inserted and checks whether they are valid. If they are valid, it redirects
     * to the related home page, otherwise it redirects to the login page, setting the parameter check to false
     */
    public function loginRedirect()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $check = $this->authentication($username, $password);

        if ($check) {
            header("Location: /" . $check . "/home");
            exit();
        }
        header("Location: /login/login?check=false");
        exit();
    }

     /**
      * @template result
     * Checks client authentication
     *
     * Checks if username and password inserted are valid and return a value based on the authentication result.
     * Return a string containing the client role if valid, and false if they are not valid.
     * 
     * @param string $username This string contains the username
     * @param string $password This string contains the password
     * 
     * @return result
     */
    private static function authentication(string $username, string $password)
    {
        if (!CLogin::check($username)) {
            header("Location: /login/login?check=bad");
            exit();
        }
        
        if(!CLogin::check($password)) {
            header("Location: /login/login?check=bad");
            exit();
        }

        $pm = new FPersistentManager();

        $values = array("username" => $username);

        $profile = $pm->load("Eprofile", $values);
        if($profile == array()) {
            return false;
        }


        if (password_verify($password, $profile[0]["password"])) {
            $profile = $profile[0];

            if ($profile["type"] == "user") {
                unset($profile["type"]);
                $val = $pm->load("EUser", $values)[0];
                $banned = $pm->load("EBannedUser", array("userId" => $val["id"]));
                
                if($banned != array()) {
                    header("Location: /login/login?check=banned&date=".$banned[0]["banDate"]);
                    exit();
                }

                $user = new EUser($val["id"], $val["username"], $val["password"], $val["name"], $val["surname"], $val["birthDate"], $val["email"], $val["image"]);

                $session = USession::getInstance();
                $session->set("user", $user);
                return "user";

            } elseif ($profile["type"] == "moderator") {
                $val = $pm->load("EModerator", $values)[0];
                $mod = new EModerator($val["id"], $val["username"], $val["password"], $val["name"], $val["surname"], $val["birthDate"], $val["email"], $val["image"]);

                $session = USession::getInstance();
                $session->set("moderator", $mod);
                return "moderator";

            } elseif ($profile["type"] == "admin") {
                $val = $pm->load("EAdmin", $values)[0];
                $admin = new EAdmin($val["id"], $val["username"], $val["password"], $val["name"], $val["surname"], $val["birthDate"], $val["email"], $val["image"]);

                $session = USession::getInstance();
                $session->set("admin", $admin);
                return "admin";
            }
        }
        return false;
    }

    /**
     * Register a new user
     *
     * Checks if all the fields are compiled correctly and adds a new user to DB through PM.
     */
    public function register()
    {
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

            if (!CLogin::check($name)) {
                $bad["name"] = "bad";
            }
            if (!CLogin::check($surname)) {
                $bad["surname"] = "bad";
            }
            if (!CLogin::check($birthdate)) {
                $bad["birthdate"] = "bad";
            }
            if (!CLogin::check($email)) {
                $bad["email"] = "bad";
            }
            if (!CLogin::check($username)) {
                $bad["username"] = "bad";
            }
            if (!CLogin::check($password)) {
                $bad["password"] = "bad";
            }

            $d1 = new DateTime($birthdate);
            $d2 = new DateTime(date("Y-m-d"));

            if(!checkdate($birthdayCheck[1], $birthdayCheck[2], $birthdayCheck[0]) || $d1 > $d2 || strlen($birthdayCheck[0]) > 4 || intval($birthdayCheck) < 1900) {
                $bad["birthdate"] = "not valid";
            }

            if(count($bad) > 0) {
                header("Location: /login/registration?info=error&" . http_build_query($bad));
                exit();
            }

            $image = null;

            if (isset($_FILES["profilepicture"]['name']) && $_FILES["profilepicture"]['error'] == 0) {
                $file_tmp_path = $_FILES["profilepicture"]['tmp_name'];
                $file_name = $_FILES["profilepicture"]['name'];
                $file_size = $_FILES["profilepicture"]['size'];

                if ($file_size > 5 * 1024 * 1024) {
                    header("Location: /login/registration?info=tooBig");
                    exit();
                }

                $allowedfileExtensions = array('jpg', 'jpeg', 'png');
                $file_name_cmps = explode(".", $file_name);
                $file_extension = strtolower(end($file_name_cmps));

                if (in_array($file_extension, $allowedfileExtensions)) {
                    $image = addslashes(file_get_contents($file_tmp_path));
                } else {
                    header("Location: /login/registration?info=error");
                    exit();
                }
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $user = new EUser(1, $username, $password, $name, $surname, $birthdate, $email, $image);
            $profile = new EProfile(1, "user", $username, $password, $email);

            $existing = $this->checkExisting();

            if (count($existing) > 0) {
                header("Location: /login/registration?info=error&" . http_build_query($existing));
                exit();
            }

            $pm = new FPersistentManager();
            if (!$pm->store($user) || !$pm->store($profile)) {
                header("Location: /login/registration?info=error&");
                exit();
            }
            header("Location: /login");
            exit();
        }
        header("Location: /login/registration?info=error&" . http_build_query($missing));
        exit();
    }

    /**
     * Check missing fields
     *
     * Checks if there are any fields left empty in the registration.
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
     * Check existing username/email
     *
     * Checks if the username or the email are already in use when signing up
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
    private static function check($s)
    {
        if (!preg_match("/^[a-zA-Z0-9à-üÀ-Ü\/@.#!_\-]*$/", $s)) {
            return false;
        }
        return true;
    }

    /**
     * Logout function
     *
     * Ends the session and redirect to the public home page.
     */
    public function logout()
    {
        $session = USession::getInstance();
        $session->end();
        header("Location: /user/home");
        exit();
    }
}
