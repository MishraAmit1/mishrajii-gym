<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

// Get the user ID from the URL
$user_id = $_GET['id'];

// Fetch user details
$sql = "SELECT id, fullname, email, membership_status, gender, address, phone_number FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
  echo "No user found for ID: " . htmlspecialchars($user_id);
  exit();
}
?>

<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>All GYM Membership</h1>
      <ul class="breadcrumb">
        <li><a href="#">All GYM Membership</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>

  <div class="edit-user form-container" style="margin-top: 2rem;">
    <h2 class="form-title">Edit User</h2>
    <form action="update_user.php" method="POST" class="user-form">
      <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

      <label for="fullname" class="form-label">Full Name:</label>
      <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" class="form-input" required>

      <label for="email" class="form-label">Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-input" required>

      <label for="membership_status" class="form-label">Membership Status:</label>
      <input type="text" name="membership_status" value="<?= htmlspecialchars($user['membership_status']) ?>" class="form-input" readonly>

      <label for="gender" class="form-label">Gender:</label>
      <input type="text" name="gender" value="<?= htmlspecialchars($user['gender']) ?>" class="form-input" required>

      <label for="address" class="form-label">Address:</label>
      <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" class="form-input" required>

      <label for="phone_number" class="form-label">Phone Number:</label>
      <input type="text" name="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>" class="form-input" required>

      <button type="submit" class="form-button">Update User</button>
    </form>
  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>