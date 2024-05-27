<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostStandard.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostSell.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostTeam.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EComment.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VPost.php");

    class CPost {

        public function home() {
            $view = new VPost();
            $view->show("standard");
        }

        public function loadStandardPosts(int $offset,int $limit,string $datetime) {

            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadPosts("EPostStandard",$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $post = new EPostStandard($res[$i]["id"],$res[$i]["iduser"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $post->getIdUser()));
                
                //DA CORREGGERE
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

            return array($values,$count);

        }

        public function loadSellPosts(int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadPosts("EPostSell",$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $post = new EPostSell($res[$i]["id"],$res[$i]["iduser"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"],$res[$i]["price"],$res[$i]["image"]);
                $userdata = $pm->load("EUser", array("id" => $post->getIdUser()));
                
                if(count($userdata) !== 0) {
                    $userdata = $userdata[0];
                    $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                    $values[] = array(
                        "id" => $post->getId(),
                        "iduser" => $user->getUsername(),
                        "title" => $post->getTitle(),
                        "description" => $post->getDescription(),
                        "datetime" => $post->getDateTime(),
                        "price" => $post->getPrice(),
                        "image" => $post->getImage()
                    );
                } else {
                    $values[] = array(
                        "id" => $post->getId(),
                        "title" => $post->getTitle(),
                        "description" => $post->getDescription(),
                        "datetime" => $post->getDateTime(),
                        "price" => $post->getPrice(),
                        "image" => $post->getImage()
                    );
                }
            }
            return array($values,$count);
        }

        public function loadTeamPosts(int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadPosts("EPostTeam",$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $post = new EPostTeam($res[$i]["id"],$res[$i]["iduser"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"],$res[$i]["nMaxPlayer"],$res[$i]["nPlayers"],$res[$i]["time"]);
                $userdata = $pm->load("EUser", array("id" => $post->getIdUser()));
                
                if(count($userdata) !== 0) {
                    $userdata = $userdata[0];
                    $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                    $values[] = array(
                        "id" => $post->getId(),
                        "iduser" => $user->getUsername(),
                        "title" => $post->getTitle(),
                        "description" => $post->getDescription(),
                        "datetime" => $post->getDateTime(),
                        "nMaxPlayers" => $post->getNMaxPlayers(),
                        "nPlayers" => $post->getNPlayers(),
                        "time" => $post->getTime()
                    );
                } else {
                    $values[] = array(
                        "id" => $post->getId(),
                        "title" => $post->getTitle(),
                        "description" => $post->getDescription(),
                        "datetime" => $post->getDateTime(),
                        "nMaxPlayers" => $post->getNMaxPlayers(),
                        "nPlayers" => $post->getNPlayers(),
                        "time" => $post->getTime()
                    );
                }
            
            }

            return array($values,$count);
        }

        public function viewPostSection(int $idSection) {

        }

        public function standard() {
            $view = new VPost();
            $view->show("standard");
        }

        public function sell() {
            $view = new VPost();
            $view->show("sell");
        }

        public function team() {
            $view = new VPost();
            $view->show("team");
        }

        public function comments(int $id) {
            $pm = new FPersistentManager();
            $res = $pm->loadPost("EPostStandard", $id);
            $user = $pm->loadUser($res["iduser"]);

            $view = new VPost();
            $view->showComments($res["id"],$user["username"],$res["title"],$res["description"],$res["datetime"]);
        }

        public function loadComments(int $idpost,int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadComments($idpost,$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $comment = new EComment($res[$i]["id"],$res[$i]["idpoststandard"],$res[$i]["iduser"],$res[$i]["description"],$res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $comment->getIdUser()));
                
                if(count($userdata) !== 0) {
                    $userdata = $userdata[0];
                    $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                    $values[] = array(
                        "id" => $comment->getId(),
                        "user" => $user->getUsername(),
                        "description" => $comment->getDescription(),
                        "datetime" => $comment->getDateTime()
                    );
                } else {
                    $values[] = array(
                        "id" => $comment->getId(),
                        "description" => $comment->getDescription(),
                        "datetime" => $comment->getDateTime()
                    );
                }
            
            }

            return array($values,$count);
        }

        public function createPost() {

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