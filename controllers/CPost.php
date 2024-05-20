<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");

    class CPost {

        public function loadPosts(string $type,int $limit,int $offset,string $datetime) {

            $pm = new FPersistentManager();

            if($type == "standard") {
                $res = $pm->loadPosts("EPostStandard",$limit,$offset,$datetime);
            } elseif($type == "sell") {
                $res = $pm->loadPosts("EPostSell",$limit,$offset,$datetime);
            } elseif($type == "team") {
                $res = $pm->loadPosts("EPostTeam",$limit,$offset,$datetime);
            }
            
            $count = count($res);
            return array($res,$count);
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