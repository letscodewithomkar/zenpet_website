<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch database credentials from environment variables
$servername = 'bbx920ljhqgdgakvhlzx-mysql.services.clever-cloud.com';        // Hostname of the database
$username = 'uq7bouzszt9dxdlv';          // Database username
$password = 'Mm9H2xWFdsfCAXeggVEa';          // Database password
$dbname = 'bbx920ljhqgdgakvhlzx';            // Database name
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
