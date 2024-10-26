<?php
session_start();
include_once "./config/dbconnect.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $phone_number = $_POST['phone_number'];
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];

  // Fetch current user data
  $sql = "SELECT * FROM users WHERE id='$user_id'";
  $result = $conn->query($sql);
  $user = $result->fetch_assoc();

  // Verify current password
  if (!empty($current_password) && password_verify($current_password, $user['password'])) {
    // Update password if new password is provided
    if (!empty($new_password)) {
      $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
      $update_password_sql = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
      $conn->query($update_password_sql);
    }
  } else {
    $error_message = "Current password is incorrect.";
  }

  // Update user details
  $update_sql = "UPDATE users SET fullname='$fullname', username='$username', email='$email', gender='$gender', address='$address', phone_number='$phone_number' WHERE id='$user_id'";
  $conn->query($update_sql);

  header("Location: profile.php");
  exit();
}

// Fetch current user data
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: url('./assets/images/bg.jpg') no-repeat center center/cover;
      color: #fff;
    }

    .edit-profile-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
      width: 350px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #f39c12;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
      background: #fff;
      color: #000;
    }

    button {
      background: #f39c12;
      color: #fff;
      font-weight: 600;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #d35400;
    }

    .error-message {
      color: #e74c3c;
      margin: 10px 0;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #e74c3c;
      border: none;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .close-btn:hover {
      background: #c0392b;
    }
  </style>
</head>

<body>
  <button class="close-btn" onclick="window.location.href='profile.php';">×</button>
  <div class="edit-profile-container">
    <h2>Edit Profile</h2>

    <?php if (isset($error_message)): ?>
      <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form action="edit_profile.php" method="post">
      <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required placeholder="Full Name">
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required placeholder="Username">
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required placeholder="Email">
      <select name="gender" required>
        <option value="male" <?= $user['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
        <option value="female" <?= $user['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
        <option value="other" <?= $user['gender'] === 'other' ? 'selected' : '' ?>>Other</option>
      </select>
      <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required placeholder="Address">
      <input type="text" name="phone_number" value="<?= htmlspecialchars($user['phone_number']) ?>" required placeholder="Phone Number">
      <input type="password" name="current_password" placeholder="Current Password">
      <input type="password" name="new_password" placeholder="New Password (leave empty to keep current)">
      <button type="submit">Update Profile</button>
    </form>
  </div>
</body>

</html>