<?php
include "configuration.php";
$response = array(
        'items' => array(),
        'num_items' => 1,
		'more_available' => false,
        'status' => "ok"
    );
    die(json_encode($response));