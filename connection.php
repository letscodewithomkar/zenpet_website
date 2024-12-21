<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = getenv('DB_HOST');        // Hostname of the database
$username = getenv('DB_USER');          // Database username
$password = getenv('DB_PASSWORD');          // Database password
$dbname = getenv('DB_NAME');            // Database name
$port = getenv('DB_PORT');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Connection successful
}
?>