<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM userquery WHERE id='$id'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    header("Location: users_query.php");
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
}
