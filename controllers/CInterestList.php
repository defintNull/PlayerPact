<?php
require_once realpath(__DIR__."/../foundation/FPersistentManager.php");
require_once realpath(__DIR__."/../entity/EInterestList.php");
require_once realpath(__DIR__."/../entity/EUser.php");

/**
 * Manage the interest list
 *
 * Manages the operations regarding the interest list
 *
 * @package Playerpact\Controllers
 */
class CInterestList
{
    /**
     * Check current session
     *
     * Checks if the current session is valid, that is to say if
     * the user is still in DB and if he is banned or not
     *
     * @param $session The session to check
     * 
     */
    private function checkSession($session)
    {
        $user = $session->load("user");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EUser", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
            $banned = $pm->load("EBannedUser", array("userId" => $user->getId()));
            if($banned != array()) {
                $session->end();
            }
        }
    }

    /**
     * Check if a sale post is saved
     *
     * Checks if a sale post is saved by the current user depending on the sale post id
     * and set the result for JS to 1 if it is saved, 0 otherwise.
     *
     */
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

    /**
     * Add/remove a sale post to the interest list
     *
     * Adds or remove a sale post to the interest list associated to the current user depending on
     * the sale post id. If the post was saved before the call to this function, it is removed from the interest list,
     * if the post was not saved, it is added.
     *
     */
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
