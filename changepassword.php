<?php
include "configuration.php";
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
//
$AccountID = $_COOKIE["ds_user_id"];
$getsession = $getdbdata->prepare('SELECT ID, username, sessionid, uniquetoken, password FROM accounts WHERE ID = ?;');
$getsession->bind_param("s", $AccountID);
$getsession->execute();
$getsession = $getsession->get_result();
$getsessiondata = $getsession->fetch_assoc();
$sessionid = $getsessiondata['sessionid'];
$password = $getsessiondata['password'];
$token = $getsessiondata['uniquetoken'];
if($_COOKIE['sessionid'] != $sessionid){
unset($_COOKIE['sessionid']);
unset($_COOKIE['ds_user_id']);
exit;
}
//
$signeddatafromthegram = $_POST["signed_body"];
$json = substr($signeddatafromthegram, 65);
$decoded_json = json_decode($json);
$old_password = $decoded_json->old_password;
$password1 = $decoded_json->new_password1;
$password2 = $decoded_json->new_password2;
if($password1 === $password2 && $password1 != $old_password){
$changedhash = $token . $password1 . $token;
if(password_verify($changedhash, $password)){
    $saltonhash = password_hash($changedhash, PASSWORD_BCRYPT);
    $setpassword = $getdbdata->prepare('UPDATE accounts SET password = ? WHERE ID = ? LIMIT 1');
    $setpassword->bind_param("ss", $saltonhash, $AccountID);
    $setpassword->execute();
    die(json_encode(array('status' => 'ok',)));
}
else{
    die(json_encode(array (
        'errors' => 
        array (
          'error' => 
          array (
            0 => 'Your old password has been entered incorrectly. Please enter it again!',
          ),
        ),
        'status' => 'fail',
        'error_type' => 'generic_request_error',
    )));
}
}
else{
    die(json_encode(array (
        'errors' => 
        array (
          'error' => 
          array (
            0 => 'Either your new password does not match or your new password is the same as your old one!',
          ),
        ),
        'status' => 'fail',
        'error_type' => 'generic_request_error',
    )));
}