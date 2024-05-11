<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/foundation/FDB.php");
    require realpath($_SERVER["DOCUMENT_ROOT"]."/entity/EAdmin.php");
   
    $x = FDB::getInstance();
    //echo $x->load("Admin",1);

    $admin = new EAdmin(1,"c","ci","c","c","2000-01-01","c","c");
    
    $x->store("Admin",$admin);
?>