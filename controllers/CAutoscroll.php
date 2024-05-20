<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CPost.php");

    class CAutoscroll {

        public function getElements(string $type,int $offset,int $limit,string $datetime) {
            $types = array(
                'standard'=>'CPost',
                'team'=>'CPost',
                'sell'=>'CPost'
            );
            
            if($type != "0") {

                try {

                    $view = new $types[$type]();
                    $elements = $view->loadPosts($type,$offset,$limit,$datetime);

                    return $elements;

                } catch(Exception $e) {
                    //REINDIRIZZAMENTO
                }
                
                
            } else {
                //ERROR OF PRINTING TYPE, REDIRECT ON 500 PAGE
            }

            
        }

    }
?>