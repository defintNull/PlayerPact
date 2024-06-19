<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EProfile.php");
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
}
