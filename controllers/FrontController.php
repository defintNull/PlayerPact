<?php
    
    class FrontController {

        public function run($uri) {
            $uri = explode("?",trim($uri,"/"));
            if(count($uri)>1) {
                $params = $uri[1];
                parse_str($params, $query);
                
            } else {
                $query = null;
            }
            $uri = explode("/", $uri[0]);
            
            if(!empty($uri[0])) {
                $controller = ucfirst($uri[0]);
            } else {
                $controller = "User";
            }
            $controller = "C".$controller;
            if(!empty($uri[1])) {
                $method = $uri[1];
            } else {
                $method = "home";
            }
            
            if(file_exists(__DIR__."/".$controller.".php")) {
                require_once realpath(__DIR__."/".$controller.".php");
                if(method_exists($controller, $method)) {
                    $controller = new $controller();
                    if($query != null) {
                        try {
                            $controller->{$method}(...$query);
                        } catch(Error $e) {
                            //echo $e;
                            header("Location: /error/e404");
                        }
                    } else {
                        try {
                            $controller->{$method}();
                        } catch(Error $e) {
                            //echo $e;
                            header("Location: /error/e404");
                        }
                    }
                    
                } else {
                    //echo "A";
                    header("Location: /error/e404");
                }
                
            } else {
                //echo "B";
                header("Location: /error/e404");
            }
        }
    }
?>