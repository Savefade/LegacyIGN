<?php
include "configuration.php";
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
$response = array(
        'items' => array(),
        'num_items' => 1,
		'more_available' => false,
        'status' => "ok"
    );
    die(json_encode($response));