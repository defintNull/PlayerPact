<?php
    require realpath($_SERVER["DOCUMENT_ROOT"]."/controllers/CAutoscroll.php");

    //AUTOSCROLL
    $offset = (int)($_GET['offset'] ?? 0);
    $totalcount = (int)($_GET['total_count'] ?? 0);
    $type = (string)($_GET['type'] ?? "0");

    //Date input
    $datek = (string)($_GET['date'] ?? "2020/01/01");
    $date = explode("/",$datek);
    $date = $date[0]."-".$date[1]."-".$date[2];
    //Time Input
    $timek = (string)($_GET['time'] ?? "20:20:20");
    $time = explode(":",$timek);
    $time = $time[0].":".$time[1].":".$time[2];

    $datetime = $date." ".$time;

    $limit = 7; //LIMITE NUMERO POST
    $CAutoscroll = new CAutoscroll();
    $elements = $CAutoscroll->getElements($type,$offset, $limit,$datetime);
    $rows = $elements[0];
    if($totalcount >= $offset) {
        $offset+= $limit;
    }
    $totalcount += $elements[1];
    
    $data = [
        'rows' => $rows,
        'offset' => $offset,
        'totalcount' => $totalcount,
        'type' => $type,
        'date' => $datek,
        'time' => $timek
    ];

    echo json_encode($data);
    
?>