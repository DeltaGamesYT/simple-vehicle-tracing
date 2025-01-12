<?php

// MySQL database credentials
$mysql_hostname = "";
$mysql_username = "";
$mysql_password = "";
$mysql_database = "vehicles";

// Show error info in MySQL connection
$show_error_info = true;

// Try-Catch block to handle errors
try {
    // Try connect with MySQL using PDO
    $database = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database;charset=utf8", $mysql_username, $mysql_password);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e){
    // Error
    die("There's an error:\n&nbsp;&nbsp;Internal error code: 1 (see info about internal error codes at github.com/deltagamesyt/simple-vehicle-tracing/wiki)\n&nbsp;&nbsp;Can't connect to database. Check your database settings at /config/config.php\n&nbsp;&nbsp;" . ($show_error_info) ? $e : null);
}

// Function to authenticate vehicle IDs
function auth_vehicle($v, $p){
    global $database;
    $stmt = $database->prepare("SELECT * FROM vehicles WHERE vehicle_id = :v AND passkey = :p");
    $stmt->execute(['v' => $v, 'p' => $p]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($result) > 0;
}

// Function to authenticate client IDs
function auth_client($p){
    global $database;
    $stmt = $database->prepare("SELECT * FROM clients WHERE passkey = :p");
    $stmt->execute(['p' => $p]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return count($result) > 0;
}
