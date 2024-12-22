<?php
// Ensure no output before sending the JSON response
ob_start(); // Start output buffering to prevent extra output
 // Clear any previous output

// Set the header to indicate the response is in JSON format
//header('Content-Type: application/json');
error_reporting(0); // Suppress errors to keep the response clean
ini_set('display_errors', '0'); // Avoid displaying errors in the response

session_start();
include("connection.php"); // Include the database connection
$usersname = $_SESSION['personname']; // Get the username from the session
$data = json_decode(file_get_contents("php://input"), true); // Get the JSON input
// Process the incoming data (e.g., booking details)
$currentDate = date("Y-m-d"); // Get the current system date in YYYY-MM-DD format
$deleteQuery = "DELETE FROM bookings WHERE STR_TO_DATE(CONCAT(booking_date, YEAR(CURDATE())), '%d%b%Y') < CURDATE()";
$deleteStmt = $conn->prepare($deleteQuery);
$deleteStmt->execute();
// Database query to fetch already booked doctors
$query = "SELECT drname FROM bookings WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usersname);
$stmt->execute();
$result = $stmt->get_result();
$bookedDoctors = []; // Initialize an empty array for booked doctors
while ($row = $result->fetch_assoc()) {
    $bookedDoctors[] = $row['drname'];
}
// Output the booked doctors as a JSON response
ob_end_clean();
header('Content-Type: application/json');
echo json_encode($bookedDoctors);
?>