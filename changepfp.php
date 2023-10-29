<?php
include "configuration.php";
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
//
        $AccountID = $_COOKIE["ds_user_id"];
        $getsession = $getdbdata->prepare('SELECT ID, username, sessionid FROM accounts WHERE ID = ?;');
        $getsession->bind_param("s", $AccountID);
        $getsession->execute();
        $getsession = $getsession->get_result();
        $getsessiondata = $getsession->fetch_assoc();
        $sessionid = $getsessiondata['sessionid'];
        $username = $getsessiondata['username'];
        if($_COOKIE['sessionid'] != $sessionid){
        unset($_COOKIE['sessionid']);
        unset($_COOKIE['ds_user_id']);
        exit;
        }
//
if(isset($_FILES['profile_pic'])){
$uploadedphoto = $_FILES["profile_pic"]["tmp_name"];
$nameofdafile = "pfps/" . $username . ".png";
if(move_uploaded_file($uploadedphoto, $nameofdafile)){
die(json_encode(array('status' => 'ok',)));
}else{die(json_encode(array('status' => 'fail',)));}
}