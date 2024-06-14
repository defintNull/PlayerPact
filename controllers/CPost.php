<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostStandard.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EPostSale.php");
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

                $post = new EPostStandard($res[$i]["id"],$res[$i]["userId"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $post->getUserId()));
                
                //DA CORREGGERE
                if(count($userdata) !== 0) {
                    $userdata = $userdata[0];
                    $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                    $values[] = array(
                        "id" => $post->getId(),
                        "userId" => $user->getUsername(),
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

        public function loadSalePosts(int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElements("EPostSale",$limit,$offset,$datetime);
            //echo var_dump($res);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $post = new EPostSale($res[$i]["id"],$res[$i]["userId"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"],$res[$i]["price"],$res[$i]["image"]);
                $userdata = $pm->load("EUser", array("id" => $post->getuserId()));
                //echo var_dump($post->getImage());
                //Questo controllo teoricamente è inutile perché dopo non esisterà post senza utente
                if(count($userdata) !== 0) {
                    $userdata = $userdata[0];
                    $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                    $values[] = array(
                        "id" => $post->getId(),
                        "userId" => $user->getUsername(),
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

                $post = new EPostTeam($res[$i]["id"],$res[$i]["userId"],$res[$i]["title"],$res[$i]["description"],$res[$i]["datetime"],$res[$i]["nMaxPlayers"],$res[$i]["nPlayers"],$res[$i]["time"]);
                $userdata = $pm->load("EUser", array("id" => $post->getuserId()));
                
                if(count($userdata) !== 0) {
                    $userdata = $userdata[0];
                    $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                    $values[] = array(
                        "id" => $post->getId(),
                        "userId" => $user->getUsername(),
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

        public function standard() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            $username = null;
            $PPImageURL = "/public/defaultPropic.png";                
            if($user != null){
                $authenticated = true;
                $username = $user->getUsername();
                if($user->getImage() != "") {
                    $PPImageURL = "data:image/png;base64,".base64_encode($user->getImage());
                }
            }

            $params = array("type" => "standard",
                            "authenticated" => $authenticated,
                            "username" => $username,
                            "profilePicture" => $PPImageURL);
            $view->show($params);
        }

        public function sale() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            $username = null;
            $PPImageURL = "/public/defaultPropic.png";
            if($user != null){
                $authenticated = true;
                $username = $user->getUsername();
                if($user->getImage() != "") {
                    $PPImageURL = "data:image/png;base64,".base64_encode($user->getImage());
                }
            }

            $params = array("type" => "sale",
                            "authenticated" => $authenticated,
                            "username" => $username,
                            "profilePicture" => $PPImageURL);
            $view->show($params);
        }

        public function team() {
            $view = new VPost();
            $session = USession::getInstance();
            $user = $session->load("user");

            $authenticated = false;
            $username = null;
            $PPImageURL = "/public/defaultPropic.png"; 
            if($user != null){
                $authenticated = true;
                $username = $user->getUsername();
                if($user->getImage() != ""){
                    $PPImageURL = "data:image/png;base64,".base64_encode($user->getImage());
                }
            }

            $params = array("type" => "team",
                            "authenticated" => $authenticated,
                            "username" => $username,
                            "profilePicture" => $PPImageURL);
            $view->show($params);
        }

        public function comments(int $id) {
            $pm = new FPersistentManager();
            $res = $pm->load("EPostStandard", array("id" => $id))[0];
            $user = $pm->load("EUser", array("id" => $res["userId"]))[0];

            $session = USession::getInstance();
            $sessionUser = $session->load("user");

            $authenticated = false;
            $username = null;
            $PPImageURL = "/public/defaultPropic.png";
            if($sessionUser != null){
                $authenticated = true;
                $username = $sessionUser->getUsername();
                if($sessionUser->getImage() != "") {
                    $PPImageURL = "data:image/png;base64,".base64_encode($sessionUser->getImage());
                }
            }

            $view = new VPost();
            $params = array("postId" => $res["id"],
                            "postUsername" => $user["username"],
                            "postTitle" => $res["title"],
                            "postDescription" => $res["description"],
                            "postDatetime" => $res["datetime"],
                            "authenticated" => $authenticated,
                            "username" => $username,
                            "profilePicture" => $PPImageURL);
            $view->showComments($params);
        }

        public function loadComments(int $postId,int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElementsById("EComment",$postId,$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $comment = new EComment($res[$i]["id"],$res[$i]["postStandardId"],$res[$i]["userId"],$res[$i]["description"],$res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $comment->getUserId()));
                
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
            $userId = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];

            // Ho aggiunto così il controllo sui campi (se un campo presenta problemi, si scrive solo che c'è stato un problema)
            if(!$this->checkNewPostFields()){
                header("Location: /post/create?info=error");
                exit();
            }

            if (isset($_POST["standard"])){
                $values = $_POST["standard"];

                // Creazione dei post standard
                $post = new EPostStandard(1, $userId, $values["title"], $values["description"], date("Y-m-d H:i:s"));
                $pm->store($post);

                header("Location: /post/standard");
                exit();

            } else if (isset($_POST["sale"])){
                $values = $_POST["sale"];
                
                $image = null;
                if (isset($_FILES['sale']['name']['image']) && $_FILES['sale']['error']['image'] == 0) {
                    $file_tmp_path = $_FILES['sale']['tmp_name']['image'];
                    $file_name = $_FILES['sale']['name']['image'];
                    $file_size = $_FILES['sale']['size']['image']; // in byte

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

                // Creazione del post sale
                $post = new EPostSale(1, $userId, $values["title"], $values["description"], $datetime, $values["price"], $image);
                $pm->store($post);
                
                header("Location: /post/sale");
                exit();

            } else if (isset($_POST["team"])){
                $values = $_POST["team"];
                $datetime = date("Y-m-d H:i:s");

                //Creazione del post team
                $post = new EPostTeam(1, $userId, $values["title"], $values["description"], $datetime, $values["nMaxPlayer"], $values["nPlayers"], $values["time"]);
                $postTeamId = $pm->store($post);

                // Creazione della partecipazione
                $participation = new EParticipation($userId, $postTeamId);
                $pm->store($participation);

                // Creazione della chat
                $chat = new EChat(0, $postTeamId, "team", $datetime);
                $chatId = $pm->store($chat);

                // Creazione del legame chat-user
                $chatuser = new EChatUser($chatId, $userId, $datetime);
                $pm->store($chatuser);

                header("Location: /post/team");
                exit();
            }
        }

        public function get_image($id){
            if(!is_numeric($id) || intval($id) != $id){
                header("Location: /error/404");
            }

            $pm = new FPersistentManager();
            $postSale = $pm->load("EPostSale", array("id" => $id));

            if($postSale == null) {
                header("Location: /error/e404");
                exit();
            }

            $image = $postSale[0]["image"];
            
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
            } else if (isset($_POST["sale"])){
                $values = $_POST["sale"];
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
            $userId = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];

            $comment = new EComment(1, $_POST["postId"], $userId, $_POST["comment"], date("Y-m-d H:i:s"));
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

            $allowedTypes = array("standard", "team", "sale", "comment");

            if(!in_array($objType, $allowedTypes)) {
                header("Location: /error/e404");
                exit();
            }

            $pm = new FPersistentManager();
            $report = new EReport(1, $user->getId(), $objId, $objType, $description, date("Y-m-d H:i:s"));
            $pm->store($report);

            if(strcmp($objType, "comment") == 0){
                $comment = $pm->load("EComment", array("id" => $objId))[0];
                $postId = $pm->load("EPostStandard", array("id" => $comment["postStandardId"]))[0]["id"];
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
            
            $postTeamId = $_POST["postTeamId"];

            $pm = new FPersistentManager();
            $chatId = $pm->load("EChat", array("postId" => $postTeamId, "postType" => "team"))[0]["id"];

            if($pm->load("EParticipation", array("userId" => $user->getId(), "postTeamId" => $postTeamId)) == array()){
                $participation = new EParticipation($user->getId(), $postTeamId);
                $pm->store($participation);
                $datetime = date("Y-m-d H:i:s");
                $chatuser = new EChatUser($chatId, $user->getId(), $datetime);
                $pm->store($chatuser);
            } else {
                $pm->delete("EParticipation", array("userId" => $user->getId(), "postTeamId" => $postTeamId));
                $pm->delete("EChatUser", array("chatId" => $chatId,"userId" => $user->getId()));
            }
        }

        public function isparticipating(){
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
            
            $postTeamId = $_POST["postTeamId"];
            $pm = new FPersistentManager();

            if($pm->load("EParticipation", array("userId" => $user->getId(), "postTeamId" => $postTeamId)) != array() and $pm->load("EPostTeam", array("id"=>$postTeamId))[0]["userId"] != $user->getId()){
                echo 1;
            } elseif($pm->load("EPostTeam", array("id"=>$postTeamId))[0]["userId"] == $user->getId()) {
                echo 2;
            } else {
                echo 0;
            }
        }

        public function buy() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }
                
            $pm = new FPersistentManager();
            $postSaleId = $_POST["postSaleId"];
            $post = $pm->load("EPostSale", array("id" => $postSaleId))[0];

            $chat = $pm->load("EChat", array("postId" => $postSaleId, "postType" => "sale"));

            // Se esiste una chat relativa a quel post, controllo se l'utente non è già nella chat e se non è colui che ha
            // creato il post
            $exists = false;
            //echo count($chat);
            if($chat != null){
                for($i = 0; $i < count($chat); $i++){
                    $chatId = $chat[$i]["id"];
                    $chatUser = $pm->load("EChatUser", array("chatId" => $chatId));

                    $users = array();
                    for($j = 0; $j < count($chatUser); $j++){
                        $users[] = $chatUser[$j]["userId"];
                    }

                    if(in_array($user->getId(), $users)){
                        $exists = true;
                        break;
                    }
                }
            }

            if(!$exists && $user->getId() != $post["userId"]){
                $datetime = date("Y-m-d H:i:s");
                $chat = new EChat(0, $postSaleId, "sale" ,$datetime);
                $chatId = $pm->store($chat);
    
                $idOwner = $pm->load("EPostSale",array("id" => $postSaleId))[0]["userId"];
                $chatUser = new EChatUser($chatId, $idOwner, $datetime);            
                $pm->store($chatUser);
    
                $userId = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];
                $chatUser = new EChatUser($chatId, $userId, $datetime);
                $pm->store($chatUser);
            }

            header("Location: /user/chats");
            exit();
        }

        public function isBought() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $postSaleId = $_POST["postSaleId"];
            $pm = new FPersistentManager();

            $post = $pm->load("EPostSale", array("id" => $postSaleId))[0];
            if($user->getId() == $post["userId"]) {
                echo 2;
                exit();
            }

            $chat = $pm->load("EChat", array("postId" => $postSaleId, "postType" => "sale"));

            $exists = 0;
            if($chat != null){
                for($i = 0; $i < count($chat); $i++){
                    //echo $postSaleId." ".$i."\n";
                    $chatId = $chat[$i]["id"];
                    $chatUser = $pm->load("EChatUser", array("chatId" => $chatId));

                    $users = array();
                    for($j = 0; $j < count($chatUser); $j++){
                        $users[] = $chatUser[$j]["userId"];
                    }

                    if(in_array($user->getId(), $users)){
                        $exists = 1;
                        break;
                    }
                }
            }

            echo $exists;
        }
    }
?>