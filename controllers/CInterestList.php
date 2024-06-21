<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EInterestList.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EUser.php");

class CInterestList
{
    private function checkSession($session)
    {
        $user = $session->load("user");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EUser", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
    }

    public function home()
    {

    }

    public function viewInterestListSection()
    {

    }

    public function issaved()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $postSaleId = $_POST["postSaleId"];
        $pm = new FPersistentManager();

        if ($pm->load("EInterestList", array("userId" => $user->getId(), "postSaleId" => $postSaleId)) != array()) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $postSaleId = $_POST["postSaleId"];

        $pm = new FPersistentManager();

        if ($pm->load("EInterestList", array("userId" => $user->getId(), "postSaleId" => $postSaleId)) == array()) {
            $interest = new EInterestList($user->getId(), $postSaleId);

            if(!$pm->store($interest)) {
                header("Location: /error/e404");
                exit();
            }
            
        } else {
            $pm->delete("EInterestList", array("userId" => $user->getId(), "postSaleId" => $postSaleId));
        }
    }
}
