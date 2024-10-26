<?php
include_once "../config/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $twitter_link = $_POST['twitter_link'];
  $facebook_link = $_POST['facebook_link'];
  $linkedin_link = $_POST['linkedin_link'];
  $instagram_link = $_POST['instagram_link'];

  // Handling the image upload
  $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  // Insert into the database
  $sql = "INSERT INTO trainers (name, role, image, twitter_link, facebook_link, linkedin_link, instagram_link) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssss", $name, $role, $imgContent, $twitter_link, $facebook_link, $linkedin_link, $instagram_link);

  if ($stmt->execute()) {
    echo "Trainer added successfully.";
    header("Location: all_trainers.php");
  } else {
    echo "Error: " . $stmt->error;
  }
}
