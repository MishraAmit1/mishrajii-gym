<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the existing blog data to get image paths
  $query = "SELECT image, author_image FROM blogs WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  $blog = mysqli_fetch_assoc($result);

  // Delete the blog data from the database
  $query = "DELETE FROM blogs WHERE id='$id'";

  if (mysqli_query($conn, $query)) {
    // Remove the images from the upload directory
    unlink("../admin/upload/" . $blog['image']);
    unlink("../admin/upload/" . $blog['author_image']);
    echo "Blog deleted successfully.";
    header("Location: admin_home.php"); // Redirect to the blog list
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
