<?php
include "configuration.php";
if($isenabled){
$signeddatafromthegram = isset($_POST['signed_body']) ? $_POST['signed_body'] : null;
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
$query = $getdbdata->prepare('SELECT ID, username, Password, uniquetoken, device_id, sessionid, isaccountprivate, isverified FROM accounts WHERE username = ? LIMIT 1');
$query->bind_param('s', $username);
$query->execute();
$data = $query->get_result();
$query->close();
if($data->num_rows === 1){
    $response = array (
        'errors' => 
        array (
          'error' => 
          array (
            0 => 'This username is already taken!',
          ),
        ),
        'status' => 'ok',
        'error_type' => 'generic_request_error',
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
    $sessionid = "default";
    $hashedpassword = password_hash($token . $password . $token, PASSWORD_BCRYPT);
    $makeaccount = $getdbdata->prepare('INSERT INTO accounts (ID, username, Password, uniquetoken, device_id, sessionid, isaccountprivate, isverified, followercount, followingcount, photocount, pfpURL, fullname, biography, website) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "", "")'); //15
    $makeaccount->bind_param('sssssssssssss', $ID, $username, $hashedpassword, $token, $deviceID, $sessionid, $isprivate, $defaultverificationstatus, $defaultfollowercount, $defaultfollowingcount, $defaultphotocount, $pfpURL, $fullname); //13
    $makeaccount->execute();
    $makeaccount->close();
    $gethighestuserid->close();
    if(isset($_FILES['profile_pic'])){
      $uploadedphoto = $_FILES["profile_pic"]["tmp_name"];
      $nameofdafile = "pfps/" . $username . ".png";
      if(move_uploaded_file($uploadedphoto, $nameofdafile)){
      }else{die(json_encode(array('status' => 'fail',)));}
    }
    $response = array (
        'errors' => 
        array (
          'error' => 
          array (
            0 => 'Your account has been created successfully! Just login and have fun!',
          ),
        ),
        'status' => 'ok',
        'error_type' => 'generic_request_error',
    );
    die(json_encode($response));
}
}