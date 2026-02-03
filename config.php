<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "travel_db";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
  die("Kết nối thất bại: " . $conn->connect_error);
}
?>
