<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$servername = getenv('DB_HOST');        // Hostname of the database
$username = getenv('DB_USER');          // Database username
$password = getenv('DB_PASSWORD');          // Database password
$dbname = getenv('DB_NAME');            // Database name
$port = getenv('DB_PORT');         

// Retrieve JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

// Ensure required fields exist in the data
if (!isset($data['username']) || !isset($data['cartlist'])) {
    echo json_encode(['error' => 'Invalid input data']);
    exit();
}

$currentUsername = $data['username'];
$cartlist = json_encode($data['cartlist']);  // Ensure cartlist is properly JSON encoded

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}
if ($cartlist === "[]") { // Check if cartlist is an empty array

    $deleteSql = "DELETE FROM cart WHERE username = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("s", $currentUsername);

    if ($deleteStmt->execute()) {
        echo json_encode(['message' => 'Cart deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete cart']);
    }
} else {
    $insertSql = "INSERT INTO cart (username, cartlist) 
                  VALUES (?, ?) 
                  ON DUPLICATE KEY UPDATE cartlist = VALUES(cartlist)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ss", $currentUsername, $cartlist);

    if ($insertStmt->execute()) {
        echo json_encode(['message' => 'Cart updated successfully']);
    } else {
        echo json_encode(['error' => 'Failed to update cart']);
    }
}


// Close statements and connection
$insertStmt->close();
$conn->close();
?>
