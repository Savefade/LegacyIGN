<?php
include "configuration.php";
if(isset($_COOKIE["ds_user_id"]) || isset($_COOKIE["sessionid"])){
    $getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
        $AccountID = $_COOKIE["ds_user_id"];
        $getsession = $getdbdata->prepare('SELECT ID, username, sessionid FROM accounts WHERE ID = ?;');
        $getsession->bind_param("s", $AccountID);
        $getsession->execute();
        $getsession = $getsession->get_result();
        $getsessiondata = $getsession->fetch_assoc();
        $sessionid = $getsessiondata['sessionid'];
        if($_COOKIE['sessionid'] != $sessionid){
        exit;
        }

    $signeddatafromthegram = isset($_POST['signed_body']) ? $_POST['signed_body'] : null;
    $caption = "No caption has been set!";
    if($signeddatafromthegram != null){
    $sentjson = substr($signeddatafromthegram, 65); // 
    $decodedjson = json_decode($sentjson, false);
    if(isset($decodedjson->upload_id)){
    $upload_id = $decodedjson->upload_id;
    }
    else{
        $upload_id = $decodedjson->device_timestamp;
    }
    //$id = $decodedjson->_uid;
    if(isset($decodedjson->caption)){
    $caption = $decodedjson->caption;
    }
    }
    if($signeddatafromthegram == null){
    $upload_id = $_POST["device_timestamp"];
    if(isset($_POST["caption"])){
    $caption = $_POST["caption"];
    }
    }
$query = $getdbdata->prepare('UPDATE posts SET description= ?, originaluploadid = 0 WHERE originaluploadid = ? LIMIT 1');
$query->bind_param('ss', $caption, $upload_id);
$query->execute();
}
    die(json_encode(array(
        'status' => "ok"
    )));