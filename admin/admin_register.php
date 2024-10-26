<?php
include_once "../config/dbconnect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];

  $sql = "INSERT INTO admin_users (name, email, username, password, gender, dob) 
            VALUES ('$name', '$email', '$username', '$password', '$gender', '$dob')";

  if ($conn->query($sql) === TRUE) {
    header("Location: admin_login.php?status=registered");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Registration</title>
</head>

<body>
  <h2>Admin Registration</h2>
  <form action="admin_register.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <label>Gender:</label><br>
    <select name="gender" required>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select><br><br>

    <label>Date of Birth:</label><br>
    <input type="date" name="dob" required><br><br>

    <button type="submit">Register</button>
  </form>
</body>

</html>