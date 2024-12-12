<?php
// Retrieve the environment variable
$mysqlUrl = getenv('MYSQL_URL');
echo "MYSQL_URL: " . $mysqlUrl;
// Parse the MySQL URL into components
$parsedUrl = parse_url($mysqlUrl);

// Extract connection details
$host = $parsedUrl['host'];
$username = $parsedUrl['user'];
$password = $parsedUrl['pass'];
$database = ltrim($parsedUrl['path'], '/');
$port = $parsedUrl['port'];

// Create a connection to MySQL
$conn = new mysqli($host, $username, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
