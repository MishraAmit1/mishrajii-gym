<?php
include_once "../config/dbconnect.php";
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "error";
  exit();
}
if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];

  // Fetch the membership status from the database
  $query = "SELECT membership_status FROM users WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $stmt->bind_result($membership_status);
  $stmt->fetch();

  // Return the membership status (either "pending" or "approved")
  echo $membership_status;

  $stmt->close();
}
$conn->close();
