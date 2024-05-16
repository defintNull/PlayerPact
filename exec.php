<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EAdmin.php");
   
    $x = FDB::getInstance();
    
    $admin = new EAdmin(10,"no","c","c","c","2000-01-01","no","c");
    echo $x->exists("Admin",$admin);

    echo var_dump($x->load("Admin", "1=1"));
?>