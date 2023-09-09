<?php
include "configuration.php";
if($isenabled == true){
$getdbdata = new mysqli($mysqlurl, $mysqlusername, $mysqlpassword, $mysqldbname);
if ($getdbdata->connect_errno) {
    $response = array(
        'message' => 'Failed to connect to MySQL: ' . $getdbdata->connect_error
    );
} else {

    $gethighestuserid = mysqli_query($getdbdata, 'SELECT MAX(ID) AS max FROM `posts`;');
    $fetchstuff = mysqli_fetch_array($gethighestuserid);
    $biggestpostid= $fetchstuff['max'];
    $postid = $biggestpostid + 1;
    $PhotoURl = "/ign/photos/". $postid . ".png";
    $posttimestamp = time();
    $description = "Currently descripions are not supported!";
    $views = 0;
    $isvideo = 0;
    $isuploadedbyprivateacc = 0;
    $username = "LegacyIGN";
    $AccountID = 1;
    runoriginaluploadscript($postid);
    $query = $getdbdata->prepare('INSERT INTO posts (ID, PhotoDIR, Likes, Comments, posttimestamp, description, views, isvideo, isuploadedbyprivateacc, username, AccountID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'); //11
    $query->bind_param("sssssssssss", $postid, $PhotoURl, $defaultLikes, $defaultcommentcount, $posttimestamp, $description, $views, $isvideo, $isuploadedbyprivateacc, $username, $AccountID);
    $query->execute();
    $response = array();
}
//header("instagram/json");
echo(json_encode($response));
}
function runoriginaluploadscript($postid2){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the required fields are present in the request
        if (!isset($_POST['device_timestamp']) || !isset($_FILES['photo'])) {
            die('Missing data.');
        }
    
        // Get the device_timestamp value
        $deviceTimestamp = $_POST['device_timestamp'];
    
        // Get the photo details
        $photoName = $_FILES['photo']['name'];
        $photoType = $_FILES['photo']['type'];
        $photoTmpPath = $_FILES['photo']['tmp_name'];
    
        // Validate and sanitize the device_timestamp value
        $deviceTimestamp = preg_replace('/[^0-9]/', '', $deviceTimestamp);
    
        // Generate a unique filename for the photo
        $extension = pathinfo($photoName, PATHINFO_EXTENSION);
        $filename = 'photos/' . $postid2 . '.' . 'png';
    
        // Move the uploaded photo to the desired location
        if (move_uploaded_file($photoTmpPath, $filename)) {
            echo 'Data saved successfully. ' . $postid2;
        } else {
            echo 'Error saving data.';
        }
    } else {
        echo 'Error saving data. Error: 2';
        exit;
    }
} //generated upload script with php (will be dicommisioned soon)