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