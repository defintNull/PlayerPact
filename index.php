<?php
    require_once (__DIR__."/FrontController.php");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);

    $frontcontroller = new FrontController();
    if($uri[1] == null) {
        $frontcontroller->home();
    }
    
    $frontcontroller->{$uri[1]}();

?>