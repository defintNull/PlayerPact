<?php

use Smarty\Compile\PrintExpressionCompiler;

require_once realpath(__DIR__."/../view/VUser.php");
require_once realpath(__DIR__."/../entity/EUser.php");
require_once realpath(__DIR__."/../entity/EMessage.php");
require_once realpath(__DIR__."/../entity/EChat.php");
require_once realpath(__DIR__."/../entity/EParticipation.php");
require_once realpath(__DIR__."/../foundation/FPersistentManager.php");
require_once realpath(__DIR__."/../entity/EChatUser.php");
require_once realpath(__DIR__."/../entity/EProfile.php");
require_once realpath(__DIR__."/../utility/USession.php");

/**
 * Manage user related operations in controller level
 *
 * Manages all the user related operations, like profile, saved posts, 
 * participations and chats
 *
 * @package Playerpact\Controllers
 */
class CUser
{
    /**
     * Check current session
     *
     * Checks if the current session is valid, that is to say if
     * the user is still in DB or not
     *
     * @param $session The session to check
     * 
     */
    private function checkSession($session)
    {
        $user = $session->load("user");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EUser", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
            $banned = $pm->load("EBannedUser", array("userId" => $user->getId()));
            if($banned != array()) {
                $session->end();
            }
        }
    }

    /**
     * User home page controller
     *
     * Manages the visualization of the user home page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
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

    /**
     * User profile page controller
     *
     * Manages the visualization of the user profile page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
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

    /**
     * Saved posts page controller
     *
     * Manages the visualization of the saved posts page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
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

    /**
     * Teams page controller
     *
     * Manages the visualization of the teams page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
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

    /**
     * Chats page controller
     *
     * Manages the visualization of the chats page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
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

    /**
     * Chat load
     *
     * Loads chat according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of moderators loaded.
     * 
     * @param string $username The username of the user associated to chats
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
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

        $userId = $user->getId();
        $chatusers = $pm->load("EChatUser", array("userId" => $userId));

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

    /**
     * Message page controller
     *
     * Manages the visualization of the message page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
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
                $username = "";
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

    /**
     * Messages load
     *
     * Loads messages according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of moderators loaded.
     * 
     * @param string $chatId The id of the chat containing messages
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
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

    /**
     * Message send
     *
     * Adds a message to DB through PM in a certain chat
     * 
     */
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

        if(!CUser::check($messageContent)) {
            header("Location: /user/messages?id=" . $chatId);
            exit();
        }

        $pm = new FPersistentManager();
        $message = new EMessage(0, $chatId, $user->getId(), $messageContent, $datetime);
        if(!$pm->store($message)) {
            header("Location: /error/e404");
            exit();
        }
    }

    /**
     * Message count
     *
     * Counts the messages in a certain chat
     * 
     */
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

    /**
     * Post-user relation load
     *
     * Loads posts according to the current user and to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of moderators loaded.
     * 
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadPostUsers(int $offset, int $limit, string $datetime)
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
        $res = array();

        $myPosts = $pm->loadElementsByCondition("EPostUser", array("userId" => $user->getId()), $limit, $offset, $datetime);

        $count = count($myPosts);

        for ($i = 0; $i < $count; $i++) {
            if ($myPosts[$i]["type"] == "standard") {
                $res[] = $pm->load("EPostStandard", array("id" => $myPosts[$i]["postId"]))[0];
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
            } else if ($myPosts[$i]["type"] == "team") {
                $res[] = $pm->load("EPostTeam", array("id" => $myPosts[$i]["postId"]))[0];
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
            } else if ($myPosts[$i]["type"] == "sale") {
                $res[] = $pm->load("EPostSale", array("id" => $myPosts[$i]["postId"]))[0];
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

    /**
     * Saved posts load
     *
     * Loads saved posts according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of moderators loaded.
     * 
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
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

        $interest = $pm->loadElementsByCondition("EInterestList",array("userId" => $user->getId()),$limit,$offset,"null");
        $res = array();
        for ($i = 0; $i < count($interest); $i++) {
            $res = array_merge($res, $pm->load("EPostSale", array("id" => $interest[$i]["postSaleId"])));
        }
        
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

    /**
     * Teams load
     *
     * Loads teams according according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of moderators loaded.
     * 
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
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

        $participation = $pm->loadElementsByCondition("EParticipation",array("userId" => $user->getId()),$limit,$offset,"null");
        $res = array();
        for ($i = 0; $i < count($participation); $i++) {
            $res = array_merge($res, $pm->load("EPostTeam", array("id" => $participation[$i]["postTeamId"])));
        }

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

    /**
     * Privacy page controller
     *
     * Manages the visualization of the privacy page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param string $info Useful to show errors in the html through the corresponding view
     */
    public function privacy(string $info = "ok")
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
        $PPImageURL = "/public/defaultPropic.png";
        if ($user->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
        }
        $view = new VUser();
        $params = array(
            "email" => $email,
            "username" => $username,
            "profilePicture" => $PPImageURL,
            "info" => $info
        );
        $view->showPrivacyPage($params);
    }

    /**
     * Change profile image
     *
     * Changes the current user's profile image with a new image.
     */
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

    /**
     * Change email
     *
     * Changes the current user's email with a new email.
     */
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
        if($newEmail == $user->getEmail()) {
            exit();
        }

        $pm = new FPersistentManager();
        if (!preg_match("/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/", $newEmail)) {
            echo "error_email";
            exit();
        } else if($pm->load("EProfile", array("email" => $newEmail)) !== array()) {
            echo "email_exists";
            exit();
        }


        $newUser = new EUser($user->getId(), $user->getUsername(), $user->getPassword(), $user->getName(), $user->getSurname(), $user->getBIrthdate(), $newEmail, $user->getImage());
        $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
        $newProfile = new EProfile($oldProfile["id"], "user", $user->getUsername(), $user->getPassword(), $newEmail);

        $pm->update($newUser, array("id" => $user->getId()));
        $pm->update($newProfile, array("id" => $oldProfile["id"]));

        $session->set("user", $newUser);
    }

    /**
     * Change username
     *
     * Changes the current user's username with a new username.
     */
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
        if(strcmp($newUsername, $user->getUsername()) == 0) {
            exit();
        }

        $pm = new FPersistentManager();
        if ($newUsername == "") {
            echo "username_missing";
            exit();
        } else if($pm->load("EProfile", array("username" => $newUsername)) !== array()) {
            echo "username_exists";
            exit();
        }

        $newUser = new EUser($user->getId(), $newUsername, $user->getPassword(), $user->getName(), $user->getSurname(), $user->getBIrthdate(), $user->getEmail(), $user->getImage());
        $oldProfile = $pm->load("EProfile", array("username" => $user->getUsername()))[0];
        $newProfile = new EProfile($oldProfile["id"], "user", $newUsername, $user->getPassword(), $user->getEmail());

        $pm->update($newUser, array("id" => $user->getId()));
        $pm->update($newProfile, array("id" => $oldProfile["id"]));

        $session->set("user", $newUser);
    }

    /**
     * Change password
     *
     * Changes the current user's password with a new password.
     */
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

    /**
     * Check for illegal characters
     *
     * Checks if required fields contains or not some illegal characters
     * to prevent SQL injections.
     * 
     * @param string $s The string to check
     * 
     * @return boolean
     */
    private static function check($s)
    {
        if (!preg_match("/^[a-zA-Z0-9à-üÀ-Ü\/@.#!_?, \-]*$/", $s)) {
            return false;
        }
        return true;
    }
}
