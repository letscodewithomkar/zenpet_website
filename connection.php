<?php
// Fetch database credentials from environment variables
$servername = 'sql.freedb.tech';        // Hostname of the database
$username = 'freedb_zenpets_user';          // Database username
$password = 'g36EnEw%yHPK&Yk';          // Database password
$dbname = 'freedb_zenpetsdb';            // Database name
$port = '3306';              // Database port (e.g., 5432)

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
