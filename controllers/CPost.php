<?php
require_once realpath(__DIR__."/../foundation/FPersistentManager.php");
require_once realpath(__DIR__."/../entity/EPostStandard.php");
require_once realpath(__DIR__."/../entity/EPostSale.php");
require_once realpath(__DIR__."/../entity/EPostTeam.php");
require_once realpath(__DIR__."/../entity/EUser.php");
require_once realpath(__DIR__."/../entity/EChat.php");
require_once realpath(__DIR__."/../entity/EChatUser.php");
require_once realpath(__DIR__."/../entity/EChatUser.php");
require_once realpath(__DIR__."/../entity/EComment.php");
require_once realpath(__DIR__."/../entity/EReport.php");
require_once realpath(__DIR__."/../entity/EParticipation.php");
require_once realpath(__DIR__."/../view/VPost.php");

/**
 * Manage post related operations in controller level
 *
 * Manages all the post related operations, like creating/deleting posts,
 * create comments, report posts/comments and interacting with posts
 *
 * @package Playerpact\Controllers
 */
class CPost
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
     * Home page
     *
     * Redirects the path /user to /user/standard
     * 
     */
    public function home()
    {
        $this->standard();
    }

    /**
     * Load standard post
     *
     * Loads standard posts according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of standard posts loaded.
     * 
     * @param string $search The string that match the title to search for
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadStandardPosts(string $search, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsLike("EPostStandard",$search, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {

            $post = new EPostStandard($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"]);
            $userdata = $pm->load("EUser", array("id" => $post->getUserId()))[0];

            $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
            $values[] = array(
                "id" => $post->getId(),
                "userId" => $user->getUsername(),
                "title" => $post->getTitle(),
                "description" => $post->getDescription(),
                "datetime" => $post->getDateTime()
            );
        }

        return array($values, $count);
    }

    /**
     * Load sale post
     *
     * Loads sale posts according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of sale posts loaded.
     * 
     * @param string $search The string that match the title to search for
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadSalePosts(string $search, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsLike("EPostSale", $search, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $post = new EPostSale($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["price"], $res[$i]["image"]);
            $userdata = $pm->load("EUser", array("id" => $post->getuserId()))[0];

            $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
            $values[] = array(
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
     * Load team post
     *
     * Loads team posts according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of team posts loaded.
     * 
     * @param string $search The string that match the title to search for
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadTeamPosts(string $search, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $sessionUser = $session->load("user");

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsLike("EPostTeam", $search, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < count($res); $i++) {
            $post = new EPostTeam($res[$i]["id"], $res[$i]["userId"], $res[$i]["title"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["nMaxPlayers"], $res[$i]["nPlayers"], $res[$i]["time"]);
            $participations = $pm->load("EParticipation", array("postTeamId" => $res[$i]["id"]));

            $participatingUserIds = array();
            for($j = 0; $j < count($participations); $j++) {
                $participatingUserIds[] = $participations[$j]["userId"];
            }

            if($res[$i]["nMaxPlayers"] > $res[$i]["nPlayers"] || ($sessionUser != null && in_array($sessionUser->getId(), $participatingUserIds))) {
                $userdata = $pm->load("EUser", array("id" => $post->getuserId()))[0];

                $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
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
                
            }
        }

        return array($values, $count);
    }

    /**
     * Standard post page
     *
     * Manages the visualization of the standard post page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param string $search Used to show errors on screen
     * @param string $ok Used to show errors on screen
     */
    public function standard(string $search = "", string $info = "ok")
    {
        $view = new VPost();
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        $authenticated = false;
        $username = null;
        $PPImageURL = "/public/defaultPropic.png";
        if ($user != null) {
            $authenticated = true;
            $username = $user->getUsername();
            if ($user->getImage() != "") {
                $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
            }
        }

        if(!CPost::check($search)) {
            header("Location: /post/standard?info=badInput");
            exit();
        }

        $params = array(
            "type" => "standard",
            "authenticated" => $authenticated,
            "username" => $username,
            "profilePicture" => $PPImageURL,
            "search" => $search
        );
        $view->show($params);
    }

    /**
     * Sale post page
     *
     * Manages the visualization of the sale post page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param string $search Used to show errors on screen
     * @param string $ok Used to show errors on screen
     */
    public function sale(string $search = "", string $info = "ok")
    {
        $view = new VPost();
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        $authenticated = false;
        $username = null;
        $PPImageURL = "/public/defaultPropic.png";
        if ($user != null) {
            $authenticated = true;
            $username = $user->getUsername();
            if ($user->getImage() != "") {
                $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
            }
        }

        if(!CPost::check($search)) {
            header("Location: /post/sale?info=badInput");
            exit();
        }

        $params = array(
            "type" => "sale",
            "authenticated" => $authenticated,
            "username" => $username,
            "profilePicture" => $PPImageURL,
            "search" => $search
        );
        $view->show($params);
    }

    /**
     * Team post page
     *
     * Manages the visualization of the team post page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param string $search Used to show errors on screen
     * @param string $ok Used to show errors on screen
     */
    public function team(string $search = "", string $info = "ok")
    {
        $view = new VPost();
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        $authenticated = false;
        $username = null;
        $PPImageURL = "/public/defaultPropic.png";
        if ($user != null) {
            $authenticated = true;
            $username = $user->getUsername();
            if ($user->getImage() != "") {
                $PPImageURL = "data:image/png;base64," . base64_encode($user->getImage());
            }
        }

        if(!CPost::check($search)) {
            header("Location: /post/team?info=badInput");
            exit();
        }

        $params = array(
            "type" => "team",
            "authenticated" => $authenticated,
            "username" => $username,
            "profilePicture" => $PPImageURL,
            "search" => $search
        );
        $view->show($params);
    }

    /**
     * Comments page
     *
     * Manages the visualization of the comment page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param int $id The id related to the post in which comments are made.
     */
    public function comments(int $id)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $sessionUser = $session->load("user");

        $pm = new FPersistentManager();
        $res = $pm->load("EPostStandard", array("id" => $id));
        if($res == array()) {
            header("Location: /post/standard");
            exit();
        }
        $res = $res[0];
        $user = $pm->load("EUser", array("id" => $res["userId"]))[0];

        $authenticated = false;
        $username = null;
        $PPImageURL = "/public/defaultPropic.png";
        if ($sessionUser != null) {
            $authenticated = true;
            $username = $sessionUser->getUsername();
            if ($sessionUser->getImage() != "") {
                $PPImageURL = "data:image/png;base64," . base64_encode($sessionUser->getImage());
            }
        }

        $view = new VPost();
        $params = array(
            "postId" => $res["id"],
            "postUsername" => $user["username"],
            "postTitle" => $res["title"],
            "postDescription" => $res["description"],
            "postDatetime" => $res["datetime"],
            "authenticated" => $authenticated,
            "username" => $username,
            "profilePicture" => $PPImageURL
        );
        $view->showComments($params);
    }

    /**
     * Load comments
     *
     * Loads comments according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of comments loaded.
     * 
     * @param int $postId The id of the standard post which comments are referred to
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadComments(int $postId, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsById("EComment", $postId, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {

            $comment = new EComment($res[$i]["id"], $res[$i]["postStandardId"], $res[$i]["userId"], $res[$i]["description"], $res[$i]["datetime"]);
            $userdata = $pm->load("EUser", array("id" => $comment->getUserId()));

            if (count($userdata) !== 0) {
                $userdata = $userdata[0];
                $user = new EUser($userdata["id"], $userdata["username"], $userdata["password"], $userdata["name"], $userdata["surname"], $userdata["birthDate"], $userdata["email"], $userdata["image"]);
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

        return array($values, $count);
    }

    /**
     * Create post page
     * 
     * Manages the visualization of the create post page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param string $info Used to manage error messages in the show method
     */
    public function create(string $info = "ok")
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $view = new VPost();
        $view->showSelectNewPost($info);
    }

    /**
     * Create post
     * 
     * Creates a post based on the fields compiled in the post creation page.
     */
    public function confirmCreation()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /error/e404");
            exit();
        }

        $pm = new FPersistentManager();
        $userId = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];

        if (!$this->checkNewPostFields()) {
            header("Location: /post/create?info=error");
            exit();
        }

        if (isset($_POST["standard"])) {
            $values = $_POST["standard"];

            if(!CPost::check($values["title"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }

            if(!CPost::check($values["description"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }

            $post = new EPostStandard(1, $userId, $values["title"], $values["description"], date("Y-m-d H:i:s"));
            
            if(!$pm->store($post)) {
                header("Location: /error/e404");
                exit();
            }
            

            header("Location: /post/standard");
            exit();
        } else if (isset($_POST["sale"])) {
            $values = $_POST["sale"];

            if(!CPost::check($values["title"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }
            if(!CPost::check($values["description"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }
            if(!CPost::check($values["price"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }

            $image = null;
            if (isset($_FILES['sale']['name']['image']) && $_FILES['sale']['error']['image'] == 0) {
                $file_tmp_path = $_FILES['sale']['tmp_name']['image'];
                $file_name = $_FILES['sale']['name']['image'];
                $file_size = $_FILES['sale']['size']['image'];

                if ($file_size > 5 * 1024 * 1024) {
                    header("Location: /post/create?info=tooBig");
                    exit();
                }

                $allowedfileExtensions = array('jpg', 'jpeg', 'png');
                $file_name_cmps = explode(".", $file_name);
                $file_extension = strtolower(end($file_name_cmps));

                if (in_array($file_extension, $allowedfileExtensions)) {
                    $image = addslashes(file_get_contents($file_tmp_path));
                } else {
                    header("Location: /post/create?info=error");
                    exit();
                }
            } else {
                header("Location: /post/create?info=error");
                exit();
            }
            $datetime = date("Y-m-d H:i:s");

            $post = new EPostSale(1, $userId, $values["title"], $values["description"], $datetime, $values["price"], $image);
            
            if(!$pm->store($post)) {
                header("Location: /error/e404");
                exit();
            }

            header("Location: /post/sale");
            exit();
        } else if (isset($_POST["team"])) {
            $values = $_POST["team"];
            $datetime = date("Y-m-d H:i:s");

            if(!CPost::check($values["title"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }
            if(!CPost::check($values["description"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }
            if(!CPost::check($values["time"])) {
                header("Location: /post/create?info=badInput");
                exit();
            }

            $post = new EPostTeam(1, $userId, $values["title"], $values["description"], $datetime, $values["nMaxPlayer"], $values["nPlayers"], $values["time"]);
            $postTeamId = $pm->store($post);

            if(!$postTeamId) {
                header("Location: /error/e404");
                exit();
            }

            $participation = new EParticipation($userId, $postTeamId);
            if(!$pm->store($participation)) {
                header("Location: /error/e404");
                exit();
            }

            $chat = new EChat(0, $postTeamId, "team", $datetime);
            if(!$chatId = $pm->store($chat)) {
                header("Location: /error/e404");
                exit();
            }

            $chatuser = new EChatUser($chatId, $userId, $datetime);
            if(!$pm->store($chatuser)) {
                header("Location: /error/e404");
                exit();
            }

            header("Location: /post/team");
            exit();
        }
    }
    
    /**
     * Get fullscreen image
     * 
     * Shows a new tab with the desired image in fullscreen mode
     * 
     * @param int $id The sale post id containing the image desired
     */
    public function get_image(int $id)
    {
        $session = USession::getInstance();
        $this->checkSession($session);

        if (!is_numeric($id) || intval($id) != $id) {
            header("Location: /error/404");
        }

        $pm = new FPersistentManager();
        $postSale = $pm->load("EPostSale", array("id" => $id));

        if ($postSale == null) {
            header("Location: /error/e404");
            exit();
        }

        $image = $postSale[0]["image"];

        $view = new VPost();
        $imageURL = "data:image/png;base64," . base64_encode($image);
        $view->showImage($imageURL);
    }

    /**
     * Check post fields
     * 
     * Checks if fields in post creation are valid
     * 
     * @return bool
     */
    private function checkNewPostFields()
    {
        if (isset($_POST["standard"])) {
            $values = $_POST["standard"];
            foreach ($values as $key => $val) {
                if ($val == "") {
                    return false;
                }
            }
        } else if (isset($_POST["sale"])) {
            $values = $_POST["sale"];
            foreach ($values as $key => $val) {
                if ($val == "") {
                    return false;
                }
            }
            if (!is_numeric($values["price"]) || $values["price"] <= 0) {
                return false;
            }
        } else if (isset($_POST["team"])) {
            $values = $_POST["team"];
            foreach ($values as $key => $val) {
                if ($val == "") {
                    return false;
                }
            }
            if (!is_numeric($values["nMaxPlayer"])) {
                return false;
            }
            if (!is_numeric($values["nPlayers"])) {
                return false;
            }
            if ($values["nPlayers"] >= $values["nMaxPlayer"] || $values["nMaxPlayer"] <= 1 || $values["nPlayers"] <= 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Add comment
     * 
     * Adds a new comment in DB through PM. 
     */
    public function addcomment()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        if ($_POST["comment"] == "") {
            header("Location: /post/comments?id=" . $_POST["postId"]);
            exit();
        }

        if(!CPost::check($_POST["comment"])) {
            header("Location: /post/comments?id=" . $_POST["postId"]);
            exit();
        }

        $pm = new FPersistentManager();
        $userId = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];

        $comment = new EComment(1, $_POST["postId"], $userId, $_POST["comment"], date("Y-m-d H:i:s"));
        if(!$pm->store($comment)) {
            header("Location: /error/e404");
            exit();
        }
        

        header("Location: /post/comments?id=" . $_POST["postId"]);
        exit();
    }

    /**
     * Report page
     * 
     * Manages the visualization of the report page, with session check,
     * view initialization and the call to the relative show method.
     * 
     * @param string $info Used to manage error messages in the show method
     */
    public function report($info = "ok")
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $objToReportId = $_POST["objToReportId"];
        $objToReportType = $_POST["objToReportType"];
        $view = new VPost();
        $params = array(
            "objToReportId" => $objToReportId,
            "objToReportType" => $objToReportType
        );
        $view->showReportPage($params);
    }

    /**
     * Send report
     * 
     * Stores a report in DB 
     */
    public function confirmReport()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $description = $_POST["description"];
        $objId = $_POST["objToReportId"];
        $objType = $_POST["objToReportType"];

        if(!CPost::check($description)) {
            header("Location: /post/report?info=badInput");
            exit();
        }

        if ($description == "" || strlen($description) > 256) { // Se la lunghezza massima è maggiore di 256 va rimandato alla report ma bisogna passargli i parametri del commento da segnalare
            header("Location: /post/standard");
            exit();
        }

        $allowedTypes = array("standard", "team", "sale", "comment");

        if (!in_array($objType, $allowedTypes)) {
            header("Location: /error/e404");
            exit();
        }

        $pm = new FPersistentManager();
        $report = new EReport(1, $user->getId(), $objId, $objType, $description, date("Y-m-d H:i:s"));
        if(!$pm->store($report)) {
            header("Location: /error/e404");
            exit();
        }

        if (strcmp($objType, "comment") == 0) {
            $comment = $pm->load("EComment", array("id" => $objId))[0];
            $postId = $pm->load("EPostStandard", array("id" => $comment["postStandardId"]))[0]["id"];
            header("Location: /post/comments?id=" . $postId);
            exit();
        } else {
            header("Location: /post/" . $objType);
            exit();
        }
    }

    /**
     * Check if owner
     * 
     * Checks if the current user is the owner of a post.
     */
    public function isowner() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        $pm = new FPersistentManager();

        if(isset($_POST["postStandardId"])) {
            $postId = $_POST["postStandardId"];
            $postUserId = $pm->load("EPostStandard", array("id"=> $postId))[0]["userId"];
        } else if(isset($_POST["postSaleId"])) {
            $postId = $_POST["postSaleId"];
            $postUserId = $pm->load("EPostSale", array("id"=> $postId))[0]["userId"];
        } else if(isset($_POST["postTeamId"])) {
            $postId = $_POST["postTeamId"];
            $postUserId = $pm->load("EPostTeam", array("id"=> $postId))[0]["userId"];
        }

        if($user->getId() == $postUserId) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /**
     * Participation
     * 
     * Set the current user in a team with a participation
     */
    public function participate()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $postTeamId = $_POST["postTeamId"];

        $pm = new FPersistentManager();

        $postTeam = $pm->load("EPostTeam", array("id" => $postTeamId));

        if($postTeam == array()) {
            header("Location: /error/e404");
            exit();
        }
        
        $postTeam = $postTeam[0];

        $chatId = $pm->load("EChat", array("postId" => $postTeamId, "postType" => "team"))[0]["id"];

        if ($pm->load("EParticipation", array("userId" => $user->getId(), "postTeamId" => $postTeamId)) == array()) {
            if($postTeam["nPlayers"] == $postTeam["nMaxPlayers"]){
                echo "Full";
                exit();
            }
            $participation = new EParticipation($user->getId(), $postTeamId);
            if(!$pm->store($participation)) {
                header("Location: /error/e404");
                exit();
            }
            
            $datetime = date("Y-m-d H:i:s");
            $chatuser = new EChatUser($chatId, $user->getId(), $datetime);
            if(!$pm->store($chatuser)) {
                header("Location: /error/e404");
                exit();
            }
            
            $newPostTeam = new EPostTeam($postTeam["id"], $postTeam["userId"], $postTeam["title"], $postTeam["description"], $postTeam["datetime"], $postTeam["nMaxPlayers"], $postTeam["nPlayers"] + 1, $postTeam["time"]);
            $pm->update($newPostTeam, array("id" => $postTeamId));
        } else {
            $pm->delete("EParticipation", array("userId" => $user->getId(), "postTeamId" => $postTeamId));
            $pm->delete("EChatUser", array("chatId" => $chatId, "userId" => $user->getId()));
            $newPostTeam = new EPostTeam($postTeam["id"], $postTeam["userId"], $postTeam["title"], $postTeam["description"], $postTeam["datetime"], $postTeam["nMaxPlayers"], $postTeam["nPlayers"] - 1, $postTeam["time"]);
            $pm->update($newPostTeam, array("id" => $postTeamId));
        }
    }

    /**
     * Check if participating
     * 
     * Checks if the current user is part of a team based on the related post id.
     */
    public function isparticipating()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $postTeamId = $_POST["postTeamId"];
        $pm = new FPersistentManager();

        if ($pm->load("EParticipation", array("userId" => $user->getId(), "postTeamId" => $postTeamId)) != array() and $pm->load("EPostTeam", array("id" => $postTeamId))[0]["userId"] != $user->getId()) {
            echo 1;
        } elseif ($pm->load("EPostTeam", array("id" => $postTeamId))[0]["userId"] == $user->getId()) {
            echo 2;
        } else {
            echo 0;
        }
    }

    /**
     * Buy
     * 
     * Create a chat between user and post owner
     */
    public function buy()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $postSaleId = $_POST["postSaleId"];
        $post = $pm->load("EPostSale", array("id" => $postSaleId));

        if($post == array()) {
            header("Location: /error/e404");
            exit();
        }

        $post = $post[0];

        $chat = $pm->load("EChat", array("postId" => $postSaleId, "postType" => "sale"));

        $exists = false;

        if ($chat != null) {
            for ($i = 0; $i < count($chat); $i++) {
                $chatId = $chat[$i]["id"];
                $chatUser = $pm->load("EChatUser", array("chatId" => $chatId));

                $users = array();
                for ($j = 0; $j < count($chatUser); $j++) {
                    $users[] = $chatUser[$j]["userId"];
                }

                if (in_array($user->getId(), $users)) {
                    $exists = true;
                    break;
                }
            }
        }

        if (!$exists && $user->getId() != $post["userId"]) {
            $datetime = date("Y-m-d H:i:s");
            $chat = new EChat(0, $postSaleId, "sale", $datetime);
            if(!$chatId = $pm->store($chat)) {
                header("Location: /error/e404");
                exit();
            }

            $idOwner = $pm->load("EPostSale", array("id" => $postSaleId))[0]["userId"];
            $chatUser = new EChatUser($chatId, $idOwner, $datetime);
            if(!$pm->store($chatUser)) {
                header("Location: /error/e404");
                exit();
            }

            $userId = $pm->load("EUser", array("username" => $user->getUsername()))[0]["id"];
            $chatUser = new EChatUser($chatId, $userId, $datetime);
            if(!$pm->store($chatUser)) {
                header("Location: /error/e404");
                exit();
            }
        }

        header("Location: /user/chats");
        exit();
    }

    /**
     * Check if bought
     * 
     * Checks if a post has already a chat associated
     */
    public function isBought()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if ($user == null) {
            header("Location: /login");
            exit();
        }

        $postSaleId = $_POST["postSaleId"];
        $pm = new FPersistentManager();

        $post = $pm->load("EPostSale", array("id" => $postSaleId))[0];
        if ($user->getId() == $post["userId"]) {
            echo 2;
            exit();
        }

        $chat = $pm->load("EChat", array("postId" => $postSaleId, "postType" => "sale"));

        $exists = 0;
        if ($chat != null) {
            for ($i = 0; $i < count($chat); $i++) {
                $chatId = $chat[$i]["id"];
                $chatUser = $pm->load("EChatUser", array("chatId" => $chatId));

                $users = array();
                for ($j = 0; $j < count($chatUser); $j++) {
                    $users[] = $chatUser[$j]["userId"];
                }

                if (in_array($user->getId(), $users)) {
                    $exists = 1;
                    break;
                }
            }
        }

        echo $exists;
    }

    /**
     * Delete post
     * 
     * Deletes a post created by the current user.
     */
    public function delete() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $user = $session->load("user");

        if($user == null) {
            header("Location: /login");
            exit();
        }

        $postId = $_POST["postId"];
        $postType = $_POST["postType"];

        $pm = new FPersistentManager();
        if($postType == "standard") {
            $pm->delete("EPostStandard", array("id" => $postId));
        } else if($postType == "team") {
            $pm->delete("EPostTeam", array("id" => $postId));
        } else if($postType == "sale") {
            $pm->delete("EPostSale", array("id" => $postId));
        }
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
    private static function check(string $s)
    {
        if (!preg_match("/^[a-zA-Z0-9à-üÀ-Ü\/@.#!_?:<>;, \-]*$/", $s)) {
            return false;
        }
        return true;
    }
}
