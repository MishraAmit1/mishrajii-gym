<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
  $user_id = $_GET['id'];

  // First, delete from membership_applications
  $sql_delete_memberships = "DELETE FROM membership_applications WHERE user_id=$user_id";
  if ($conn->query($sql_delete_memberships) === TRUE) {

    // Then, delete from users
    $sql_delete_user = "DELETE FROM users WHERE id=$user_id";
    if ($conn->query($sql_delete_user) === TRUE) {
      $_SESSION['message'] = "User and associated records deleted successfully!";
    } else {
      $_SESSION['message'] = "Error deleting user: " . $conn->error;
    }
  } else {
    $_SESSION['message'] = "Error deleting associated memberships: " . $conn->error;
  }

  header("Location: admin_home.php");
  exit();
}
