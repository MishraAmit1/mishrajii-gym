<?php
session_start();
include_once "./config/dbconnect.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch membership details
$membership_sql = "SELECT * FROM membership_applications WHERE user_id='$user_id'";
$membership_result = $conn->query($membership_sql);
$membership = $membership_result->fetch_assoc();

// Handle case where there is no membership record for the user
if ($membership) {
  $plan_name = ucfirst($membership['membership_plan']);
  $end_date = $membership['end_date']; // This will be used for the countdown timer
} else {
  $plan_name = 'No plan selected';
  $end_date = null; // No countdown timer if no membership exists
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Profile</title>
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

    .profile-container {
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

    p {
      margin: 10px 0;
      font-size: 18px;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #f39c12;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: #d35400;
    }

    .membership-status {
      margin-top: 20px;
      font-size: 20px;
      font-weight: bold;
    }

    .edit-profile-btn {
      display: block;
      margin-top: 20px;
      padding: 10px 15px;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .edit-profile-btn:hover {
      background-color: #2980b9;
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

    .timer {
      margin-top: 20px;
      font-size: 18px;
      font-weight: bold;
      color: #f39c12;
    }
  </style>
</head>

<body>
  <button class="close-btn" onclick="window.location.href='index.php';">×</button>
  <div class="profile-container">
    <h2>Your Profile</h2>
    <p>Name: <?= htmlspecialchars($user['fullname']) ?></p>
    <p>Username: <?= htmlspecialchars($user['username']) ?></p>
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <p>Gender: <?= htmlspecialchars($user['gender']) ?></p>
    <p>Address: <?= htmlspecialchars($user['address']) ?></p>
    <p>Phone Number: <?= htmlspecialchars($user['phone_number']) ?></p>

    <div class="membership-status">
      Membership Status: <?= ucfirst(htmlspecialchars($user['membership_status'])) ?>
    </div>

    <!-- Display the selected membership plan and real-time countdown -->
    <?php if ($user['membership_status'] == 'approved'): ?>
      <p>Selected Plan: <?= $plan_name ?></p>
      <?php if ($end_date): ?>
        <div id="timer" class="timer">Time Left: Calculating...</div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Show membership form if not approved -->
    <?php if ($user['membership_status'] == 'not_approved'): ?>
      <a href="membership_form.php">Apply for Membership</a>
    <?php elseif ($user['membership_status'] == 'pending'): ?>
      <p>Your membership application is pending approval.</p>
    <?php elseif ($user['membership_status'] == 'rejected'): ?>
      <p>Your membership has been rejected. Please contact the admin for more details.</p>
    <?php else: ?>
      <p>Your membership is approved!</p>
    <?php endif; ?>

    <!-- Edit Profile Button -->
    <a href="edit_profile.php" class="edit-profile-btn">Edit Profile</a>
  </div>

  <script>
    let membershipApproved = false; // Flag to ensure alert is shown only once

    function checkMembershipStatus() {
      // Make an AJAX request to check the membership status
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "./admin/check_membership_status.php?user_id=<?php echo $user_id; ?>", true);
      xhr.onload = function() {
        if (xhr.status == 200) {
          var response = xhr.responseText.trim();
          if (response === "approved" && !membershipApproved) {
            alert("Congratulations! Your membership has been approved.");
            document.querySelector('.membership-status').innerText = "Membership Status: Approved";
            clearInterval(statusInterval); // Stop polling after membership is approved
            membershipApproved = true; // Set the flag to true so the alert won't show again
          } else if (response === "rejected") {
            alert("Your membership has been rejected.");
            document.querySelector('.membership-status').innerText = "Membership Status: Rejected";
            clearInterval(statusInterval); // Stop polling after rejection
          }
        }
      };
      xhr.send();
    }

    // Poll the server every 5 seconds to check the membership status
    var statusInterval = setInterval(checkMembershipStatus, 5000);

    // Countdown Timer Logic
    function countdown(endDate) {
      let timerElement = document.getElementById('timer');
      let end = new Date(endDate).getTime();

      let x = setInterval(function() {
        let now = new Date().getTime();
        let distance = end - now;

        // Time calculations for days, hours, minutes, and seconds
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result
        timerElement.innerHTML = `Time Left: ${days}d ${hours}h ${minutes}m ${seconds}s`;

        // If the countdown is over
        if (distance < 0) {
          clearInterval(x);
          timerElement.innerHTML = "Your membership has expired.";
        }
      }, 1000);
    }

    // Start countdown if the end date exists
    <?php if (!empty($end_date)): ?>
      countdown("<?= $end_date ?>");
    <?php endif; ?>
  </script>
</body>

</html>