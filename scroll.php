<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/resources/view/VPost.php");

    //AUTOSCROLL
    $offset = (int)($_GET['offset'] ?? 0);
    $dataOnly = (int)($_GET['dataOnly'] ?? 0);
    $limit = 7; //LIMITE NUMERO POST
    $type = "standard"; //DA CAMBIARE CON LOGICA O VARIABILE TEMPLATE
    $rows = VPost::getData($type,$offset, $limit);
    $offset+= $limit;
    $totalcount = VPost::getCount();
    $data = [
        'rows' => $rows,
        'offset' => $offset,
        'totalcount' => $totalcount
    ];

    echo json_encode($data);
    
?>