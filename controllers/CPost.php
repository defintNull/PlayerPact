<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostStandard.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");

    class CPost {

        public function loadPosts(string $type,int $offset,int $limit,string $datetime) {

            $pm = new FPersistentManager();
            $values = array();

            if($type == "standard") {
                $res = $pm->loadPosts("EPostStandard",$limit,$offset,$datetime);
                $count = count($res);

                for($i=0;$i<$count;$i++) {

                    $post = new EPostStandard($res[$i]["id"],$res[$i]["iduser"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"]);
                    $userdata = $pm->load("EUser", array("id" => $post->getIdUser()));
                    
                    if(count($userdata) !== 0) {
                        $userdata = $userdata[0];
                        $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                        $values[] = array(
                            "id" => $post->getId(),
                            "iduser" => $user->getUsername(),
                            "title" => $post->getTitle(),
                            "description" => $post->getDescription(),
                            "datetime" => $post->getDateTime()
                        );
                    } else {
                        $values[] = array(
                            "id" => $post->getId(),
                            "title" => $post->getTitle(),
                            "description" => $post->getDescription(),
                            "datetime" => $post->getDateTime()
                        );
                    }
                
                }
            
            } elseif($type == "sell") {
                $res = $pm->loadPosts("EPostSell",$limit,$offset,$datetime);
                $count = count($res);
            } elseif($type == "team") {
                $res = $pm->loadPosts("EPostTeam",$limit,$offset,$datetime);
                $count = count($res);
            }
            
            return array($values,$count);
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