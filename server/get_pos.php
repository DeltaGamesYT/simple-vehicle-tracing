<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Set variables for GET parameters
$passkey = (isset($_GET['passkey'])) ? $_GET['passkey'] : false;
$vehicle = (isset($_GET['vehicle'])) ? $_GET['vehicle'] : false;

// Check if required parameters are set
if(!($passkey && $vehicle)){
    http_response_code(400);
    die(json_encode(['error' => 'GET parameters missing.', 'internal_error_code' => '3']));
}

// Require config file 
require_once('config/config.php');

// Authenticate client
if(auth_client($passkey)){
    // Get vehicle result from MySQL
    $stmt = $database->prepare("SELECT * FROM vehicles WHERE vehicle_id = :v");
    $stmt->execute(['v' => $vehicle]);
    $result = $stmt->fetchAll();
    if(count($result) != 1){
        // Vehicle not found
        die(json_encode(["error" => "Vehicle not found or repeated", "internal_error_code" => "2"]));
    }
    // Separate lat,lng as array
    $pos = explode(",", $result[0]['position']);
    // Create JSON
    $vehicle = [
        "latitude" => $pos[0],
        "longitude" => $pos[1],
        "last_update" => $result[0]['last_update']
    ];
    // Almost there
    http_response_code(200);
    // Encode JSON
    echo json_encode($vehicle);
} else {
    // Auth error
    http_response_code(403);
    die(json_encode(['error' => "Client passkey not authorized", 'internal_error_code' => '4']));
}