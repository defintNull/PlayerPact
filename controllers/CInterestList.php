<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EInterestList.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");

    class CInterestList {

        public function home() {

        }

        public function viewInterestListSection(int $userId) {

        }

        public function issaved(){
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
            
            $postSellId = $_POST["postSellId"];
            $pm = new FPersistentManager();

            if($pm->load("EInterestList", array("userId" => $user->getId(), "postSellId" => $postSellId)) != array()){
                echo 1;
            } else {
                echo 0;
            }
        }

        public function add() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
            
            $postSellId = $_POST["postSellId"];

            $pm = new FPersistentManager();
            $interest = new EInterestList($user->getId(), $postSellId);
            if($pm->load("EInterestList", array("userId" => $user->getId(), "postSellId" => $postSellId)) == array()){
                $pm->store($interest);
            } else {
                $pm->delete("EInterestList", array("userId" => $user->getId(), "postSellId" => $postSellId));
            }
            
        
        }

        public function removeProductFromList(int $userId, int $postId) {
            
        }

    }
?>