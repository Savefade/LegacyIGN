<?php
include "configuration.php";
if($isenabled){
$signeddatafromthegram = isset($_POST['signed_body']) ? $_POST['signed_body'] : null;
if($signeddatafromthegram != null){
$sentjson = substr($signeddatafromthegram, 65); // 
$decodedjson = json_decode($sentjson, false);
$password = $decodedjson->password;
$username = $decodedjson->username;
$deviceID = $decodedjson->device_id;
}

if($signeddatafromthegram == null){
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
}
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
$query = $getdbdata->prepare('SELECT ID, username, Password, uniquetoken, device_id, isaccountprivate, isverified FROM accounts WHERE username = ? LIMIT 1');
$query->bind_param('s', $username);
$query->execute();
$data = $query->get_result();
$query->close();
if($data->num_rows === 1){

    //todo save the cookie to the db with a hash
    $fetchstuff = $data->fetch_assoc();
    $ID = $fetchstuff["ID"];
    $PasswordDB = $fetchstuff["Password"];
    $username = $fetchstuff["username"];
    $uniquetoken = $fetchstuff["uniquetoken"];
    $device_id = $fetchstuff["device_id"];
    $isverified = $fetchstuff["isverified"];
    $isaccountprivate = $fetchstuff["isaccountprivate"];
    $saltedpasswordlol = $uniquetoken . $password . $uniquetoken;
    $isprivate = false;
    $verified = false;
    if($isverified == 1){
        $verified = true;
    }
    if($isaccountprivate == 1){
        $isprivate = true;
    }
    if(password_verify($saltedpasswordlol, $PasswordDB)){
	$randomnumberforsessionid = rand();
	$Sessionid = sha1($randomnumberforsessionid);
    setcookie("sessionid", $Sessionid, time() + ($cookieexpiresin * 30), "/"); //setcookie
    $setcookie = $getdbdata->prepare('UPDATE accounts SET sessionid = ? WHERE username = ? LIMIT 1');
    $setcookie->bind_param('ss', $Sessionid, $username);
    $setcookie->execute();
    $setcookie->close();
    setcookie("ds_user_id", $ID, time() + ($cookieexpiresin * 30), "/"); //setcookie
        die(json_encode(array(
            'logged_in_user' => 
            array (
              'pk' => $ID,
              'username' => $username,
              'is_verified' => $verified, //to be added
              'profile_pic_id' => $ID,
              'profile_pic_url' => $baseurl . "/ign/icon.png" ,
              'is_private' => $isprivate,
              'pk_id' => $ID,
              'full_name' => $username,
              'account_badges' => //unknown
              array (
              ),
              'has_anonymous_profile_picture' => false,
              'is_supervision_features_enabled' => false,
              'all_media_count' => 0,
              'liked_clips_count' => 0,
              'fbid_v2' => $ID, //facebook bs
              'interop_messaging_user_fbid' => 0,
              'is_using_unified_inbox_for_direct' => false,
              'biz_user_inbox_state' => 0,
              'show_insights_terms' => false,
              'nametag' => //unknown
              array (
                'mode' => 0,
                'gradient' => '2',
                'emoji' => '😀', 
                'selfie_sticker' => '0',
              ),
              'allowed_commenter_type' => 'any',
              'has_placed_orders' => false,
              'reel_auto_archive' => 'on', //not needed
              'total_igtv_videos' => 0,
              'can_boost_post' => false,
              'can_see_organic_insights' => false,
              'wa_addressable' => false,
              'wa_eligibility' => 0,
              'is_business' => false, //to be added
              'professional_conversion_suggested_account_type' => 2,
              'account_type' => 1,
              'is_category_tappable' => false,
              'is_call_to_action_enabled' => NULL,
              'allow_contacts_sync' => false,
              'phone_number' => '', //to be added
            ),
            'session_flush_nonce' => NULL,
            'token' => 'null', //to ne added
            'auth_token' => 'null',
            'status' => 'ok',
        )));
    }
    else{
        die(json_encode(array(
            'message' => "Incorrect username or password!",
            'status' => "fail",
            'error_type' => 'generic_request_error',
        )));
    }

}
else{
    die(json_encode(array(
        'message' => "The username you entered does not belong to an account.",
        'status' => "fail",
        'error_type' => 'generic_request_error',
    )));
}
}