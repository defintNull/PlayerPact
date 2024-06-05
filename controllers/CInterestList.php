<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EInterestList.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");

    class CInterestList {

        public function home() {

        }

        public function viewInterestListSection(int $idUser) {

        }

        public function issaved(){
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
            
            $sellPostId = $_POST["sellPostId"];
            $pm = new FPersistentManager();

            if($pm->load("EInterestList", array("userId" => $user->getId(), "sellPostId" => $sellPostId)) != array()){
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
            
            $sellPostId = $_POST["sellPostId"];

            $pm = new FPersistentManager();
            $interest = new EInterestList($user->getId(), $sellPostId);
            if($pm->load("EInterestList", array("userId" => $user->getId(), "sellPostId" => $sellPostId)) == array()){
                $pm->store($interest);
            } else {
                $pm->delete("EInterestList", array("userId" => $user->getId(), "sellPostId" => $sellPostId));
            }
            
        
        }

        public function removeProductFromList(int $idUser, int $idPost) {
            
        }

    }
?>