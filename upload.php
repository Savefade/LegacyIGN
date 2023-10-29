<?php
include "configuration.php";
if($isenabled){
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
if ($getdbdata->connect_errno) {
    $response = array(
        'message' => 'Failed to connect to MySQL: ' . $getdbdata->connect_error
    );
    echo(json_encode($response));
} else {
    if(isset($_COOKIE["ds_user_id"]) || isset($_COOKIE["sessionid"])){
        $AccountID = $_COOKIE["ds_user_id"];
        $getusername = $getdbdata->prepare('SELECT ID, username, sessionid FROM accounts WHERE ID = ?;');
        $getusername->bind_param("s", $AccountID);
        $getusername->execute();
        $getusrresult = $getusername->get_result();
        $get = $getusrresult->fetch_assoc();
        $username = $get["username"];
        $sessionid = $get["sessionid"];
        if($_COOKIE["sessionid"] == $sessionid){
            $gethighestuserid = mysqli_query($getdbdata, 'SELECT MAX(ID) AS max FROM `posts`;');
            $fetchstuff = mysqli_fetch_array($gethighestuserid);
            $biggestpostid= $fetchstuff['max']; //replace with mario's suggestion
            $postid = $biggestpostid + 1;
            $PhotoURl = "/ign/photos/". $postid . ".png";
            $posttimestamp = time();
            $description = "Currently descriptions are not supported!";
            $views = 0;
            $isvideo = 0;
            $isuploadedbyprivateacc = 0;
    
            $getusername->close();
        }else{
            die(json_encode(array("message" => "Not allowed!", )));
        }
    } // fix the multi upload bug. How: use device timestamp then check if there is the same device timestamp if there is dont upload
    $originaluploadid = null;
    if(isset($_POST["device_timestamp"])){
        $originaluploadid = $_POST["device_timestamp"]; //placeholder
    }
    if($originaluploadid == null){
        $originaluploadid = $_POST["upload_id"];
    }
    $getusername = $getdbdata->prepare('SELECT ID FROM posts WHERE originaluploadid = ?;');
    $getusername->bind_param("s", $originaluploadid);
    $getusername->execute();
    $getusrresult = $getusername->get_result();
    $get = $getusrresult->fetch_assoc();
    if( $get != null){
        $postid = $get["ID"];
        runoriginaluploadscript($postid);  
    }
    else{
        $getusername = $getdbdata->prepare('SELECT MAX(photouserid) AS max FROM posts WHERE AccountID = ?;');
        $getusername->bind_param("s", $AccountID);
        $getusername->execute();
        $dbresult = $getusername->get_result();
        if($dbresult->num_rows === 1){
        $get = $dbresult->fetch_assoc();
        $photouserid = $get["max"] + 1;
        }else{
        $photouserid = 1;
        }
        $getusername = $getdbdata->prepare('UPDATE accounts SET photocount = ? WHERE ID = ? LIMIT 1');
        $getusername->bind_param("ss", $photouserid, $AccountID);
        $getusername->execute();
        $getusername->close();
        //seperate
        $query = $getdbdata->prepare('INSERT INTO posts (ID, PhotoDIR, Likes, Comments, posttimestamp, description, views, originaluploadid, isvideo, isuploadedbyprivateacc, username, AccountID, photouserid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'); //13
        $query->bind_param("sssssssssssss", $postid, $PhotoURl, $defaultLikes, $defaultcommentcount, $posttimestamp, $description, $views, $originaluploadid, $isvideo, $isuploadedbyprivateacc, $username, $AccountID, $photouserid);
        $query->execute();
        $getusername = $getdbdata->prepare('SELECT MAX(photouserid) AS max FROM posts WHERE AccountID = ?;');
        $getusername->bind_param("s", $AccountID);
        $getusername->execute();
        runoriginaluploadscript($postid);   
    }
}
}
function runoriginaluploadscript($postid2){
    $uploadedphoto = $_FILES["photo"]["tmp_name"];
    $nameofdafile = "photos/" . $postid2 . ".png";
    if(move_uploaded_file($uploadedphoto, $nameofdafile)){
    die(json_encode(array('status' => 'ok',)));
    }else{die(json_encode(array('status' => 'fail',)));}
}