<?php

    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CUser.php");
    require_once realpath($_SERVER["DOCUMENT_ROOT"]."/utility/USession.php");
    
    class CAutoscroll {

        public function load($offset,$totalcount,$type,$date,$time) {

            //AUTOSCROLL
            //Date input
            $date = explode("/",$date);
            $date = $date[0]."-".$date[1]."-".$date[2];
            //Time Input
            $time = explode(":",$time);
            $time = $time[0].":".$time[1].":".$time[2];

            $datetime = $date." ".$time;

            $limit = 7; //LIMITE NUMERO POST
            $method = "get".ucfirst($type)."Elements";
            if(method_exists(__CLASS__,$method)) {
                $elements = $this->{$method}($offset, $limit,$datetime);
                $rows = $elements[0];
                if($totalcount >= $offset) {
                    $offset+= $limit;
                }
                $totalcount += $elements[1];

                // $session = USession::getInstance();
                // $userId = $session->load("user")->getId();
                // for($i=0;$i<count($rows);$i++) {
                //     if($userId == $rows[$i]["userId"]) {
                //         $rows[$i]["posses"] = 1;
                //     } else {
                //         $rows[$i]["posses"] = 1;
                //     }
                // }

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

        public function loadbyid($id,int $offset,int $totalcount,string $type,string $date,string $time) {
            //AUTOSCROLL
            //Date input
            $date = explode("/",$date);
            $date = $date[0]."-".$date[1]."-".$date[2];
            //Time Input
            $time = explode(":",$time);
            $time = $time[0].":".$time[1].":".$time[2];

            $datetime = $date." ".$time;

            $limit = 7; //LIMITE NUMERO POST
            $method = "get".ucfirst($type)."Elements";
            if(method_exists(__CLASS__,$method)) {
                $elements = $this->{$method}($id,$offset,$limit,$datetime);
                $rows = $elements[0];
                if($totalcount >= $offset) {
                    $offset+= $limit;
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
            

        private static function getStandardElements(int $offset,int $limit,string $datetime) {

            $controller = new CPost();       
            $elements = $controller->loadStandardPosts($offset,$limit,$datetime);
            return $elements;

        }

        private static function getsaleElements(int $offset,int $limit,string $datetime) {

            $controller = new CPost();       
            $elements = $controller->loadsalePosts($offset,$limit,$datetime);
            return $elements;

        }

        private static function getTeamElements(int $offset,int $limit,string $datetime) {

            $controller = new CPost();       
            $elements = $controller->loadTeamPosts($offset,$limit,$datetime);
            return $elements;

        }

        private function getCommentElements(int $postId,int $offset,int $limit,string $datetime) {

            $controller = new CPost();
            $elements = $controller->loadComments($postId,$offset,$limit,$datetime);
            return $elements;
        }

        private function getChatElements(string $username,int $offset,int $limit,string $datetime) {
            $controller = new CUser;       
            $elements = $controller->loadChats($username,$offset,$limit,$datetime);
            return $elements;
        }

        private function getMessageElements(int $chatId,int $offset,int $limit,string $datetime) {
            $controller = new CUser();
            $elements = $controller->loadMessages($chatId,$offset,$limit,$datetime);
            return $elements;
        }
    }
?>