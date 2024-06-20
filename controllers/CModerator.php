<?php
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EProfile.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EReport.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EUser.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/utility/USession.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EModerator.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EModerationResult.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/entity/EBannedUser.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/foundation/FPersistentManager.php");
require_once realpath($_SERVER["DOCUMENT_ROOT"] . "/resources/view/VModerator.php");

class CModerator
{
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

    public function users() {
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
        $view->showUsers($params);
    }

    public function profile() {
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
        $view->showProfile($params);
    }

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

    public function loadUsers(int $offset, int $limit, string $datetime)
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

        $res = $pm->loadElements("EUser", $limit, $offset, $datetime);
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
        $pm->store($moderation);
    }

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
        $pm->store($moderation);
    }
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
        $banDate = $datetime->format("Y-m-d H:i:s");
        $reportId = $_POST["reportId"];

        $pm = new FPersistentManager();

        $report = $pm->load("EReport", array("id"=> $reportId))[0];
        if($report["status"] != "received") {
            header("Location: /moderator/reports");
            exit();
        }

        $report = new EReport($report["id"], $report["userId"], $report["idToReport"], $report["type"], $report["description"], $report["datetime"], "closed");
        $pm->update($report, array("id"=> $report->getId()));

        $moderation = new EModerationResult(0, $reportId, $moderator->getId(), "User banned", date("Y-m-d H:i:s"));
        $moderationId = $pm->store($moderation);

        $bannedUser = new EBannedUser(0, $userId, $moderationId, $banDate, date("Y-m-d H:i:s"));
        $pm->store($bannedUser);
    }

    public function oldReports() {
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

        $params = array(
            "username" => $moderator->getUsername() . " (mod)",
            "profilePicture" => $PPImageURL
        );
        $view = new VModerator();
        $view->showOldReports($params);
    }

    public function loadOldReports(int $offset, int $limit, string $datetime)
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

        $res = $pm->loadElementsByCondition("EReport", array("status" => "closed"), $limit, $offset, $datetime);
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

    public function oldreportDetail($id) {
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
        $moderation = $pm->load("EModerationResult", array("reportId" => $id))[0];
        
        $params = array(
            "username" => $moderator->getUsername() . " (mod)",
            "profilePicture" => $PPImageURL,
            "moderationId" => $moderation["id"],
            "reportId" => $moderation["reportId"],
            "modId" => $moderation["modId"],
            "description" => $moderation["description"],
            "datetime" => $moderation["datetime"]
            
        );
        
        $view = new VModerator();
        $view->showOldReportDetail($params);
    }
}
