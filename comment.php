<?php
include 'config.php';

$name = $_POST['name'];
$message = $_POST['message'];
$place_id = isset($_POST['place_id']) ? (int)$_POST['place_id'] : 0;

if (!empty($name) && !empty($message) && $place_id > 0) {
  $stmt = $conn->prepare("INSERT INTO comments (name, message, place_id) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $name, $message, $place_id);
  $stmt->execute();
  $stmt->close();
}

$conn->close();
header("Location: place.php?id=" . $place_id);
exit();
?>

