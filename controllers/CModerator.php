<?php
require_once realpath(__DIR__."/../entity/EProfile.php");
require_once realpath(__DIR__."/../entity/EReport.php");
require_once realpath(__DIR__."/../entity/EUser.php");
require_once realpath(__DIR__."/../utility/USession.php");
require_once realpath(__DIR__."/../entity/EModerator.php");
require_once realpath(__DIR__."/../entity/EModerationResult.php");
require_once realpath(__DIR__."/../entity/EBannedUser.php");
require_once realpath(__DIR__."/../foundation/FPersistentManager.php");
require_once realpath(__DIR__."/../view/VModerator.php");

/**
 * Manage moderator related operations in controller level
 *
 * Manages all the moderator related operations, like deleting/ban users,
 * managing reports and deleting posts/comments.
 *
 * @package Playerpact\Controllers
 */
class CModerator
{
    /**
     * Check current session
     *
     * Checks if the current session is valid, that is to say if
     * the moderator is still in DB or not
     *
     * @param $session The session to check
     * 
     */
    private function checkSession($session)
    {
        $user = $session->load("moderator");
        if ($user != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EModerator", array("id" => $user->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
    }

    /**
     * Moderator home page controller
     *
     * Manages the visualization of the moderator home page, with session check,
     * view initialization and the call to the relative show method.
     * 
     */
    public function home()
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        $params = array("username" => $mod->getUsername() . " (mod)",
                        "profilePicture" => $PPImageURL);
        $view = new VModerator();
        $view->showHome($params);
    }

    /**
     * Show reports
     *
     * Shows active reports page
     * 
     */
    public function reports() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        $params = array("username" => $mod->getUsername() . " (mod)",
                        "profilePicture" => $PPImageURL);
        $view = new VModerator();
        $view->showReports($params);
    }

    /**
     * Show users
     *
     * Manage the view that shows the users list page.
     * 
     * @param string $search This string is used to load the search parameter into JS
     * @param string $info This string is used to show any errors on the page related to the search bar
     */
    public function users(string $search = "", string $info = "ok") {
        $session = USession::getInstance();
        $this->checkSession($session);
        $mod = $session->load("moderator");

        if ($mod == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($mod->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($mod->getImage());
        }

        if(!CModerator::check($search)) {
            header("Location: /moderator/users?info=badInput");
            exit();
        }

        $params = array(
            "username" => $mod->getUsername() . " (mod)",
            "profilePicture" => $PPImageURL,
            "search" => $search
        );
                        
        $view = new VModerator();
        $view->showUsers($params);
    }

    /**
     * Report load
     *
     * Loads reports according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of reports loaded.
     * 
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadReports(int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('moderator');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsByCondition("EReport", array("status" => "received"), $limit, $offset, $datetime);
        $count = 0;

        for ($i = 0; $i < count($res); $i++) {
            $report = new EReport($res[$i]["id"], $res[$i]["userId"], $res[$i]["idToReport"], $res[$i]["type"], $res[$i]["description"], $res[$i]["datetime"]);
            $reportUser = $pm->load("EUser", array("id" => $report->getUserId()));
            if($reportUser != array()) {
                $reportUsername = $reportUser[0]["username"];
            } else {
                $reportUsername = "Deleted User";
            }
            $values[] = array(
                "id" => $report->getId(),
                "username" => $reportUsername,
                "idToReport" => $report->getIdToReport(),
                "type" => $report->getType(),
                "datetime" => $report->getDateTime()
            );
            $count++;
        }
        return array($values, $count);
    }

    /**
     * Users load
     *
     * Loads users according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of users loaded.
     * 
     * @param string $condition The search field that matches the username
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadUsers(string $condition, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('moderator');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsLike("EUser", $condition, $limit, $offset, $datetime);
        $count = count($res);

        for ($i = 0; $i < $count; $i++) {
            $user = new EUser($res[$i]["id"], $res[$i]["username"], $res[$i]["password"], $res[$i]["name"], $res[$i]["surname"], $res[$i]["birthDate"], $res[$i]["email"], $res[$i]["image"]);
            $values[] = array(
                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "email" => $user->getEmail()
            );
            if($user->getImage() != ""){
                $values[$i]["image"] = base64_encode($user->getImage());
            } else {
                $values[$i]["image"] = "/public/defaultPropic.png";
            }
        }
        return array($values, $count);
    }

    /**
     * Delete a user
     *
     * Deletes a user depending on the user id sent from JS.
     */
    public function deleteUser() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $userId = $_POST["userId"];

        $pm = new FPersistentManager();
        $user = $pm->load("EUser", array("id" => $userId));
        if($user != array()) {
            $user = $user[0];
            $pm->delete("EUser", array("id" => $userId));
            $pm->delete("EProfile", array("username" => $user["username"], "type" => "user"));
        }
    }

    /**
     * Manage the report detail view
     *
     * Assigns parameter to associated view to show the report detail page depending on the report id.
     */
    public function reportDetail(int $id, string $type) {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($moderator->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($moderator->getImage());
        }
    
        $pm = new FPersistentManager();
        $report = $pm->load("EReport", array("id" => $id));

        if($report == array()) {
            header("Location: /moderator/reports");
            exit(); 
        }

        $report = $report[0];
        $reportedId = $report["idToReport"];

        if($type=="standard") {
            $post = $pm->load("EPostStandard", array("id" => $reportedId));
            if($post == array()) {
                $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
                $pm->update($report, array("id"=> $report->getId()));
                header("Location: /moderator/reports");
                exit();
            }
            $post = $post[0];
            $user = $pm->load("EUser", array("id" => $post["userId"]));
            if($user == array()) {
                $user = array("username" =>"Deleted user");
            }
            $user = $user[0];
            $params = array(
                "username" => $moderator->getUsername() . " (mod)",
                "profilePicture" => $PPImageURL,
                "reportId" => $id,
                "type" => $type,
                "postUsername" => $user["username"],
                "postTitle" => $post["title"],
                "postDescription" => $post["description"],
                "postDatetime" => $post["datetime"],
                "ownerId" => $post["userId"]
            );
        } elseif($type=="team") {
            $post = $pm->load("EPostTeam", array("id" => $reportedId));
            if($post == array()) {
                $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
                $pm->update($report, array("id"=> $report->getId()));
                header("Location: /moderator/reports");
                exit();
            }
            $post = $post[0];
            $user = $pm->load("EUser", array("id" => $post["userId"]));
            if($user == array()) {
                $user = array("username" =>"Deleted user");
            }
            $user = $user[0];
            $params = array(
                "username" => $moderator->getUsername() . " (mod)",
                "profilePicture" => $PPImageURL,
                "reportId" => $id,
                "type" => $type,
                "postUsername" => $user["username"],
                "postTitle" => $post["title"],
                "postDescription" => $post["description"],
                "postTime" => $post["time"],
                "nPlayers" => $post["nPlayers"],
                "maxPlayers" => $post["nMaxPlayers"],
                "postDatetime" => $post["datetime"],
                "ownerId" => $post["userId"]
            );
        } elseif($type=="sale") {
            $post = $pm->load("EPostSale", array("id" => $reportedId));
            if($post == array()) {
                $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
                $pm->update($report, array("id"=> $report->getId()));
                header("Location: /moderator/reports");
                exit();
            }
            $post = $post[0];
            $user = $pm->load("EUser", array("id" => $post["userId"]));
            if($user == array()) {
                $user = array("username" =>"Deleted user");
            }
            $user = $user[0];
            $params = array(
                "username" => $moderator->getUsername() . " (mod)",
                "profilePicture" => $PPImageURL,
                "reportId" => $id,
                "type" => $type,
                "postUsername" => $user["username"],
                "postTitle" => $post["title"],
                "postDescription" => $post["description"],
                "postDatetime" => $post["datetime"],
                "postPrice" => $post["price"],
                "image" => "data:image/png;base64,".base64_encode($post["image"]),
                "ownerId" => $post["userId"]
            );
        } elseif($type=="comment") {
            $comment = $pm->load("EComment", array("id" => $reportedId));
            if($comment == array()) {
                $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
                $pm->update($report, array("id"=> $report->getId()));
                header("Location: /moderator/reports");
                exit();
            }

            $comment = $comment[0];
            $user = $pm->load("EUser", array("id" => $comment["userId"]));
            if($user == array()) {
                $user = array("username" =>"Deleted user");
            }
            $user = $user[0];
            $params = array(
                "username" => $moderator->getUsername() . " (mod)",
                "profilePicture" => $PPImageURL,
                "reportId" => $id,
                "type" => $type,
                "commentUsername" => $user["username"],
                "commentDescription" => $comment["description"],
                "commentDatetime" => $comment["datetime"],
                "ownerId" => $comment["userId"]
            );
        }

        $user = $pm->load("EUser", array("id" => $report["userId"]));
        if($user == array()) {
            $user = array("username" =>"Deleted user");
        }
        $user = $user[0];
        $params["reportUsername"] = $user["username"];
        $params["idToReport"] = $report["idToReport"];
        $params["reportType"] = $report["type"];
        $params["reportDescription"] = $report["description"];
        $params["reportDatetime"] = $report["datetime"];

        $view = new VModerator();
        $view->showReportDetail($params);
    }

    /**
     * Ignore a report
     *
     * Mark a report as closed and redirect to the reports page.
     */
    public function ignoreReport() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $reportId = $_POST["reportId"];

        $pm = new FPersistentManager();
        $report = $pm->load("EReport", array("id"=> $reportId))[0];
        if($report["status"] != "received") {
            header("Location: /moderator/reports");
            exit();
        }
        $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
        $pm->update($report, array("id"=> $report->getId()));

        $moderation = new EModerationResult(0, $reportId, $moderator->getId(), "Report ignored", date("Y-m-d H:i:s"));
        
        if(!$pm->store($moderation)) {
            header("Location: /error/e404");
            exit();
        }
        
    }

    /**
     * Delete a post/comment
     *
     * Deletes a post/comment previously reported and marks the report as closed.
     */
    public function deleteReportedElement() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();

        $reportedId = $_POST["reportedId"];
        $reportId = $_POST["reportId"];
        $type = $_POST["type"];

        $report = $pm->load("EReport", array("id"=> $reportId))[0];
        if($report["status"] != "received") {
            header("Location: /moderator/reports");
            exit();
        }

        if($type == "standard") {
            $pm->delete("EPostStandard", array("id"=> $reportedId));
            $moderationDescription = "Deleted post";
        } else if($type == "team") {
            $pm->delete("EPostTeam", array("id"=> $reportedId));
            $moderationDescription = "Deleted post";
        } else if($type == "sale") {
            $pm->delete("EPostSale", array("id"=> $reportedId));
            $moderationDescription = "Deleted post";
        } else if($type == "comment") {
            $pm->delete("EComment", array("id"=> $reportedId));
            $moderationDescription = "Deleted comment";
        }

        $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
        $pm->update($report, array("id"=> $report->getId()));

        $moderation = new EModerationResult(0, $reportId, $moderator->getId(), $moderationDescription, date("Y-m-d H:i:s"));
        
        if(!$pm->store($moderation)) {
            header("Location: /error/e404");
            exit();
        }
    }

    /**
     * Ban a user
     *
     * Bans a user depending on the user id sent from JS and set the ban date until which the user cannot
     * access the application.
     */
    public function banUser() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $userId = $_POST["userId"];
        $banDate =$_POST["banDate"];
        $datetime = new DateTime($banDate);
        $banDate = $datetime->format("Y-m-d");
        $reportId = $_POST["reportId"];

        $pm = new FPersistentManager();

        $report = $pm->load("EReport", array("id"=> $reportId))[0];
        if($report["status"] != "received") {
            echo "reportNotValid";
            exit();
        }

        if($banDate < date("Y-m-d")) {
            echo "dateNotValid";
            exit();
        }

        $reportUpdate = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
        $pm->update($reportUpdate, array("id"=> $reportUpdate->getId()));

        $moderation = new EModerationResult(0, $reportId, $moderator->getId(), "User banned", date("Y-m-d H:i:s"));
        $moderationId = $pm->store($moderation);

        if($moderationId == 0) {
            $reportUpdate = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "received");
            $pm->update($reportUpdate, array("id"=> $reportUpdate->getId()));
            exit();
        }

        $bannedUser = new EBannedUser(0, $userId, $moderationId, $banDate, date("Y-m-d H:i:s"));
        
        if(!$pm->store($bannedUser)) {
            $reportUpdate = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "received");
            $pm->update($reportUpdate, array("id"=> $reportUpdate->getId()));
            exit();
        }
    }

    /**
     * Delete a user
     *
     * Deletes a user depending on the user id sent from JS after a report.
     */
    public function deleteUserAfterReport() {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $userId = $_POST["userId"];
        $reportId = $_POST["reportId"];

        $pm = new FPersistentManager();

        $report = $pm->load("EReport", array("id"=> $reportId))[0];
        if($report["status"] != "received") {
            echo "reportNotValid";
            exit();
        }

        $reportUpdate = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
        $pm->update($reportUpdate, array("id"=> $reportUpdate->getId()));

        $user = $pm->load("EUser", array("id" => $userId));
        if($user != array()) {
            $user = $user[0];
            $pm->delete("EUser", array("id" => $userId));
            $pm->delete("EProfile", array("username" => $user["username"], "type" => "user"));
        }
    }

    /**
     * Show old reports page
     *
     * Manage the view that shows the old reports page.
     * 
     * @param string $search This string is used to load the search parameter into JS
     * @param string $info This string is used to show any errors on the page related to the search bar
     */
    public function oldReports(string $search = "", string $info = "ok") {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderator = $session->load('moderator');

        if ($moderator == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($moderator->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($moderator->getImage());
        }

        if(!CModerator::check($search)) {
            header("Location: /moderator/oldReports?info=badInput");
            exit();
        }

        $params = array(
            "username" => $moderator->getUsername() . " (mod)",
            "profilePicture" => $PPImageURL,
            "search" => $search
        );
        $view = new VModerator();
        $view->showOldReports($params);
    }

    /**
     * Old reports load
     *
     * Loads old reports according to parameters through the use of PM. 
     * Returns the values needed in JS for the autoscrolling mechanism and
     * the number of old reports loaded.
     * 
     * @param string $search The search field that matches the username
     * @param int $offset The offset to put into the query in the PM call
     * @param int $limit The limit to put into the query in the PM call
     * @param string $datetime The datetime limit to put into the query in the PM call
     * 
     * @return array
     */
    public function loadOldReports(string $search, int $offset, int $limit, string $datetime)
    {
        $session = USession::getInstance();
        $this->checkSession($session);
        $admin = $session->load('moderator');

        if ($admin == null) {
            header("Location: /login");
            exit();
        }

        $pm = new FPersistentManager();
        $values = array();

        $res = $pm->loadElementsLikeByCondition("EReport", $search, array("status" => "closed"), $limit, $offset, $datetime);
        $count = count($res);
        
        for ($i = 0; $i < count($res); $i++) {
            $report = new EReport($res[$i]["id"], $res[$i]["userId"], $res[$i]["idToReport"], $res[$i]["type"], $res[$i]["description"], $res[$i]["datetime"], $res[$i]["status"]);
            $moderationResult = $pm->load("EmoderationResult", array("reportId" => $res[$i]["id"]));
            
            
            if($moderationResult != array()) {
                $reportUser = $pm->load("EUser", array("id" => $report->getUserId()));
                if($reportUser != array()) {
                    $reportUsername = $reportUser[0]["username"];
                } else {
                    $reportUsername = "Deleted User";
                }
                $values[] = array(
                    "id" => $report->getId(),
                    "username" => $reportUsername,
                    "idToReport" => $report->getIdToReport(),
                    "type" => $report->getType(),
                    "datetime" => $report->getDateTime()
                );
                
            }
            
        }
        return array($values, $count);
    }

    /**
     * Old report detail page
     *
     * Manage the view that shows the old report detail page.
     * 
     * @param int $id The old report id
     */
    public function oldreportDetail(int $id) {
        $session = USession::getInstance();
        $this->checkSession($session);
        $moderatorSession = $session->load('moderator');

        if ($moderatorSession == null) {
            header("Location: /login");
            exit();
        }

        $PPImageURL = "/public/defaultPropic.png";
        if ($moderatorSession->getImage() != "") {
            $PPImageURL = "data:image/png;base64," . base64_encode($moderatorSession->getImage());
        }

        $pm = new FPersistentManager();
        $moderation = $pm->load("EModerationResult", array("reportId" => $id));
        if($moderation == array()) {
            header("Location: /error/e404");
            exit();
        }
        $moderation = $moderation[0];
        $moderator = $pm->load("EModerator", array("id" => $moderation["modId"]));

        if($moderator == array()){
            $username = "Deleted moderator";
        } else {
            $username = $moderator[0]["username"];
        }

        $params = array(
            "username" => $moderatorSession->getUsername() . " (mod)",
            "profilePicture" => $PPImageURL,
            "reportId" => $moderation["reportId"],
            "moderatorUsername" => $username,
            "description" => $moderation["description"],
            "datetime" => $moderation["datetime"]
        );
        
        $view = new VModerator();
        $view->showOldReportDetail($params);
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
        if (!preg_match("/^[a-zA-Z0-9à-üÀ-Ü\/@.#!_-]*$/", $s)) {
            return false;
        }
        return true;
    }
}
