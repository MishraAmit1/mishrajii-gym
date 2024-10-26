<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $membership_status = $_POST['membership_status'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $phone_number = $_POST['phone_number'];

  // Update user details
  $sql = "UPDATE users SET fullname='$fullname', email='$email', membership_status='$membership_status', gender='$gender', address='$address', phone_number='$phone_number' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "User updated successfully!";
  } else {
    $_SESSION['message'] = "Error: Could not update user.";
  }

  header("Location: admin_home.php");
  exit();
}
