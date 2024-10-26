<?php
// Enable error reporting to catch any errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "./config/dbconnect.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Check if the user is logged in
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
  }

  // Retrieve user session and form data
  $user_id = $_SESSION['user_id'];
  $membership_plan = isset($_POST['membership_plan']) ? $_POST['membership_plan'] : '';
  $emergency_contact_phone = isset($_POST['emergency_contact_phone']) ? $_POST['emergency_contact_phone'] : '';

  // Check if the user has already submitted a membership application
  $check_application_sql = "SELECT * FROM membership_applications WHERE user_id = '$user_id'";
  $check_result = mysqli_query($conn, $check_application_sql);

  if ($check_result && mysqli_num_rows($check_result) > 0) {
    die("You have already submitted a membership application.");
  }

  // Set the current date as the start date
  $start_date = date('Y-m-d');

  // Initialize variables for table name and plan duration
  $table_name = '';
  $plan_duration = '';

  // Choose the correct table based on the membership plan
  switch ($membership_plan) {
    case 'basic':
      $table_name = 'gym_basic_plan';
      break;
    case 'ultimate':
      $table_name = 'gym_ultimate_plan';
      break;
    case 'premium':
      $table_name = 'gym_premium_plan';
      break;
    default:
      die("Invalid plan selected.");
  }

  // Fetch the membership plan duration from the corresponding table
  $sql = "SELECT months FROM $table_name WHERE id = 1"; // Assuming ID = 1 for the plan
  $query_run = mysqli_query($conn, $sql);

  if (!$query_run) {
    die("Error fetching plan details for the selected plan: " . mysqli_error($conn));
  }

  if ($query_run) {
    $plan_row = mysqli_fetch_assoc($query_run);
    $plan_duration = isset($plan_row['months']) ? $plan_row['months'] : '';
  } else {
    die("Error fetching plan duration: " . mysqli_error($conn));
  }

  // Calculate the end date based on the plan duration
  if (!empty($plan_duration)) {
    $months = intval(filter_var($plan_duration, FILTER_SANITIZE_NUMBER_INT));
    $end_date = date('Y-m-d', strtotime("+$months months", strtotime($start_date)));

    // Insert membership details into the database
    $sql_insert = "INSERT INTO membership_applications (user_id, membership_plan, start_date, end_date, emergency_contact_phone) 
                    VALUES ('$user_id', '$membership_plan', '$start_date', '$end_date', '$emergency_contact_phone')";

    if ($conn->query($sql_insert) === TRUE) {

      // Update membership status
      $update_status = "UPDATE users SET membership_status='pending' WHERE id='$user_id'";

      if ($conn->query($update_status) === TRUE) {
        // Redirect to profile page
        header("Location: profile.php?status=membership_applied");
        exit();
      } else {
        echo "Error updating membership status: " . $conn->error;
      }
    } else {
      echo "Error inserting membership application: " . $conn->error;
    }
  } else {
    die("Plan duration is not set.");
  }

  $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply for Membership</title>
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
      background: url('./assets/images/gym-background.jpg') no-repeat center center/cover;
      color: #fff;
    }

    .form-container {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
      width: 350px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      text-align: center;
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

    select,
    input[type="text"] {
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
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Membership Application Form</h2>
    <form action="membership_form.php" method="POST">
      <label for="membership_plan">Membership Plan:</label>
      <select id="membership_plan" name="membership_plan" required>
        <option value="basic">Basic</option>
        <option value="ultimate">Ultimate</option>
        <option value="premium">Premium</option>
      </select>

      <label for="workout_time">Preferred Workout Time:</label>
      <select id="workout_time" name="workout_time" required>
        <option value="Morning">Morning</option>
        <option value="Afternoon">Afternoon</option>
        <option value="Evening">Evening</option>
      </select>

      <label for="emergency_contact_phone">Emergency Contact Phone Number:</label>
      <input type="text" id="emergency_contact_phone" name="emergency_contact_phone" required>

      <button type="submit">Apply for Membership</button>
    </form>
  </div>
</body>

</html>