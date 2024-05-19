<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");

    class CPost {
        
        // Funzione che restituisce elementi del database in base ai parametri
        public function loadFromDB(string $class, int $offset, int $limit) {
            try{
                $pm = new FPersistentManager();
                $res = $pm->load("E".$class, "TRUE ORDER BY id DESC LIMIT ".$limit." OFFSET ".$offset);
                return $res;
            } catch(Exception $e){
                return $e;
            }
        }

        public function loadPosts(string $type,int $limit,int $offset,string $datetime) {

            $pm = new FPersistentManager();

            if($type == "standard") {
                $res = $pm->loadElements("EPostStandard",$limit,$offset,$datetime);
            } elseif($type == "sell") {
                $res = $pm->loadElements("EPostSell",$limit,$offset,$datetime);
            } elseif($type == "team") {
                $res = $pm->loadElements("EPostTeam",$limit,$offset,$datetime);
            }

            return $res;
        }

        public function viewPostSection(int $idSection) {

        }

        public function createPost() {

        }

        public function viewComments(int $idPost) {

        }

        public function selectPost(int $postType) {

        }

        public function confirmCreationStandard(string $title, string $description, int $idUser) {

        }

        public function confirmCreationTeam(string $title, string $description, int $idUser, int $maxPlayer, float $price) {

        }

        public function confirmCreationSell(string $title, string $description, int $idUser, float $price, string $image) {

        }

        public function addComment(int $idUser, int $idPost, string $description) {

        }

        public function participate(int $idPost) {

        }

        public function buy() {
            
        }
    }
?>