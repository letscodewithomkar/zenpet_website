<?php 
header("Access-Control-Allow-Origin: *"); // Allow CORS
header("Content-Type: application/json"); // JSON response

$servername = 'bbx920ljhqgdgakvhlzx-mysql.services.clever-cloud.com';        // Hostname of the database
$username = 'uq7bouzszt9dxdlv';          // Database username
$password = 'Mm9H2xWFdsfCAXeggVEa';          // Database password
$dbname = 'bbx920ljhqgdgakvhlzx';            // Database name
$port = '3306';     


// Retrieve and sanitize the username from GET request
$currentUsername = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);

if (!$currentUsername) {
    echo json_encode(['error' => 'Invalid or missing username']);
    exit;
}

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Prepare and execute SQL query
$sql = "SELECT cartlist FROM cart WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cartlist = json_decode($row['cartlist'], true); // Decode JSON from DB

    // Handle double-encoded JSON
    if (is_string($cartlist)) {
        $cartlist = json_decode($cartlist, true);
    }

    echo json_encode(['exists' => true, 'cartlist' => $cartlist]);
} else {
    echo json_encode(['exists' => false, 'cartlist' => []]); // Empty array if no data found
}

// Close connections
$stmt->close();
$conn->close();
?>
