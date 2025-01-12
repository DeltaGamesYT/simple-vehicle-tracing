<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Set variables for GET parameters
$position = (isset($_GET['position'])) ? $_GET['position'] : false;
$vehicle_id = (isset($_GET['vehicle_id'])) ? $_GET['vehicle_id'] : false;
$passkey = (isset($_GET['passkey'])) ? $_GET['passkey'] : false;

// Check if required parameters are set
if(!($position && $vehicle_id && $passkey)){
    http_response_code(400);
    die(json_encode(['error' => 'GET parameters missing.', 'internal_error_code' => '3']));
}

// Require config file
require_once("config/config.php");

// Authenticate vehicle
if(auth_vehicle($vehicle_id, $passkey)){
    // Update position in database
    $stmt = $database->prepare("UPDATE vehicles SET position = :p, last_update = :t WHERE vehicle_id = :v");
    $stmt->execute(['p' => $position, 't' => time(), 'v' => $vehicle_id]);
    // Success
    http_response_code(200);
    die(json_encode(["status" => "success"]));
} else {
    // Auth error
    http_response_code(403);
    die(json_encode(['error' => "Vehicle ID or passkey not authorized", 'internal_error_code' => '4']));
}