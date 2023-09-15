<?php
include "configuration.php";
if($isenabled){
$id = $_GET['id'];
if($id != 1){    $response = array(
        'items' => array(),
        'num_items' => 0,
        'more_available' => false,
        'status' => "ok"
    );
    die(json_encode($response));
}
else{
    header('Location: ' . $baseurl . '/ign/popular.php');
}
}