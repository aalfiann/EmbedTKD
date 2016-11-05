<?php
    include_once 'library.php';
    $data = curl_get_contents($api."?mode=destinasicompletion&term=".$_GET['term']);
    $data = json_decode($data);
    echo json_encode($data->results) ;
?>