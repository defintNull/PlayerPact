<?php

    require realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VPost.php");

    class CAutoscroll {

        public function getElements(string $type,int $offset,int $limit,string $datetime) {
            $types = array(
                'standard'=>'VPost',
                'team'=>'VPost',
                'sell'=>'VPost'
            );
            
            if($type != "0") {

                $view = new $types[$type]();
                $elements = $view->getPostElements($type,$offset,$limit,$datetime);

                return $elements;
                
            } else {
                //ERROR OF PRINTING TYPE, REDIRECT ON 500 PAGE
            }

            
        }

    }
?>