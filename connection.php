<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch database credentials from environment variables
$servername = ' sql12.freemysqlhosting.net';        // Hostname of the database
$username = 'sql12751872';          // Database username
$password = 'gIUpPytbyP';          // Database password
$dbname = 'sql12751872';            // Database name
$port = '3306';              // Database port (e.g., 5432)

// Create connection
echo $servername;
echo $username;
echo $password;
echo $dbname;
echo $port;
$conn = new mysqli($servername, $username, $password, $dbname, $port);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . " (Error code: " . $conn->connect_errno . ")");
} else {
    // Connection successful
};
?>
