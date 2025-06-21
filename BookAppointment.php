<?php
header('Content-Type: application/json');
ob_start(); // Start output buffering to prevent accidental output
error_reporting(0); // Suppress errors to keep the JSON response clean
ini_set('display_errors', '0'); // Avoid displaying errors in the response

session_start();
include("connection.php"); // Include the database connection

// Ensure the user is logged in
$userstatus= $_SESSION['status'];
if (isset($_SESSION['personname'])) {
    $userprofile = $_SESSION['personname'];
} else {
    $userprofile = null; // Handle default case
}


$data = json_decode(file_get_contents("php://input"), true); // Decode the JSON input

// Check if input data is valid
if (!$data || empty($data['doctorName']) || empty($data['date']) || empty($data['time'])) {
    echo json_encode(["success" => false, "message" => "Invalid or missing input data."]);
    exit();
}

// Extract input data
$doctorName = $data['doctorName'];
$bookedDate = $data['date'];
$bookedTime = $data['time'];


// Check if the user has already booked the same doctor
$query = "SELECT COUNT(*) AS count FROM bookings WHERE username = ? AND drname = ? AND booking_date = ? AND booking_time = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $userprofile, $doctorName, $bookedDate, $bookedTime);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    echo json_encode(["success" => false, "message" => "You have already booked this doctor for the selected date and time."]);
    exit();
}

// Insert the booking into the database
$sql = "INSERT INTO bookings (drname, username, booking_date, booking_time) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $doctorName, $userprofile, $bookedDate, $bookedTime);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Booking confirmed.",
        "data" => [
            "doctorName" => $doctorName,
            "date" => $bookedDate,
            "time" => $bookedTime
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Booking failed. Please try again later."]);
}

$conn->close();
exit();
?>
