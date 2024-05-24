<?php
    require_once (__DIR__."/controllers/FrontController.php");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $query = $_SERVER['QUERY_STRING'];
    $uri = $uri."?".$query;

    $frontcontroller = new FrontController();
    $frontcontroller->run($uri);
?>