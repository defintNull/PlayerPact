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
            $this->standard();
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
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            $createPostLink = "/login";
            if($user != null){
                $authenticated = true;
                $createPostLink = "/post/create";
            }

            $params = array("type" => "standard",
                            "authenticated" => $authenticated,
                            "createPostLink" => $createPostLink);
            $view->show($params);
        }

        public function sell() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            $createPostLink = "/login";
            if($user != null){
                $authenticated = true;
                $createPostLink = "/post/create";
            }

            $params = array("type" => "sell",
                            "authenticated" => $authenticated,
                            "createPostLink" => $createPostLink);
            $view->show($params);
        }

        public function team() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            $createPostLink = "/login";
            if($user != null){
                $authenticated = true;
                $createPostLink = "/post/create";
            }

            $params = array("type" => "team",
                            "authenticated" => $authenticated,
                            "createPostLink" => $createPostLink);
            $view->show($params);
        }

        public function comments(int $id) {
            $pm = new FPersistentManager();
            $res = $pm->load("EPostStandard", array("id" => $id))[0];
            $user = $pm->load("EUser", array("id" => $res["iduser"]))[0];

            $session = USession::getInstance();
            $sessionUser = $session->load("user");

            $authenticated = false;
            $createPostLink = "/login";
            if($sessionUser != null){
                $authenticated = true;
                $createPostLink = "/post/create";
            }

            $view = new VPost();
            $params = array("postId" => $res["id"],
                            "username" => $user["username"],
                            "title" => $res["title"],
                            "description" => $res["description"],
                            "datetime" => $res["datetime"],
                            "authenticated" => $authenticated,
                            "createPostLink" => $createPostLink);
            $view->showComments($params);
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

        public function create() {
            $view = new VPost();
            $view->showSelectNewPost();
        }        

        public function confirmCreation() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /error/e404");
                exit();
            }

            $pm = new FPersistentManager();
            $idUser = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];

            // Bisogna aggiungere il controllo sui campi
            if (isset($_POST["standard"])){
                $values = $_POST["standard"];
                $post = new EPostStandard(1, $idUser, $values["title"], $values["description"], date("Y-m-d H:i:s"));
                $pm->store($post);

                header("Location: /post/standard");
                exit();

            } else if (isset($_POST["sell"])){
                $values = $_POST["sell"]; // OCCORRE FARE IL CARICAMENTO DELL'IMMAGINE!
                
                $post = new EPostSell(1, $idUser, $values["title"], $values["description"], date("Y-m-d H:i:s"), $values["price"], $values["image"]);
                $pm->store($post);

                header("Location: /post/sell");
                exit();

            } else if (isset($_POST["team"])){
                $values = $_POST["team"];

                $post = new EPostTeam(1, $idUser, $values["title"], $values["description"], date("Y-m-d H:i:s"), $values["nMaxPlayer"], $values["nPlayers"], $values["time"]);
                $pm->store($post);

                header("Location: /post/team");
                exit();
            }
        }

        public function addComment(int $idUser, int $idPost, string $description) {

        }

        public function participate(int $idPost) {

        }

        public function buy() {
            
        }
    }
?>