<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

if (isset($_GET['id'])) {
  $class_id = $_GET['id'];

  // Fetch the current class details
  $sql = "SELECT * FROM classes WHERE id = $class_id";
  $result = $conn->query($sql);
  $class = $result->fetch_assoc();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if "No Classes Today" is selected
    $no_class = isset($_POST['no_class']) ? 'No Classes Today' : '';

    // If "No Classes Today" is checked, clear the class and trainer names
    if ($no_class) {
      $class_name = $no_class;
      $trainer_name = '';
    } else {
      // Otherwise, update class name and trainer name normally
      $class_name = $_POST['class_name'];
      $trainer_name = $_POST['trainer_name'];
    }

    // Update query without time and day
    $update_query = "UPDATE classes SET class_name='$class_name', trainer_name='$trainer_name' WHERE id=$class_id";

    if ($conn->query($update_query) === TRUE) {
      header("Location: classes.php"); // Redirect after update
      exit();
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }
} else {
  // Redirect if no ID is provided
  header("Location: classes.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Class</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    h2 {
      color: #333;
      text-align: center;
    }

    .form-container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #218838;
    }

    .checkbox-label {
      display: flex;
      align-items: center;
      /* Center the checkbox vertically */
      margin-top: 10px;
    }

    .checkbox-label input[type="checkbox"] {
      width: 20px;
      /* Increase checkbox size */
      height: 20px;
      /* Increase checkbox size */
      margin-right: 10px;
      /* Space between checkbox and label text */
    }
  </style>
</head>

<body>

  <?php include './shortcuts/admin_header.php'; ?>
  <div class="form-container" style="margin-top: 5rem;">
    <h2>Edit Class</h2>
    <form method="POST" action="">
      <label for="class_name">Class Name:</label>
      <input type="text" name="class_name" value="<?php echo $class['class_name'] != 'No Classes Today' ? $class['class_name'] : ''; ?>" required>

      <label for="trainer_name">Trainer Name:</label>
      <input type="text" name="trainer_name" value="<?php echo $class['trainer_name']; ?>" required>

      <!-- Option for No Class -->
      <label class="checkbox-label">
        <input type="checkbox" name="no_class" value="1" <?php if ($class['class_name'] == 'No Classes Today') echo 'checked'; ?>>
        No Classes Today
      </label>

      <input type="submit" value="Update Class">
    </form>
  </div>
  <script src="./js/script.js"></script>

</body>

</html>