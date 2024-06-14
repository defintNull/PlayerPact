<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EInterestList.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EUser.php");

class CInterestList
{

    public function home()
    {

    }

    public function viewInterestListSection()
    {

    }

    public function issaved()
    {
        $session = USession::getInstance();
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
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $postSaleId = $_POST["postSaleId"];

        $pm = new FPersistentManager();

        if ($pm->load("EInterestList", array("userId" => $user->getId(), "postSaleId" => $postSaleId)) == array()) {
            $interest = new EInterestList($user->getId(), $postSaleId);
            $pm->store($interest);
        } else {
            $pm->delete("EInterestList", array("userId" => $user->getId(), "postSaleId" => $postSaleId));
        }
    }
}
?>