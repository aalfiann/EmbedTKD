<?php
    include_once 'library.php';
    $api = "https://api.tkd.co.id/v2/";
    $data = curl_get_contents($api."?mode=destinasicompletion&term=".$_GET['term']);
    $data = json_decode($data);
    echo json_encode($data->results) ;
?>