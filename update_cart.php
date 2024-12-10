<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$servername = "db";
$username = "root";
$password = "omshubh123";
$dbname = "zenpetsdb";

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

// Check if the user already has an entry in the cart
$checkSql = "SELECT * FROM cart WHERE username = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $currentUsername);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

// If an entry exists, delete the previous entry
if ($checkResult->num_rows > 0) {
    $deleteSql = "DELETE FROM cart WHERE username = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("s", $currentUsername);
    $deleteStmt->execute();
    $deleteStmt->close();
}

// Insert the new cartlist for the user
$insertSql = "INSERT INTO cart (username, cartlist) VALUES (?, ?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("ss", $currentUsername, $cartlist);

if ($insertStmt->execute()) {
    echo json_encode(['message' => 'Cart updated successfully']);
} else {
    echo json_encode(['error' => 'Failed to update cart']);
}

// Close statements and connection
$insertStmt->close();
$checkStmt->close();
$conn->close();
?>
