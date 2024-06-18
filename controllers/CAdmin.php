<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EAdmin.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EModerator.php");
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
                "image" => $mod->getImage()
            );
        }
        //echo var_dump(array($values,$count));
        return array($values, $count);
    }
}
