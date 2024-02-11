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
        if($_COOKIE['sessionid'] != $sessionid){
        unset($_COOKIE['sessionid']);
        unset($_COOKIE['ds_user_id']);
        exit;
        }
//
$signeddatafromthegram = $_POST["signed_body"];
$sentjson = substr($signeddatafromthegram, 65); // 
$decodedjson = json_decode($sentjson, false);
$website = $decodedjson->external_url;
if(strlen($website) > 0){
if(strpos($website, "http://") > 1){}
else{
if(strpos($website, "https://") > 1){}else{
$website = "http://" . $website;
}
} 
}
$phonenumber = $decodedjson->phone_number;
$first_name = $decodedjson->first_name;
$bio = $decodedjson->biography;
$private = $decodedjson->is_private;
if($private = true){
$is_private = 0; //even when this is 1
} // for some reason this is broken
else{
$is_private = 0;
}
$username = $decodedjson->username;
if(isset($_FILES['profile_pic'])){
$uploadedphoto = $_FILES["profile_pic"]["tmp_name"];
$nameofdafile = "pfps/" . $username . ".png";
if(move_uploaded_file($uploadedphoto, $nameofdafile)){
die(json_encode(array('status' => 'ok',)));
}else{die(json_encode(array('status' => 'fail',)));}
}
$updatedata = $getdbdata->prepare('UPDATE accounts SET username = ?, isaccountprivate = ?, fullname = ?, biography = ?, website = ?  WHERE ID = ? LIMIT 1');
$updatedata->bind_param("ssssss", $username, $is_private, $first_name, $bio, $website, $AccountID);
$updatedata->execute();
die(json_encode(array('status' => 'ok',)));
