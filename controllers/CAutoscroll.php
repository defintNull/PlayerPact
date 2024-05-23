<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");

    class CAutoscroll {

        public function getElements(string $type,int $offset,int $limit,string $datetime) {
            $types = array(
                'standard'=>'CPost',
                'team'=>'CPost',
                'sell'=>'CPost'
            );

            try {
                $class = $types[$type];
            } catch(Exception $e) {
                //REINDIRIZZAMENTO
            }

            $controller = new $class();       
            $elements = $controller->loadPosts($type,$offset,$limit,$datetime);
            return $elements;

        }
    }
?>