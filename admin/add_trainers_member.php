<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_REQUEST['uploadimg']) && isset($_FILES['upload'])) {
  $name = $_REQUEST['name'];
  $role = $_REQUEST['role'];
  $twitter_link = $_REQUEST['twitter_link'];
  $facebook_link = $_REQUEST['facebook_link'];
  $linkedin_link = $_REQUEST['linkedin_link'];
  $instagram_link = $_REQUEST['instagram_link'];
  $img_name = $_FILES['upload']['name'];
  $tmp = $_FILES['upload']['tmp_name'];
  $folder = "upload/" . $img_name;

  // Using prepared statements to avoid SQL errors and SQL injection
  $stmt = $conn->prepare("INSERT INTO trainers (name, role, twitter_link, facebook_link, linkedin_link, instagram_link, image) VALUES (?, ?, ?, ?, ?, ?, ?)");

  // Bind the parameters to the SQL query
  $stmt->bind_param("sssssss", $name, $role, $twitter_link, $facebook_link, $linkedin_link, $instagram_link, $img_name);

  // Execute the statement
  if ($stmt->execute()) {
    // Check if the image was uploaded successfully
    if (move_uploaded_file($tmp, $folder)) {
      header("Location: all_trainers.php");
      exit();
    } else {
      echo "Failed to upload image.";
    }
  } else {
    echo "Failed to add trainer.";
  }

  // Close the statement
  $stmt->close();
}
?>

<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>Add New Trainer</h1>
      <ul class="breadcrumb">
        <li><a href="#">Add Trainer</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>
  <div class="form-container">
    <h2 class="form-title">Add Trainer</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="user-form">
      <label for="name" class="form-label">Full Name:</label>
      <input type="text" name="name" class="form-input" required>

      <label for="role" class="form-label">Role:</label>
      <input type="text" name="role" class="form-input" required>

      <label for="image" class="form-label">Image:</label>
      <input type="file" name="upload" class="form-input" required>

      <label for="twitter_link" class="form-label">Twitter Link:</label>
      <input type="url" name="twitter_link" class="form-input">

      <label for="facebook_link" class="form-label">Facebook Link:</label>
      <input type="url" name="facebook_link" class="form-input">

      <label for="linkedin_link" class="form-label">LinkedIn Link:</label>
      <input type="url" name="linkedin_link" class="form-input">

      <label for="instagram_link" class="form-label">Instagram Link:</label>
      <input type="url" name="instagram_link" class="form-input">

      <button type="submit" class="form-button" name="uploadimg">Add Trainer</button>
    </form>
  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>