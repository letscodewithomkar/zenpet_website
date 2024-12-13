<?php
// Fetch database credentials from environment variables
$servername = getenv('DB_HOST');        // Hostname of the database
$username = getenv('DB_USER');          // Database username
$password = getenv('DB_PASSWORD');          // Database password
$dbname = getenv('DB_NAME');            // Database name
$port = getenv('DB_PORT');              // Database port (e.g., 5432)

// Create connection
echo $servername;
echo $username;
echo $password;
echo $dbname;
echo $port;
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " (Error code: " . $conn->connect_errno . ")");
} else {
    // Connection successful
}

?>
