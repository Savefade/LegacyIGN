<?php
include "configuration.php";
if($isenabled == true){
$signeddatafromthegram = isset($_POST['signed_body']) ? $_POST['signed_body'] : null;
if(isset($_FILES['profile_pic'])){
    $response = array(
        'message' => "Currently profile pictures are not supported! Please restart the proccess!",
        'status' => "fail",
        'error_type' => "error"
    );
    echo(json_encode($response));
    exit;
}
else{
$sentjson = substr($signeddatafromthegram, 65);
$decodedjson = json_decode($sentjson, false);
$password = $decodedjson->password;
$username = strtolower($decodedjson->username);
$email = $decodedjson->email;
$deviceID = $decodedjson->device_id;
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
    echo(json_encode($response));
    exit;
}
else{
    $token = rand(0, 2147483646);
    $isprivate = 0;
    $gethighestuserid = mysqli_query($getdbdata, 'SELECT MAX(ID) AS max FROM `accounts`;');
    $fetchstuff = mysqli_fetch_array($gethighestuserid);
    $biggestuseridindb = $fetchstuff['max'];
    $ID = $biggestuseridindb + 1;
    $hashedpassword = password_hash($token . $password . $token, PASSWORD_BCRYPT);
    $makeaccount = $getdbdata->prepare('INSERT INTO accounts (ID, username, Password, uniquetoken, device_id, isaccountprivate, isverified) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $makeaccount->bind_param('sssssss', $ID, $username, $hashedpassword, $token, $deviceID, $isprivate, $defaultverificationstatus);
    $makeaccount->execute();
    $makeaccount->close();
    $gethighestuserid->close();
    $response = array(
        'message' => "Your account has been created successfully! Just login and have fun!",
        'status' => "fail",
        'error_type' => "error"
    );
    echo(json_encode($response));
    exit;
}
}
}