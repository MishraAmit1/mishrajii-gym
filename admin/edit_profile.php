<?php
include_once "../config/dbconnect.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

// Fetch the admin user data based on the session 'admin_id'
$sql = "SELECT * FROM admin_users WHERE id = '" . $_SESSION['admin_id'] . "'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (isset($_POST['update_profile'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

  // Update the admin user profile information
  $update_sql = "UPDATE admin_users SET name='$name', email='$email', username='$username', password='$password' WHERE id='" . $_SESSION['admin_id'] . "'";

  if ($conn->query($update_sql) === TRUE) {
    echo "<script>alert('Profile updated successfully');</script>";
    header("Location: admin_profile.php");
    exit();
  } else {
    echo "Error updating profile: " . $conn->error;
  }
}
?>


<?php include './shortcuts/admin_header.php'; ?>

<main>
  <div class="edit-profile-container">
    <div class="head-title">
      <div class="left">
        <h1 style="color: black;">Edit Profile</h1>
        <ul class="breadcrumb">
          <li><a href="#">Edit Profile</a></li>
          <li><i class='fas fa-chevron-right'></i></li>
          <li><a class="active" href="admin_home.php">Home</a></li>
        </ul>
      </div>
    </div>

    <form action="" method="POST">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $user['name'] ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
      </div>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $user['username'] ?>" required>
      </div>
      <div class="form-group">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" name="update_profile" class="btn-save">Save Changes</button>
    </form>
  </div>
</main>

<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>