<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];

  // Check if approve or reject action is triggered
  if (isset($_POST['action']) && $_POST['action'] == 'approve') {
    // Approve the membership
    $update_user_status = "UPDATE users SET membership_status='approved' WHERE id=?";
    $stmt_user = $conn->prepare($update_user_status);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();

    $update_membership_status = "UPDATE membership_applications SET status='approved' WHERE user_id=?";
    $stmt_membership = $conn->prepare($update_membership_status);
    $stmt_membership->bind_param("i", $user_id);
    $stmt_membership->execute();

    // Check if both updates were successful
    if ($stmt_user->affected_rows > 0 && $stmt_membership->affected_rows > 0) {
      echo "success";
    } else {
      echo "error";
    }
  } elseif (isset($_POST['action']) && $_POST['action'] == 'reject') {
    // Reject the membership
    $update_user_status = "UPDATE users SET membership_status='rejected' WHERE id=?";
    $stmt_user = $conn->prepare($update_user_status);
    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();

    $update_membership_status = "UPDATE membership_applications SET status='rejected' WHERE user_id=?";
    $stmt_membership = $conn->prepare($update_membership_status);
    $stmt_membership->bind_param("i", $user_id);
    $stmt_membership->execute();

    // Check if both updates were successful
    // Add debug response
    if ($stmt_user->affected_rows > 0 && $stmt_membership->affected_rows > 0) {
      echo "success";
    } else {
      echo "error: user: " . $stmt_user->affected_rows . " membership: " . $stmt_membership->affected_rows;
    }
  }

  $stmt_user->close();
  $stmt_membership->close();
  $conn->close();
}
