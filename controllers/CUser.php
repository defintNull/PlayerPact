<?php

use Smarty\Compile\PrintExpressionCompiler;

require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/VUser.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EUser.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EMessage.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EChat.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EChatUser.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EProfile.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/utility/USession.php");

class CUser
{
    private function checkSession($session)
    {
        $user = $session->load("user");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EUser", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
    }

    public function home()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        $username = null;
        $authenticated = false;
        $PPImageURL = "/public/defaultPropic.png";
        $params = array();

        if ($user != null) {
            $username = $user->getUsername();
            $authenticated = true;

            if ($user->getImage() != "") {
                $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
            }
        }

        $view = new VUser();
        $params = array(
            "authenticated" => $authenticated,
            "username" => $username,
            "profilePicture" => $PPImageURL
        );
        $view->showHome($params);
    }

    public function profile()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }

        $username = $user->getUsername();
        $view = new VUser();
        $params = array(
            "username" => $username,
            "profilePicture" => $PPImageURL
        );
        $view->showProfile($params);
    }

    public function saved()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }

        $username = $user->getUsername();
        $view = new VUser();
        $params = array(
            "username" => $username,
            "profilePicture" => $PPImageURL
        );
        $view->showSavedPosts($params);
    }

    public function participated()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        $username = null;
        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }

        $username = $user->getUsername();
        $view = new VUser();
        $params = array(
            "username" => $username,
            "profilePicture" => $PPImageURL
        );
        $view->showTeams($params);
    }

    public function chats()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }

        $username = $user->getUsername();
        $view = new VUser();
        $params = array(
            "username" => $username,
            "profilePicture" => $PPImageURL
        );
        $view->showChatSection($params);
    }

    public function loadChats(string $username, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $userId = $pm->load("EUser", array("username" => $username))[0]["id"];
        // Prendo tutte le chat relative all'utente attuale loggato
        $chatusers = $pm->load("EChatUser", array("userId" => $userId));

        // Se non ci sono chat passa valori nulli al js
        if (count($chatusers) == 0) {
            return array(null, 0);
        }

        $chatIds = array();

        foreach ($chatusers as $key => $chatuserelement) {
            $chatIds[] = array("id" => $chatuserelement["chatId"]);
        }

        $res = $pm->loadElementsByGroup("EChat", $chatIds, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $chat = new EChat($res[$i]["id"], $res[$i]["postId"], $res[$i]["postType"], $res[$i]["datetime"]);
            //echo var_dump($chat);
            $values[$i]["id"] = $chat->getId();
            $values[$i]["datetime"] = $chat->getDateTime();

            if ($chat->getPostType() == "team") {
                $post = $pm->load("EPostTeam", array("id" => $chat->getPostId()));
                if ($post != array()) {
                    $posttitle = $post[0]["title"];
                } else {
                    $posttitle = "Deleted post";
                }

                $values[$i]["posttitle"] = $posttitle;
                $values[$i]["username"] = null;
            } else if ($chat->getPostType() == "sale") {
                $post = $pm->load("EPostSale", array("id" => $chat->getPostId()));
                if ($post != array()) {
                    $posttitle = $post[0]["title"];
                } else {
                    $posttitle = "Deleted post";
                }
                $values[$i]["posttitle"] = $posttitle;
                $chatUserId = $pm->load("EChatUser", array("chatId" => $chat->getId()));

                if (count($chatUserId) > 1) {
                    if ($chatUserId[0]["userId"] == $user->getId()) {
                        $chatUserId = $chatUserId[1]["userId"];
                    } else {
                        $chatUserId = $chatUserId[0]["userId"];
                    }
                    $username = $pm->load("EUser", array("id" => $chatUserId))[0]["username"];
                } else {
                    $username = "Deleted user";
                }
                $values[$i]["username"] = $username;
            }
        }
        return array($values, $count);
    }

    public function messages(int $id)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }

        $pm = new FPersistentManager();
        $res = $pm->load("EChat", array("id" => $id))[0];
        //echo var_dump($res);
        $chat = new EChat($id, $res["postId"], $res["postType"], $res["datetime"]);
        $deletedPost = false;

        if ($chat->getPostType() == "team") {
            $post = $pm->load("EPostTeam", array("id" => $chat->getPostId()));
            if ($post != array()) {
                $postUser = $pm->load("EUser", array("id" => $post[0]["userId"]));
                $posttitle = $post[0]["title"];
                $username = $postUser[0]["username"];
            } else {
                $posttitle = "Deleted post";
                $username = "Deleted user";
            }
        } else if ($chat->getPostType() == "sale") {
            $post = $pm->load("EPostSale", array("id" => $chat->getPostId()));
            if ($post != array()) {
                $posttitle = $post[0]["title"];
            } else {
                $posttitle = "Deleted post";
            }
            $chatUserId = $pm->load("EChatUser", array("chatId" => $chat->getId()));
            if (count($chatUserId) > 1) {
                if ($chatUserId[0]["userId"] == $user->getId()) {
                    $chatUserId = $chatUserId[1]["userId"];
                } else {
                    $chatUserId = $chatUserId[0]["userId"];
                }
                $username = $pm->load("EUser", array("id" => $chatUserId))[0]["username"];
            } else {
                $username = "Deleted user";
                $deletedPost = true;
            }
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
            "nMessages" => $nMessages,
            "username" => $user->getUsername(),
            "deletedPost" => $deletedPost,
            "profilePicture" => $PPImageURL
        );
        $view->showMessageSection($params);
    }

    public function loadMessages(int $chatId, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsById("EMessage", $chatId, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {

            $message = new EMessage($res[$i]["id"], $res[$i]["chatId"], $res[$i]["userId"], $res[$i]["description"], $res[$i]["datetime"]);
            $userdata = $pm->load("EUser", array("id" => $message->getUserId()));
            if ($userdata != array()) {
                $userdata = $userdata[0];
                $username = $userdata["username"];
            } else {
                $username = "Deleted user";
            }


            $values[] = array(
                "id" => $message->getId(),
                "user" => $username,
                "description" => $message->getDescription(),
                "datetime" => $message->getDateTime()
            );
        }

        return array($values, $count);
    }

    public function sendmessage()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
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

    public function countchatmessages()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $chatId = $_POST["chatId"];

        $pm = new FPersistentManager();
        $res = $pm->load("EChat", array("id" => $chatId))[0];

        $res = $pm->load("EMessage", array("chatId" => $res["id"]));

        echo count($res);
    }

    public function loadMyPosts(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /error/e404");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $myStandard = $pm->loadElementsByCondition("EPostStandard", array("userId" => $user->getId()), $limit, $offset, $datetime);
        $myTeam = $pm->loadElementsByCondition("EPostTeam", array("userId" => $user->getId()), $limit, $offset, $datetime);
        $mySale = $pm->loadElementsByCondition("EPostSale", array("userId" => $user->getId()), $limit, $offset, $datetime);

        $res = array();

        if ($myStandard != array()) {
            $res = array_merge($res, $myStandard);
        }
        if ($myTeam != array()) {
            $res = array_merge($res, $myTeam);
        }
        if ($mySale != array()) {
            $res = array_merge($res, $mySale);
        }

        usort($res, function ($a, $b) {
            $ad = new DateTime($a['datetime']);
            $bd = new DateTime($b['datetime']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? 1 : -1;
        });

        //echo var_dump($res);

        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            if (in_array($res[$i], $myStandard)) {
                $post = new EPostStandard($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"]);
                $userdata = $pm->load("EUser", array("id" => $post->getUserId()))[0];

                $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
                $values[] = array(
                    "type" => "standard",
                    "id" => $post->getId(),
                    "userId" => $user->getUsername(),
                    "title" => $post->getTitle(),
                    "description" => $post->getDescription(),
                    "datetime" => $post->getDateTime()
                );
            } else if (in_array($res[$i], $myTeam)) {
                $post = new EPostTeam($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["nMaxPlayers"], $res[$i]["nPlayers"], $res[$i]["time"]);
                $userdata = $pm->load("EUser", array("id" => $post->getuserId()))[0];

                $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
                $values[] = array(
                    "type" => "team",
                    "id" => $post->getId(),
                    "userId" => $user->getUsername(),
                    "title" => $post->getTitle(),
                    "description" => $post->getDescription(),
                    "datetime" => $post->getDateTime(),
                    "nMaxPlayers" => $post->getNMaxPlayers(),
                    "nPlayers" => $post->getNPlayers(),
                    "time" => $post->getTime()
                );
            } else if (in_array($res[$i], $mySale)) {
                $post = new EPostSale($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["price"], $res[$i]["image"]);
                $userdata = $pm->load("EUser", array("id" => $post->getuserId()))[0];

                $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
                $values[] = array(
                    "type" => "sale",
                    "id" => $post->getId(),
                    "userId" => $user->getUsername(),
                    "title" => $post->getTitle(),
                    "description" => $post->getDescription(),
                    "datetime" => $post->getDateTime(),
                    "price" => $post->getPrice(),
                    "image" => base64_encode($post->getImage())
                );
            }
        }

        return array($values, $count);
    }

    public function loadSavedPosts(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /error/e404");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $interest = $pm->load("EInterestList", array("userId" => $user->getId()));
        //echo var_dump($part);
        $res = array();
        for ($i = 0; $i < count($interest); $i++) {
            $res = array_merge($res, $pm->loadElementsByCondition("EPostSale", array("id" => $interest[$i]["postSaleId"]), $limit, $offset, $datetime));
        }
        usort($res, function ($a, $b) {
            $ad = new DateTime($a['datetime']);
            $bd = new DateTime($b['datetime']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? 1 : -1;
        });
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $post = new EPostSale($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["price"], $res[$i]["image"]);
            $userdata = $pm->load("EUser", array("id" => $post->getuserId()))[0];

            $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
            $values[] = array(
                "type" => "sale",
                "id" => $post->getId(),
                "userId" => $user->getUsername(),
                "title" => $post->getTitle(),
                "description" => $post->getDescription(),
                "datetime" => $post->getDateTime(),
                "price" => $post->getPrice(),
                "image" => base64_encode($post->getImage())
            );
        }

        return array($values, $count);
    }

    public function loadTeams(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /error/e404");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $interest = $pm->load("EParticipation", array("userId" => $user->getId()));

        $res = array();
        for ($i = 0; $i < count($interest); $i++) {
            $res = array_merge($res, $pm->loadElementsByCondition("EPostTeam", array("id" => $interest[$i]["postTeamId"]), $limit, $offset, $datetime));
        }
        usort($res, function ($a, $b) {
            $ad = new DateTime($a['datetime']);
            $bd = new DateTime($b['datetime']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? 1 : -1;
        });
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $post = new EPostTeam($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["nMaxPlayers"], $res[$i]["nPlayers"], $res[$i]["time"]);
            $userdata = $pm->load("EUser", array("id" => $post->getuserId()))[0];

            $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
            $values[] = array(
                "type" => "team",
                "id" => $post->getId(),
                "userId" => $user->getUsername(),
                "title" => $post->getTitle(),
                "description" => $post->getDescription(),
                "datetime" => $post->getDateTime(),
                "nMaxPlayers" => $post->getNMaxPlayers(),
                "nPlayers" => $post->getNPlayers(),
                "time" => $post->getTime()
            );
        }

        return array($values, $count);
    }

    public function privacy($info = "ok")
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }
        $view = new VUser();
        $params = array(
            "email" => $email,
            "username" => $username,
            "censuredPassword" => str_repeat("a", strlen($password)),
            "profilePicture" => $PPImageURL,
            "info" => $info
        );
        $view->showPrivacyPage($params);
    }

    public function changeProfileImage()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $image = null;

        if (isset($_FILES["newProfileImage"]['name']) && $_FILES["newProfileImage"]['error'] == 0) {
            $file_tmp_path = $_FILES["newProfileImage"]['tmp_name'];
            $file_name = $_FILES["newProfileImage"]['name'];
            $file_size = $_FILES["newProfileImage"]['size']; // in byte

            if ($file_size > 5 * 1024 * 1024) {
                header("Location: /user/privacy?info=error_image"); // Aggiungere messaggio a schermo
                exit();
            }

            $allowedfileExtensions = array('jpg', 'jpeg', 'png');
            $file_name_cmps = explode(".", $file_name);
            $file_extension = strtolower(end($file_name_cmps));

            if (in_array($file_extension, $allowedfileExtensions)) {
                $image = file_get_contents($file_tmp_path);
            } else {
                header("Location: /user/privacy?info=error_image");
                exit();
            }
        } else {
            header("Location: /user/privacy?info=error_image");
            exit();
        }

        $pm = new FPersistentManager();
        $newUser = new EUser($user->getId(), $user->getUsername(), $user->getPassword(), $user->getName(), $user->getSurname(), $user->getBirthdate(), $user->getEmail(), $image);
        $pm->update($newUser, array("id" => $user->getId()));

        $session->set("user", $newUser);

        header("Location: /user/privacy");
        exit();
    }

    public function changeEmail()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $newEmail = $_POST["newEmail"];

        $pm = new FPersistentManager();
        if ($pm->load("EProfile", array("email" => $newEmail)) !== array() || !preg_match("/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/", $newEmail)) {
            echo "error_email";
            exit();
        }


        $newUser = new EUser($user->getId(), $user->getUsername(), $user->getPassword(), $user->getName(), $user->getSurname(), $user->getBIrthdate(), $newEmail, $user->getImage());
        $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
        $newProfile = new EProfile($oldProfile["id"], "user", $user->getUsername(), $user->getPassword(), $newEmail);

        $pm->update($newUser, array("id" => $user->getId()));
        $pm->update($newProfile, array("id" => $oldProfile["id"]));

        $session->set("user", $newUser);
    }

    public function changeusername()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $newUsername = $_POST["newUsername"];

        $pm = new FPersistentManager();
        if ($pm->load("EProfile", array("username" => $newUsername)) !== array() || $newUsername == "") {
            echo "error_username";
            exit();
        }

        $newUser = new EUser($user->getId(), $newUsername, $user->getPassword(), $user->getName(), $user->getSurname(), $user->getBIrthdate(), $user->getEmail(), $user->getImage());
        $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
        $newProfile = new EProfile($oldProfile["id"], "user", $newUsername, $user->getPassword(), $user->getEmail());

        $pm->update($newUser, array("id" => $user->getId()));
        $pm->update($newProfile, array("id" => $oldProfile["id"]));

        $session->set("user", $newUser);
    }

    public function changepassword()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $newPassword = $_POST["newPassword"];

        if ($newPassword == "") {
            echo "error_password";
            exit();
        }

        $pm = new FPersistentManager();
        $newUser = new EUser($user->getId(), $user->getUsername(), $newPassword, $user->getName(), $user->getSurname(), $user->getBIrthdate(), $user->getEmail(), $user->getImage());
        $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
        $newProfile = new EProfile($oldProfile["id"], "user", $user->getUsername(), $newPassword, $user->getEmail());

        $pm->update($newUser, array("id" => $user->getId()));
        $pm->update($newProfile, array("id" => $oldProfile["id"]));

        $session->set("user", $newUser);
    }
}
