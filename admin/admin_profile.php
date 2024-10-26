<?php
include_once "../config/dbconnect.php";
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

$sql = "SELECT * FROM admin_users";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<?php
include './shortcuts/admin_header.php'
?>
<main>
  <div class="profile-container">
    <div class="head-title">
      <div class="left">
        <h1 style="color: black;">Admin Profile</h1>
        <ul class="breadcrumb">
          <li><a href="#">Admin Profile</a></li>
          <li><i class='fas fa-chevron-right'></i></li>
          <li><a class="active" href="admin_home.php">Home</a></li>
        </ul>
      </div>
    </div>

    <div class="profile-details">
      <div class="profile-item">
        <strong>Name:</strong> <span><?= $user['name'] ?></span>
      </div>
      <div class="profile-item">
        <strong>Email:</strong> <span><?= $user['email'] ?></span>
      </div>
      <div class="profile-item">
        <strong>Username:</strong> <span><?= $user['username'] ?></span>
      </div>
      <div class="profile-item">
        <strong>Password:</strong> <span><?= $user['password'] ?></span>
      </div>
      <div class="profile-item">
        <strong>Gender:</strong> <span><?= $user['gender'] ?></span>
      </div>
      <div class="profile-item">
        <strong>Date of Birth:</strong> <span><?= $user['dob'] ?></span>
      </div>

      <!-- Edit Button -->
      <div class="profile-item">
        <a href="edit_profile.php" class="btn-edit">Edit Profile</a>
      </div>
    </div>
  </div>
</main>

<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>