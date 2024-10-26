<?php
include_once "../config/dbconnect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT id, password FROM admin_users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['admin_id'] = $row['id'];
      header("Location: admin_home.php");
      exit();
    } else {
      $error_message = "Invalid password.";
    }
  } else {
    $error_message = "No user found with this username.";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
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
      background: url('../assets//images/bg.jpg') no-repeat center center/cover;
      color: #fff;
    }

    .login-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
      width: 300px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    h2 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #f39c12;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-size: 18px;
    }

    input[type="text"],
    input[type="password"] {
      width: calc(100% - 22px);
      padding: 10px;
      margin-bottom: 15px;
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
      font-size: 16px;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Admin Login</h2>

    <?php if (isset($error_message)): ?>
      <div class="error-message">
        <?= htmlspecialchars($error_message); ?>
      </div>
    <?php endif; ?>

    <form action="admin_login.php" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </div>
</body>

</html>