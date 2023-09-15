<?php
include "configuration.php";
if($isenabled){
$signeddatafromthegram = isset($_POST['signed_body']) ? $_POST['signed_body'] : null;

if(isset($_FILES['profile_pic'])){
    $response = array(
        'message' => "Currently profile pictures are not supported!",
        'status' => "fail",
        'error_type' => "error"
    );
    die(json_encode($response));
}
else{
if($signeddatafromthegram != null){
$sentjson = substr($signeddatafromthegram, 65);
$decodedjson = json_decode($sentjson, false);
$password = $decodedjson->password;
$fullname = $decodedjson->username;
$username = strtolower($decodedjson->username);
$email = $decodedjson->email;
$deviceID = $decodedjson->device_id;
}
else{
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$fullname = $username;
$username = strtolower($fullname);
$deviceID = isset($_POST['device_id']) ? $_POST['device_id'] : null;
}
//add 1 account per device check
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
$query = $getdbdata->prepare('SELECT ID, username, Password, uniquetoken, device_id, isaccountprivate, isverified FROM accounts WHERE username = ? LIMIT 1');
$query->bind_param('s', $username);
$query->execute();
$data = $query->get_result();
$query->close();
if($data->num_rows === 1){
    $response = array(
        'message' => "This username is already taken!",
        'status' => "fail",
        'error_type' => "error"
    );
    die(json_encode($response));
}
else{
    $token = rand(0, 2147483646);
    $isprivate = 0;
    $gethighestuserid = mysqli_query($getdbdata, 'SELECT MAX(ID) AS max FROM `accounts`;');
    $fetchstuff = mysqli_fetch_array($gethighestuserid);
    $biggestuseridindb = $fetchstuff['max']; //replace with mario's suggestion
    $ID = $biggestuseridindb + 1;
    $pfpURL = "/ign/icon.png";
    $hashedpassword = password_hash($token . $password . $token, PASSWORD_BCRYPT);
    $makeaccount = $getdbdata->prepare('INSERT INTO accounts (ID, username, Password, uniquetoken, device_id, isaccountprivate, isverified, followercount, followingcount, photocount, pfpURL, fullname) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $makeaccount->bind_param('ssssssssssss', $ID, $username, $hashedpassword, $token, $deviceID, $isprivate, $defaultverificationstatus, $defaultfollowercount, $defaultfollowingcount, $defaultphotocount, $pfpURL, $fullname);
    $makeaccount->execute();
    $makeaccount->close();
    $gethighestuserid->close();
    $response = array(
        'message' => "Your account has been created successfully! Just login and have fun!",
        'status' => "fail",
        'error_type' => "error"
    );
    die(json_encode($response));
}
}
}