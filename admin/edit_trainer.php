<?php
include_once "../config/dbconnect.php";
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

// Fetch the trainer's data based on the ID
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM trainers WHERE id='$id'";
  $query_run = mysqli_query($conn, $query);
  $trainer = mysqli_fetch_assoc($query_run);
}

// Update the trainer's information
if (isset($_POST['update_trainer'])) {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $twitter_link = $_POST['twitter_link'];
  $facebook_link = $_POST['facebook_link'];
  $linkedin_link = $_POST['linkedin_link'];
  $instagram_link = $_POST['instagram_link'];

  if ($_FILES['upload']['name']) {
    $img_name = $_FILES['upload']['name'];
    $tmp = $_FILES['upload']['tmp_name'];
    $folder = "upload/" . $img_name;
    move_uploaded_file($tmp, $folder);
  } else {
    $img_name = $trainer['image'];
  }

  $update_query = "UPDATE trainers SET name='$name', role='$role', twitter_link='$twitter_link', facebook_link='$facebook_link', linkedin_link='$linkedin_link', instagram_link='$instagram_link', image='$img_name' WHERE id='$id'";

  if (mysqli_query($conn, $update_query)) {
    header("Location: all_trainers.php");
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>

<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>Edit Trainer</h1>
      <ul class="breadcrumb">
        <li><a href="#">Edit Trainer</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>
  <div class="form-container " style="margin-top: 2rem;">
    <h2 class="form-title">Edit Trainer</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="user-form">
      <label for="name" class="form-label">Full Name:</label>
      <input type="text" name="name" class="form-input" value="<?= $trainer['name'] ?>" required>

      <label for="role" class="form-label">Role:</label>
      <input type="text" name="role" class="form-input" value="<?= $trainer['role'] ?>" required>

      <label for="image" class="form-label">Image:</label>
      <input type="file" name="upload" class="form-input">
      <img src="upload/<?= $trainer['image'] ?>" width="100px" height="100px">

      <label for="twitter_link" class="form-label">Twitter Link:</label>
      <input type="url" name="twitter_link" class="form-input" value="<?= $trainer['twitter_link'] ?>">

      <label for="facebook_link" class="form-label">Facebook Link:</label>
      <input type="url" name="facebook_link" class="form-input" value="<?= $trainer['facebook_link'] ?>">

      <label for="linkedin_link" class="form-label">LinkedIn Link:</label>
      <input type="url" name="linkedin_link" class="form-input" value="<?= $trainer['linkedin_link'] ?>">

      <label for="instagram_link" class="form-label">Instagram Link:</label>
      <input type="url" name="instagram_link" class="form-input" value="<?= $trainer['instagram_link'] ?>">

      <button type="submit" class="form-button" name="update_trainer">Update Trainer</button>
    </form>
  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>