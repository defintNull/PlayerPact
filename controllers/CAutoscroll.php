<?php

require_once realpath(__DIR__."/../controllers/CPost.php");
require_once realpath(__DIR__."/../controllers/CUser.php");
require_once realpath(__DIR__."/../controllers/CAdmin.php");
require_once realpath(__DIR__."/../controllers/CModerator.php");
require_once realpath(__DIR__."/../controllers/CModerator.php");
require_once realpath(__DIR__."/../utility/USession.php");

/**
 * Manage autoscroll related operations in controller level
 *
 * Manages all the autoscroll related operations, like the data upload for JS
 * and the load from DB of the elements to put inside the autoscroll.
 *
 * @package Playerpact\Controllers
 */
class CAutoscroll
{
    /**
     * Check current session
     *
     * Checks if the current session is valid, that is to say if the client
     * can execute certain uploads from DB based on his role (user, moderator or admin).
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
            if ($banned != array()) {
                $session->end();
            }
        }
        $moderator = $session->load("moderator");
        if ($moderator != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EModerator", array("id" => $moderator->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
        $admin = $session->load("admin");
        if ($admin != null) {
            $pm = new FPersistentManager();
            $checkUser = $pm->load("EAdmin", array("id" => $admin->getId()));
            if ($checkUser == array()) {
                $session->end();
            }
        }
    }

    /**
     * Load elements to insert into single rows
     *
     * Loads a certain number of elements from DB, through PM, and pass certain data
     * to JS by encoding them in JSON.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $totalcount The total number of elements that are loaded from DB
     * @param string $type The type of elements to load
     * @param string $date The date in which the loading from DB is done
     * @param string $time The time in which the loading from DB is done
     * 
     */
    public function load(int $offset, int $totalcount, string $type, string $date, string $time)
    {
        $session = USession::getInstance();
        $this->checkSession($session);

        $everybodyTypes = array("standard", "team", "sale", "comment");
        $userTypes = array("standard", "team", "sale", "comment", "chat", "message", "postUser", "savedPosts", "participations");
        $modTypes = array("report", "user", "oldreport");
        $adminTypes = array("moderator");

        $user = $session->load("user");
        $mod = $session->load("moderator");
        $admin = $session->load("admin");

        $ok = true;

        if ($user == null && $mod == null && $admin == null && !in_array($type, $everybodyTypes)) {
            $ok = false;
        } else if ($user != null && !in_array($type, $userTypes)) {
            $ok = false;
        } else if ($mod != null && !in_array($type, $modTypes)) {
            $ok = false;
        } else if ($admin != null && !in_array($type, $adminTypes)) {
            $ok = false;
        }

        if ($ok) {
            $date = explode("/", $date);
            $date = $date[0] . "-" . $date[1] . "-" . $date[2];
            $time = explode(":", $time);
            $time = $time[0] . ":" . $time[1] . ":" . $time[2];

            $datetime = $date . " " . $time;

            $limit = 7;
            $method = "get" . ucfirst($type) . "Elements";
            if (method_exists(__CLASS__, $method)) {
                $elements = $this->{$method}($offset, $limit, $datetime);
                $rows = $elements[0];

                if ($totalcount >= $offset) {
                    $offset += $limit;
                }
                $totalcount += $elements[1];

                $session = USession::getInstance();
                $user = $session->load("user");
                if ($user != null) {
                    $userId = $user->getId();
                    for ($i = 0; $i < count($rows); $i++) {
                        if ($userId == $rows[$i]["userId"]) {
                            $rows[$i]["posses"] = 1;
                        } else {
                            $rows[$i]["posses"] = 1;
                        }
                    }
                }

                $data = [
                    'rows' => $rows,
                    'offset' => $offset,
                    'totalcount' => $totalcount,
                    'type' => $type,
                    'date' => $date,
                    'time' => $time
                ];

                echo json_encode($data);
            } else {
                header("Location: /error/e404");
            }
        }
    }

    /**
     * Load elements by id, to insert them into single rows
     *
     * Loads a certain number of elements from DB by id, through PM, and pass certain data
     * to JS by encoding them in JSON.
     *
     * @param int $id The id of the DB row to be loaded
     * @param int $offset The offset to insert in the SQL query
     * @param int $totalcount The total number of elements that are loaded from DB
     * @param string $type The type of elements to load
     * @param string $date The date in which the loading from DB is done
     * @param string $time The time in which the loading from DB is done
     * 
     */
    public function loadbyid(int $id, int $offset, int $totalcount, string $type, string $date, string $time)
    {
        $date = explode("/", $date);
        $date = $date[0] . "-" . $date[1] . "-" . $date[2];
        $time = explode(":", $time);
        $time = $time[0] . ":" . $time[1] . ":" . $time[2];

        $datetime = $date . " " . $time;

        $limit = 7;
        $method = "get" . ucfirst($type) . "Elements";
        if (method_exists(__CLASS__, $method)) {
            $elements = $this->{$method}($id, $offset, $limit, $datetime);
            $rows = $elements[0];
            if ($totalcount >= $offset) {
                $offset += $limit;
            }
            $totalcount += $elements[1];

            $data = [
                'rows' => $rows,
                'id' => $id,
                'offset' => $offset,
                'totalcount' => $totalcount,
                'type' => $type,
                'date' => $date,
                'time' => $time
            ];

            echo json_encode($data);
        } else {
            header("Location: /error/e404");
        }
    }

    /**
     * Load elements by a certain condition, to insert them into single rows
     *
     * Loads a certain number of elements from DB by a certain condition, through PM, and pass certain data
     * to JS by encoding them in JSON.
     *
     * @param string $condition The condition to send to DB to load the desired rows
     * @param int $offset The offset to insert in the SQL query
     * @param int $totalcount The total number of elements that are loaded from DB
     * @param string $type The type of elements to load
     * @param string $date The date in which the loading from DB is done
     * @param string $time The time in which the loading from DB is done
     * 
     */
    public function loadByCondition(string $condition, int $offset, int $totalcount, string $type, string $date, string $time)
    {
        $date = explode("/", $date);
        $date = $date[0] . "-" . $date[1] . "-" . $date[2];
        $time = explode(":", $time);
        $time = $time[0] . ":" . $time[1] . ":" . $time[2];

        $datetime = $date . " " . $time;

        $limit = 7;
        $method = "get" . ucfirst($type) . "Elements";
        if (method_exists(__CLASS__, $method)) {
            $elements = $this->{$method}($condition, $offset, $limit, $datetime);
            $rows = $elements[0];
            if ($totalcount >= $offset) {
                $offset += $limit;
            }
            $totalcount += $elements[1];

            $data = [
                'rows' => $rows,
                'id' => $condition,
                'offset' => $offset,
                'totalcount' => $totalcount,
                'type' => $type,
                'date' => $date,
                'time' => $time
            ];

            echo json_encode($data);
        } else {
            header("Location: /error/e404");
        }
    }

    /**
     * Load into controller standard post elements
     *
     * Calls the loadStandardPosts method of the controller CPost to retrieve
     * an array of standard posts that match the search condition and the desired query parameters.
     *
     * @param string $search The string that match the post title
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private static function getStandardElements(string $search, int $offset, int $limit, string $datetime)
    {
        $controller = new CPost();
        $elements = $controller->loadStandardPosts($search, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller sale post elements
     *
     * Calls the loadsalePosts method of the controller CPost to retrieve
     * an array of sale posts that match the search condition and the desired query parameters.
     *
     * @param string $search The string that match the post title
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private static function getSaleElements(string $search, int $offset, int $limit, string $datetime)
    {
        $controller = new CPost();
        $elements = $controller->loadsalePosts($search, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller team post elements
     *
     * Calls the loadTeamPosts method of the controller CPost to retrieve
     * an array of team posts that match the search condition and the desired query parameters.
     *
     * @param string $search The string that match the post title
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private static function getTeamElements(string $search, int $offset, int $limit, string $datetime)
    {
        $controller = new CPost();
        $elements = $controller->loadTeamPosts($search, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller comment elements
     *
     * Calls the loadComments method of the controller CPost to retrieve
     * an array of comments that match the post in which they belong, based on the post id and the desired query parameters.
     *
     * @param int $postId The id that match the post in which the comments belong
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getCommentElements(int $postId, int $offset, int $limit, string $datetime)
    {
        $controller = new CPost();
        $elements = $controller->loadComments($postId, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller chat elements
     *
     * Calls the loadChats method of the controller CUser to retrieve
     * an array of chats that match the user to whom they belong, based on the username and the desired query parameters.
     *
     * @param string $username The username that match the post in which the comments belong
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getChatElements(string $username, int $offset, int $limit, string $datetime)
    {
        $controller = new CUser;
        $elements = $controller->loadChats($username, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller message elements
     *
     * Calls the loadMessages method of the controller CUser to retrieve
     * an array of messages that match the chat in which they belong, based on the chat id and the desired query parameters.
     *
     * @param int $chatId The id that match the chat in which the messages belong
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getMessageElements(int $chatId, int $offset, int $limit, string $datetime)
    {
        $controller = new CUser();
        $elements = $controller->loadMessages($chatId, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the relation between a generic post and his owner
     *
     * Calls the loadPostUsers method of the controller CUser to retrieve
     * an array of relations between a post and his owner based on the desired query parameters.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getPostUserElements(int $offset, int $limit, string $datetime)
    {
        $controller = new CUser();
        $elements = $controller->loadPostUsers($offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the user's saved sale posts
     *
     * Calls the loadSavedPosts method of the controller CUser to retrieve
     * an array of sale posts that the user marked as saved based on the desired query parameters.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getSavedPostsElements(int $offset, int $limit, string $datetime)
    {
        $controller = new CUser();
        $elements = $controller->loadSavedPosts($offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the team posts that a user participated to
     *
     * Calls the loadTeams method of the controller CUser to retrieve
     * an array of team posts that the user participates to based on the desired query parameters.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getParticipationsElements(int $offset, int $limit, string $datetime)
    {
        $controller = new CUser();
        $elements = $controller->loadTeams($offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the moderator elements avaliable to the admin
     *
     * Calls the loadModerators method of the controller CAdmin to retrieve
     * an array of moderators based on the desired query parameters.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getModeratorElements(int $offset, int $limit, string $datetime)
    {
        $controller = new CAdmin();
        $elements = $controller->loadModerators($offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the report elements avaliable to the moderator
     *
     * Calls the loadReports method of the controller CModerator to retrieve
     * an array of reports based on the desired query parameters.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getReportElements(int $offset, int $limit, string $datetime)
    {
        $controller = new CModerator();
        $elements = $controller->loadReports($offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the user elements avaliable to the moderator
     *
     * Calls the loadUsers method of the controller CModerator to retrieve
     * an array of users based on the desired query parameters.
     *
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getUserElements(string $condition, int $offset, int $limit, string $datetime)
    {
        $controller = new CModerator();
        $elements = $controller->loadUsers($condition, $offset, $limit, $datetime);
        return $elements;
    }

    /**
     * Load into controller the old report elements avaliable to the moderator
     *
     * Calls the loadOldReports method of the controller CModerator to retrieve
     * an array of old reports that match the search condition based on the desired query parameters.
     * 
     * @param string $search The string that match the report id to find
     * @param int $offset The offset to insert in the SQL query
     * @param int $limit The limit to insert in the SQL query
     * @param string $datetime The datetime to insert in the SQL query
     * 
     * @return array
     */
    private function getOldreportElements(string $search, int $offset, int $limit, string $datetime)
    {
        $controller = new CModerator();
        $elements = $controller->loadOldReports($search, $offset, $limit, $datetime);
        return $elements;
    }
}
