<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EAdmin.php");
   
    $x = FDB::getInstance();
    echo var_dump($x->load("Admin",1));

    $admin = new EAdmin(1,"ciao","c","c","c","2000-01-01","c","c");
    
    $x->store("Admin",$admin);
?>