<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EProfile.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EReport.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EUser.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/utility/USession.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EModerator.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/VModerator.php");

class CModerator
{
    private function checkSession($session)
    {
        $user = $session->load("moderator");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EModerator", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
    }

    public function home()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        $params = array("username" => $mod->getUsername() . " (mod)",
                        "profilePicture" => $PPImageURL);
        $view = new VModerator();
        $view->showHome($params);
    }

    public function reports() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        $params = array("username" => $mod->getUsername() . " (mod)",
                        "profilePicture" => $PPImageURL);
        $view = new VModerator();
        $view->showReports($params);
    }

    public function users() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        $params = array("username" => $mod->getUsername() . " (mod)",
                        "profilePicture" => $PPImageURL);
        $view = new VModerator();
        $view->showUsers($params);
    }

    public function profile() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        $params = array("username" => $mod->getUsername() . " (mod)",
                        "profilePicture" => $PPImageURL);
        $view = new VModerator();
        $view->showProfile($params);
    }

    public function loadReports(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('moderator');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElements("EReport", $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $report = new EReport($res[$i]["id"], $res[$i]["userId"], $res[$i]["idToReport"], $res[$i]["type"], $res[$i]["description"], $res[$i]["datetime"]);
            $reportUser = $pm->load("EUser", array("id" => $report->getUserId()));
            if($reportUser != array()) {
                $reportUsername = $reportUser[0]["username"];
            } else {
                $reportUsername = "Deleted User";
            }
            $values[] = array(
                "id" => $report->getId(),
                "username" => $reportUsername,
                "idToReport" => $report->getIdToReport(),
                "type" => $report->getType(),
                "datetime" => $report->getDateTime()
            );
        }
        return array($values, $count);
    }

    public function loadUsers(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('moderator');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElements("EUser", $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $user = new EUser($res[$i]["id"], $res[$i]["username"], $res[$i]["password"], $res[$i]["name"], $res[$i]["surname"], $res[$i]["birthDate"], $res[$i]["email"], $res[$i]["image"]);
            $values[] = array(
                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "email" => $user->getEmail()
            );
            if($user->getImage() != ""){
                $values[$i]["image"] = base64_encode($user->getImage());
            } else {
                $values[$i]["image"] = "/public/defaultPropic.png";
            }
        }
        return array($values, $count);
    }

    public function deleteUser() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $userId = $_POST["userId"];

        $pm = new FPersistentManager();
        $user = $pm->load("EUser", array("id" => $userId));
        if($user != array()) {
            $user = $user[0];
            $pm->delete("EUser", array("id" => $userId));
            $pm->delete("EProfile", array("username" => $user["username"], "type" => "user"));
        }
    }
}
