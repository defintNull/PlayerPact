<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostStandard.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostSell.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostTeam.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChat.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChatUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChatUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EComment.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EReport.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EParticipation.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VPost.php");

    class CPost {

        public function home() {
            $this->standard();
        }

        public function loadStandardPosts(int $offset,int $limit,string $datetime) {

            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElements("EPostStandard",$limit,$offset,$datetime);
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

            $res = $pm->loadElements("EPostSell",$limit,$offset,$datetime);
            //echo var_dump($res);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $post = new EPostSell($res[$i]["id"],$res[$i]["iduser"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"],$res[$i]["price"],$res[$i]["image"]);
                $userdata = $pm->load("EUser", array("id" => $post->getIdUser()));
                //echo var_dump($post->getImage());
                //Questo controllo teoricamente è inutile perché dopo non esisterà post senza utente
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
                        "image" => base64_encode($post->getImage())
                    );
                } else {
                    $values[] = array(
                        "id" => $post->getId(),
                        "title" => $post->getTitle(),
                        "description" => $post->getDescription(),
                        "datetime" => $post->getDateTime(),
                        "price" => $post->getPrice(),
                        "image" => base64_encode($post->getImage())
                    );
                }
            }
            //echo var_dump(array($values,$count));
            return array($values,$count);
        }

        public function loadTeamPosts(int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElements("EPostTeam",$limit,$offset,$datetime);
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
                $username = $user->getUsername();
            } else {
                $username = null;
            }

            $params = array("type" => "standard",
                            "authenticated" => $authenticated,
                            "username" => $username);
            $view->show($params);
        }

        public function sell() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            if($user != null){
                $authenticated = true;
                $username = $user->getUsername();
            } else {
                $username = null;
            }

            $params = array("type" => "sell",
                            "authenticated" => $authenticated,
                            "username" => $username);
            $view->show($params);
        }

        public function team() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            if($user != null){
                $authenticated = true;
                $username = $user->getUsername();
            } else {
                $username = null;
            }

            $params = array("type" => "team",
                            "authenticated" => $authenticated,
                            "username" => $username);
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
                $username = $sessionUser->getUsername();
            } else {
                $username = null;
            }

            $view = new VPost();
            $params = array("postId" => $res["id"],
                            "postUsername" => $user["username"],
                            "postTitle" => $res["title"],
                            "postDescription" => $res["description"],
                            "postDatetime" => $res["datetime"],
                            "authenticated" => $authenticated,
                            "username" => $username);
            $view->showComments($params);
        }

        public function loadComments(int $idpost,int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElementsById("EComment",$idpost,$limit,$offset,$datetime);
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
                $values = $_POST["sell"];
                
                $image = null;
                if (isset($_FILES['sell']['name']['image']) && $_FILES['sell']['error']['image'] == 0) {
                    $file_tmp_path = $_FILES['sell']['tmp_name']['image'];
                    $file_name = $_FILES['sell']['name']['image'];
                    $file_size = $_FILES['sell']['size']['image']; // in byte

                    if($file_size > 5*1024*1024){
                        header("Location: /post/create?info=tooBig"); // Aggiungere messaggio a schermo
                        exit();
                    }
            
                    $allowedfileExtensions = array('jpg', 'jpeg', 'png');
                    $file_name_cmps = explode(".", $file_name);
                    $file_extension = strtolower(end($file_name_cmps));
            
                    if (in_array($file_extension, $allowedfileExtensions)) {
                        $image = addslashes(file_get_contents($file_tmp_path));
                    } else{
                        header("Location: /post/create?info=error");
                        exit();
                    }
                } else{
                    header("Location: /post/create?info=error");
                    exit();
                }
                $datetime = date("Y-m-d H:i:s");
                $post = new EPostSell(1, $idUser, $values["title"], $values["description"], $datetime, $values["price"], $image);
                $pm->store($post);
                $params = array(
                    "iduser" => $idUser,
                    "title" => $values["title"],
                    "description" => $values["description"],
                    "datetime" => $datetime,
                    "price" => $values["price"],
                    "image" => $image

                );
                
                header("Location: /post/sell");
                exit();

            } else if (isset($_POST["team"])){
                $values = $_POST["team"];

                $datetime = date("Y-m-d H:i:s");
                $post = new EPostTeam(1, $idUser, $values["title"], $values["description"], $datetime, $values["nMaxPlayer"], $values["nPlayers"], $values["time"]);
                $pm->store($post);

                $params = array(
                    "iduser" => $idUser,
                    "title" => $values["title"],
                    "description" => $values["description"],
                    "datetime" => $datetime,
                    "nMaxPlayer" => $values["nMaxPlayer"],
                    "nPlayers" => $values["nPlayers"],
                    "time" => $values["time"]

                );
                $idpostteam = $pm->load("EPostTeam",$params)[0]["id"];

                $participation = new EParticipation($idUser, $idpostteam);
                $pm->store($participation);

                $chat = new EChat(1,$idpostteam,null,$datetime);
                $pm->store($chat);

                $params = array(
                    "idpostteam" => $idpostteam,
                    "idpostsell" => 0,
                    "datetime" => $datetime
                );
                
                $idchat = $pm->load("EChat",$params)[0]["id"];

                $chatuser = new EChatUser(null,$idchat,$idUser,$datetime);
                
                $pm->store($chatuser);

                header("Location: /post/team");
                exit();
            }
        }

        public function get_image(int $id){
            $pm = new FPersistentManager();
            $image = $pm->load("EPostSell", array("id" => $id));

            if($image == null) {
                header("Location: /error/e404");
                exit();
            }

            $image = $image[0]["image"];
            
            $view = new VPost();
            $imageURL = "data:image/png;base64,".base64_encode($image);
            $view->showImage($imageURL);
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

            $comment = new EComment(1, $_POST["postId"], $idUser, $_POST["comment"], date("Y-m-d H:i:s"));
            $pm->store($comment);

            header("Location: /post/comments?id=".$_POST["postId"]);
            exit();
        }

        public function report() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $objToReportId = $_POST["objToReportId"];
            $objToReportType = $_POST["objToReportType"];
            $view = new VPost();
            $params = array("objToReportId" => $objToReportId,
                            "objToReportType" => $objToReportType);
            $view->showReportPage($params);
        }

        public function confirmReport() {
            //Controllo aggiuntivo, valutare se serve
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $description = $_POST["description"];
            $objId = $_POST["objToReportId"];
            $objType = $_POST["objToReportType"];

            if($description == "" || strlen($description) > 256){ // Se la lunghezza massima è maggiore di 256 va rimandato alla report ma bisogna passargli i parametri del commento da segnalare
                header("Location: /post/standard");
                exit();
            }

            $allowedTypes = array("standard", "team", "sell", "comment");

            if(!in_array($objType, $allowedTypes)) {
                header("Location: /error/e404");
                exit();
            }

            $pm = new FPersistentManager();
            $report = new EReport(1, $user->getId(), $objId, $objType, $description, date("Y-m-d H:i:s"));
            $pm->store($report);

            if(strcmp($objType, "comment") == 0){
                $comment = $pm->load("EComment", array("id" => $objId))[0];
                $postId = $pm->load("EPostStandard", array("id" => $comment["idpoststandard"]))[0]["id"];
                header("Location: /post/comments?id=".$postId);
                exit();
            } else {
                header("Location: /post/".$objType);
                exit();
            }
        }

        public function participate() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
            
            $teamPostId = $_POST["teamPostId"];

            $pm = new FPersistentManager();
            $participation = new EParticipation($user->getId(), $teamPostId);
            $idchat = $pm->load("EChat", array(
                "idpostteam" => $teamPostId,
                "idpostsell" => 0,
            ))[0]["id"];

            if($pm->load("EParticipation", array("userId" => $user->getId(), "teamPostId" => $teamPostId)) == array()){
                $pm->store($participation);

                $datetime = date("Y-m-d H:i:s");
                $chatuser = new EChatUser(null,$idchat,$user->getId(),$datetime);
                $pm->store($chatuser);

            } else {
                $pm->delete("EParticipation", array("userId" => $user->getId(), "teamPostId" => $teamPostId));
                $pm->delete("EChatUser", array(
                    "idchat" => $idchat,
                    "iduser" => $user->getId()
                ));
            }
        }

        public function isparticipating(){
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
            
            $teamPostId = $_POST["teamPostId"];
            $pm = new FPersistentManager();

            if($pm->load("EParticipation", array("userId" => $user->getId(), "teamPostId" => $teamPostId)) != array() and $pm->load("EPostTeam", array("id"=>$teamPostId))[0]["iduser"] != $user->getId()){
                echo 1;
            } elseif($pm->load("EPostTeam", array("id"=>$teamPostId))[0]["iduser"] == $user->getId()) {
                echo 2;
            } else {
                echo 0;
            }
        }

        public function buy() {
                
            $pm = new FPersistentManager();

            $idpostsell = $_POST["sellPostId"];

            $datetime = date("Y-m-d H:i:s");
            $chat = new EChat(1,null,$idpostsell,$datetime);
            $pm->store($chat);

            $params = array(
                "idpostteam" => 0,
                "idpostsell" => $idpostsell,
                "datetime" => $datetime
            );
            
            $idchat = $pm->load("EChat",$params)[0]["id"];

            $idproprietary = $pm->load("EPostSell",array("id" => $idpostsell))[0]["iduser"];

            $chatuser = new EChatUser(null,$idchat,$idproprietary,$datetime);            
            $pm->store($chatuser);

            $session = USession::getInstance();
            $iduser = $session->load("user")->getId();
            $chatuser = new EChatUser(null,$idchat,$iduser,$datetime);
            
            
            $pm->store($chatuser);
            header("Location: /user/chats");
        }
    }
?>