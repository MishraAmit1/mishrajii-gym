<?php
include_once "../config/dbconnect.php";
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM trainers WHERE id='$id'";

  if (mysqli_query($conn, $query)) {
    header("Location: all_trainers.php");
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}
