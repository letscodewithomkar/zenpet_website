<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if (isset($_SESSION['personname'])) {
    echo json_encode(['username' => $_SESSION['personname']]);
} else {
    echo json_encode(['username' => null]);
}
?>
