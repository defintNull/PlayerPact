<?php

use Smarty\Compile\PrintExpressionCompiler;

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EMessage.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChat.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChatUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EProfile.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");

    class CUser {
        public function home() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            $authenticated = false;
            $PPImageURL = "/public/defaultPropic.png";
            $params = array();

            if($user != null){
                $username = $user->getUsername();
                $authenticated = true;

                if($user->getImage() != ""){
                    $PPImageURL = "data:image/png;base64,".base64_encode($user->getImage());
                }
            }

            $view = new VUser();
            $params = array("authenticated" => $authenticated,
                            "username" => $username,
                            "profilePicture" => $PPImageURL);
            $view->showHome($params);
        }

        public function profile() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showProfile($params);
        }

        public function saved() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showProfile($params);
        }

        public function participated() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username);
            $view->showProfile($params);
        }

        public function chats() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }

            $username = $user->getUsername();
            $view = new VUser();
            $params = array(
                "username" => $username
            );
            $view->showChatSection($params);
        }

        public function loadChats(string $username,int $offset,int $limit,string $datetime) {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $pm = new FPersistentManager();
            $values = array();
            
            $userId = $pm->load("EUser", array("username" => $username))[0]["id"];

            // Prendo tutte le chat relative all'utente attuale loggato
            $chatusers = $pm->load("EChatUser", array("userId" => $userId));
            
            // Se non ci sono chat passa valori nulli al js
            if(count($chatusers) == 0) {
                return array(null, 0);
            }

            $chatIds = array();
            
            foreach($chatusers as $key => $chatuserelement) {
                $chatIds[] = array("id" => $chatuserelement["chatId"]);
            }

            $res = $pm->loadElementsByGroup("EChat", $chatIds, $limit, $offset, $datetime);
            $count = count($res);

            for($i = 0; $i < $count; $i++) {
                $chat = new EChat($res[$i]["id"], $res[$i]["postId"], $res[$i]["postType"], $res[$i]["datetime"]);
                //echo var_dump($chat);
                $values[$i]["id"] = $chat->getId();
                $values[$i]["datetime"] = $chat->getDateTime();

                if($chat->getPostType() == "team") {
                    $posttitle = $pm->load("EPostTeam", array("id" => $chat->getPostId()))[0]["title"];
                    $values[$i]["posttitle"] = $posttitle;
                    $values[$i]["username"] = null;

                } else if ($chat->getPostType() == "sale") {
                    $posttitle = $pm->load("EPostSale", array("id" => $chat->getPostId()))[0]["title"];
                    $values[$i]["posttitle"] = $posttitle;
                    $chatUserId = $pm->load("EChatUser", array("chatId" => $chat->getId()));

                    if($chatUserId[0]["userId"] == $user->getId()) {
                        $chatUserId = $chatUserId[1]["userId"];
                    } else {   
                        $chatUserId = $chatUserId[0]["userId"];
                    }

                    $username = $pm->load("EUser", array("id" => $chatUserId))[0]["username"];
                    $values[$i]["username"] = $username;
                }
            }
            return array($values, $count);
        }

        public function messages(int $id) {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $pm = new FPersistentManager();
            $res = $pm->load("EChat", array("id" => $id))[0];
            //echo var_dump($res);
            $chat = new EChat($id,$res["postId"],$res["postType"],$res["datetime"]);

            if($chat->getPostType() == "team") {
                $posttitle = $pm->load("EPostTeam", array("id" => $chat->getPostId()))[0]["title"];
                $username = $user->getUsername();
            } else if ($chat->getPostType() == "sale") {
                $posttitle = $pm->load("EPostSale", array("id" => $chat->getPostId()))[0]["title"];
                $chatUserId = $pm->load("EChatUser", array("chatId" => $chat->getId()));
                if($chatUserId[0]["userId"] == $user->getId()) {
                    $chatUserId = $chatUserId[1]["userId"];
                } else {
                    $chatUserId = $chatUserId[0]["userId"];
                }
                
                $username = $pm->load("EUser", array("id" => $chatUserId))[0]["username"];
            }

            $pm = new FPersistentManager();
            $res = $pm->load("EChat", array("id" => $chat->getId()))[0];

            $res = $pm->load("EMessage", array("chatId" => $res["id"]));

            $nMessages = count($res);
            
            $view = new VUser();
            $params = array(
                "chatId" => $id,
                "title" => $posttitle,
                "datetime" => $chat->getDateTime(),
                "user" => $username,
                "nMessages" => $nMessages
            );
            $view->showMessageSection($params);
        }

        public function loadMessages(int $chatId,int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElementsById("EMessage",$chatId,$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $message = new EMessage($res[$i]["id"],$res[$i]["chatId"],$res[$i]["userId"],$res[$i]["description"],$res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $message->getUserId()))[0];
                $user = new EUser($userdata["id"],$userdata["username"],$userdata["password"],$userdata["name"],$userdata["surname"],$userdata["birthDate"],$userdata["email"],$userdata["image"]);
                
                $values[] = array(
                    "id" => $message->getId(),
                    "user" => $user->getUsername(),
                    "description" => $message->getDescription(),
                    "datetime" => $message->getDateTime()
                );
            
            }

            return array($values,$count);
        }

        public function sendmessage() {
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $chatId = $_POST["chatId"];
            $messageContent = $_POST["message"];
            $datetime = date("Y-m-d H:i:s");

            $pm = new FPersistentManager();
            $message = new EMessage(0, $chatId, $user->getId(), $messageContent, $datetime);
            $pm->store($message);
        }

        public function countchatmessages(){
            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $chatId = $_POST["chatId"];

            $pm = new FPersistentManager();
            $res = $pm->load("EChat", array("id" => $chatId))[0];

            $res = $pm->load("EMessage", array("chatId" => $res["id"]));

            echo count($res);
        }

        public function privacy() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            if($user == null){
                header("Location: /login");
                exit();
            }

            $username = $user->getUsername();
            $password = $user->getPassword();
            $PPImageURL = "/public/defaultPropic.png";
            if($user->getImage() != "") {
                $PPImageURL = "data:image/png;base64,".base64_encode($user->getImage());
            }
            $view = new VUser();
            $params = array("username" => $username,
                            "censuredPassword" => str_repeat("a", strlen($password)),
                            "profilePicture" => $PPImageURL);
            $view->showPrivacyPage($params);
        }

        public function changeusername() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            if($user == null){
                header("Location: /login");
                exit();
            }

            $newUsername = $_POST["newUsername"];
            
            $pm = new FPersistentManager();
            if($pm->load("EUser", array("username" => $newUsername)) != array()){
                exit();
            }

            $newUser = new EUser($user->getId(), $newUsername, $user->getPassword(), $user->getName(), $user->getSurname(), $user->getBIrthdate(), $user->getEmail(), $user->getImage());
            $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
            $newProfile = new EProfile($oldProfile["id"], "user", $newUsername, $user->getPassword(), $user->getEmail());

            $pm->update($newUser, array("id" => $user->getId()));
            $pm->update($newProfile, array("id" => $oldProfile["id"]));

            $session->set("user", $newUser);
        }

        public function changepassword() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            if($user == null){
                header("Location: /login");
                exit();
            }

            $newPassword = $_POST["newPassword"];

            $pm = new FPersistentManager();
            $newUser = new EUser($user->getId(), $user->getUsername(), $newPassword, $user->getName(), $user->getSurname(), $user->getBIrthdate(), $user->getEmail(), $user->getImage());
            $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
            $newProfile = new EProfile($oldProfile["id"], "user", $user->getUsername(), $newPassword, $user->getEmail());

            $pm->update($newUser, array("id" => $user->getId()));
            $pm->update($newProfile, array("id" => $oldProfile["id"]));

            $session->set("user", $newUser);
        }
    }
?>