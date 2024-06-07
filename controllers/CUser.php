<?php
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EMessage.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChat.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FPersistentManager.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EChatUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");

    class CUser {
        public function home() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            $authenticated = false;
            if($user != null){
                $username = $user->getUsername();
                $authenticated = true;
            }

            $view = new VUser();
            $params = array("authenticated" => $authenticated,
                            "username" => $username);
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
            //DA AGGIUNGERE CONTROLLO SESSIONE

            $session = USession::getInstance();
            $user = $session->load("user");

            if($user == null){
                header("Location: /login");
                exit();
            }

            $pm = new FPersistentManager();
            $values = array();
            
            $iduser = $pm->load("EUser", array("username" => $username))[0]["id"];
            $chatusers = $pm->load("EChatUser", array("iduser" => $iduser));
            $idchats = array();
            
            foreach($chatusers as $key=>$chatuserelement) {
                $idchats[] = array("id" =>$chatuserelement["idchat"]);
            }

            $res = $pm->loadElementsByGroup("EChat",$idchats,$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $chat = new EChat($res[$i]["id"],$res[$i]["idpostteam"],$res[$i]["idpostsell"],$res[$i]["datetime"]);
                $values[$i]["id"] = $chat->getId();
                $values[$i]["datetime"] = $chat->getDateTime();


                if($chat->getIdPostSell() == 0) {
                    //TEAM
                    $posttitle = $pm->load("EPostTeam", array("id" => $chat->getIdPostTeam()))[0]["title"];
                    $values[$i]["posttitle"] = $posttitle;
                    $values[$i]["username"] = null;

                } else {
                    //SELL
                    $posttitle = $pm->load("EPostSell", array("id" => $chat->getIdPostSell()))[0]["title"];
                    $values[$i]["posttitle"] = $posttitle;
                    $idchatuser = $pm->load("EChatUser", array("idchat" => $chat->getId()));
                    
                    if($idchatuser[0]["iduser"] == $user->getId()) {
                        
                        $idchatuser = $idchatuser[1]["iduser"];
                    } else {
                        
                        $idchatuser = $idchatuser[0]["iduser"];
                    }
                    $username = $pm->load("EUser", array("id" => $idchatuser))[0]["username"];
                    $values[$i]["username"] = $username;
                }
            }

            return array($values,$count);
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
            $chat = new EChat($id,$res["idpostteam"],$res["idpostsell"],$res["datetime"]);

            if($chat->getIdPostSell() == 0) {
                //TEAM
                $posttitle = $pm->load("EPostTeam", array("id" => $chat->getIdPostTeam()))[0]["title"];
            } else {
                //SELL
                $posttitle = $pm->load("EPostSell", array("id" => $chat->getIdPostSell()))[0]["title"];
                $idchatuser = $pm->load("EChatUser", array("idchat" => $chat->getId()));
                if($idchatuser[0]["iduser"] == $user->getId()) {
                    $idchatuser = $idchatuser[1]["iduser"];
                } else {
                    $idchatuser = $idchatuser[0]["iduser"];
                }
                $username = $pm->load("EUser", array("id" => $idchatuser))[0]["username"];
            }
            
            $username = $user->getUsername();
            $view = new VUser();
            $params = array(
                "idchat" => $id,
                "title" => $posttitle,
                "datetime" => $chat->getDateTime(),
                "user" => $username
            );
            $view->showMessageSection($params);
        }

        public function loadMessages(int $idchat,int $offset,int $limit,string $datetime) {
            $pm = new FPersistentManager();
            $values = array();

            $res = $pm->loadElementsById("EMessage",$idchat,$limit,$offset,$datetime);
            $count = count($res);

            for($i=0;$i<$count;$i++) {

                $message = new EMessage($res[$i]["id"],$res[$i]["idchat"],$res[$i]["iduser"],$res[$i]["description"],$res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $message->getIdUser()))[0];
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

        public function sendMessage() {

        }

        public function privacy() {
            $session = USession::getInstance();
            $user = $session->load("user");
            
            $username = null;
            if($user == null){
                header("Location: /login");
                exit();
            }
            $username = $user->getUsername();
            $view = new VUser();
            $params = array("username" => $username,
                            "censuredPassword" => "*");
            $view->showPrivacyPage($params);
        }
    }
?>