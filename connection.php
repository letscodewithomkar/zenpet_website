<?php
$servername = "db"; // Service name of MySQL container
$username = "root";
$password = "omshubh123";
$dbname = "zenpetsdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
}
?>