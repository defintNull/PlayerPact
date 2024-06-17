<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EAdmin.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/VAdmin.php");
class CAdmin
{
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
}
