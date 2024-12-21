<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = getenv('DB_HOST');        // Hostname of the database
$username = getenv('DB_USER');          // Database username
$password = getenv('DB_PASSWORD');          // Database password
$dbname = getenv('DB_NAME');            // Database name
$port = getenv('DB_PORT');       
echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_USER: " . getenv('DB_USER') . "<br>";
echo "DB_PASSWORD: " . getenv('DB_PASSWORD') . "<br>";
echo "DB_NAME: " . getenv('DB_NAME') . "<br>";
echo "DB_PORT: " . getenv('DB_PORT') . "<br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Connection successful
}
?>