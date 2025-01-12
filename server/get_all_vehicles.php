<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Variable for GET parameter
$passkey = (isset($_GET['passkey'])) ? $_GET['passkey'] : false;
// Verify if required parameters are set
if(!$passkey){
    http_response_code(400);
    die(json_encode(['error' => "passkey GET parameter missing", 'internal_error_code' => '3']));
}
// Require config file
require_once("config/config.php");
// Authenticate client
if(auth_client($passkey)){
    // Prepare SQL statement
    $stmt = $database->prepare("SELECT * FROM vehicles");
    // And execute
    $stmt->execute();
    // Fetch data
    $result = $stmt->fetchAll();
    // Variable for later
    $vehicles = [];
    // Iterate results
    foreach($result as $vehicle){
        // Explode coords (lat,lng to [lat, lng])
        $pos = explode(",", $vehicle['position']);
        // Prepare JSON
        $vehicles[] = [
            "vehicle_id" => $vehicle['vehicle_id'],
            "latitude" => $pos[0],
            "longitude" => $pos[1],
            "last_update" => $vehicle['last_update']
        ];
    }
    // Almost there, send HTTP 200
    http_response_code(200);
    // Send encoded JSON
    echo json_encode($vehicles);
    // Terminate process
    exit();
} else {
    // Auth error
    http_response_code(403);
    die(json_encode(['error' => "Client passkey not authorized", 'internal_error_code' => '4']));
}
