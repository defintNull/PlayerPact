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
                        "nMaxPlayers" => $post->getNMaxPlayer(),
                        "nPlayers" => $post->getNPlayers(),
                        "time" => $post->getTime()
                    );
                } else {
                    $values[] = array(
                        "id" => $post->getId(),
                        "title" => $post->getTitle(),
                        "description" => $post->getDescription(),
                        "datetime" => $post->getDateTime(),
                        "nMaxPlayers" => $post->getNMaxPlayer(),
                        "nPlayers" => $post->getNPlayers(),
                        "time" => $post->getTime()
                    );
                }
            
            }

            return array($values,$count);
        }

        public function standard() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            if($user != null){
                $authenticated = true;
            }

            $params = array("type" => "standard",
                            "authenticated" => $authenticated);
            $view->show($params);
        }

        public function sell() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            if($user != null){
                $authenticated = true;
            }

            $params = array("type" => "sell",
                            "authenticated" => $authenticated);
            $view->show($params);
        }

        public function team() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            if($user != null){
                $authenticated = true;
            }

            $params = array("type" => "team",
                            "authenticated" => $authenticated);
            $view->show($params);
        }

        public function comments(int $id) {
            $pm = new FPersistentManager();
            $res = $pm->load("EPostStandard", array("id" => $id))[0];
            $user = $pm->load("EUser", array("id" => $res["iduser"]))[0];

            $session = USession::getInstance();
            $sessionUser = $session->load("user");

            $authenticated = false;
            if($sessionUser != null){
                $authenticated = true;
            }

            $view = new VPost();
            $params = array("postId" => $res["id"],
                            "username" => $user["username"],
                            "posttitle" => $res["title"],
                            "description" => $res["description"],
                            "datetime" => $res["datetime"],
                            "authenticated" => $authenticated);
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

        public function create($info = "ok") {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $view = new VPost();
            $view->showSelectNewPost($info);
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

            // Ho aggiunto così il controllo sui campi (se un campo presenta problemi, si scrive solo che c'è stato un problema)
            if(!$this->checkNewPostFields()){
                header("Location: /post/create?info=error");
                exit();
            }

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

        private function checkNewPostFields(){
            if(isset($_POST["standard"])){
                $values = $_POST["standard"];
                foreach($values as $key => $val){
                    if($val == ""){
                        return false;
                    }
                }
            } else if (isset($_POST["sell"])){
                $values = $_POST["sell"];
                foreach($values as $key => $val){
                    if($val == ""){
                        return false;
                    }
                }
                if(!is_numeric($values["price"])){
                    return false;
                }
            } else if (isset($_POST["team"])){
                $values = $_POST["team"];
                foreach($values as $key => $val){
                    if($val == ""){
                        return false;
                    }
                }
                if(!is_numeric($values["nMaxPlayer"])){
                    return false;
                }
                if(!is_numeric($values["nPlayers"])){
                    return false;
                }
                if($values["nPlayers"] >= $values["nMaxPlayer"] || $values["nMaxPlayer"] <= 1 || $values["nPlayers"] <= 0){
                    return false;
                }
            }
            return true;
        }

        public function addcomment() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            if($_POST["comment"] == ""){
                header("Location: /post/comments?id=".$_POST["postId"]);
                exit();
            }

            $pm = new FPersistentManager();
            $idUser = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];

            $comment = new EComment(1, $_POST["postId"], $idUser, $_POST["comment"], date("Y-m-d H:m:s"));
            $pm->store($comment);

            header("Location: /post/comments?id=".$_POST["postId"]);
            exit();
        }

        public function participate(int $idPost) {

        }

        public function buy() {
            
        }
    }
?>