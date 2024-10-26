<?php
// register_process.php
include_once "./config/dbconnect.php";
$error_message = ""; // Initialize an error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize and validate input data
  $fullname = trim($_POST['fullname']);
  $username = trim($_POST['username']);
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $password = trim($_POST['password']);
  $gender = trim($_POST['gender']);
  $address = trim($_POST['address']);
  $phone_number = trim($_POST['phone_number']);

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = "Invalid email format";
  } elseif (!preg_match("/^[0-9]{10}$/", $phone_number)) {
    // Validate phone number (basic validation)
    $error_message = "Invalid phone number. It must be 10 digits.";
  } else {
    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $error_message = "Username or email already exists.";
    } else {
      // Hash the password for security
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      // Insert data into the database
      $sql = "INSERT INTO users (fullname, username, email, password, gender, address, phone_number) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sssssss", $fullname, $username, $email, $hashed_password, $gender, $address, $phone_number);

      if ($stmt->execute() === TRUE) {
        header("Location: login.php");
        exit();
      } else {
        $error_message = "Error: " . $stmt->error;
      }
    }
    $stmt->close();
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Register</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    .error-message {
      color: red;
      font-size: 14px;
      margin-bottom: 15px;
      text-align: center;
    }

    html {
      font-size: 80%;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 10px;
      background: linear-gradient(135deg, #ff4d4d, #000000);
    }

    .container {
      max-width: 700px;
      width: 100%;
      background-color: #fff;
      padding: 25px 30px;
      border-radius: 5px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .container .title {
      font-size: 25px;
      font-weight: 500;
      position: relative;
      margin-bottom: 10px;
    }

    .container .title::before {
      content: "";
      position: absolute;
      left: 0;
      bottom: -5px;
      height: 3px;
      width: 30px;
      border-radius: 5px;
      background: linear-gradient(135deg, #ff4d4d, #000000);
    }

    .content form .user-details {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin: 20px 0 12px 0;
    }

    form .user-details .input-box {
      margin-bottom: 15px;
      width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
      display: block;
      font-weight: 500;
      margin-bottom: 5px;
    }

    .user-details .input-box input,
    .user-details .input-box textarea,
    .user-details .input-box select {
      height: 45px;
      width: 100%;
      outline: none;
      font-size: 16px;
      border-radius: 5px;
      padding-left: 15px;
      border: 1px solid #ccc;
      border-bottom-width: 2px;
      transition: all 0.3s ease;
    }

    .user-details .input-box textarea {
      resize: none;
      height: auto;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid,
    .user-details .input-box textarea:focus,
    .user-details .input-box textarea:valid,
    .user-details .input-box select:focus,
    .user-details .input-box select:valid {
      border-color: #ff4d4d;
    }

    form .button {
      height: 45px;
      margin: 35px 0;
    }

    form .button input {
      height: 100%;
      width: 100%;
      border-radius: 5px;
      border: none;
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #ff4d4d, #000000);
    }

    form .button input:hover {
      background: linear-gradient(-135deg, #ff4d4d, #000000);
    }

    form .already-account {
      text-align: center;
      margin-top: 20px;
    }

    form .already-account a {
      color: #ff4d4d;
      text-decoration: none;
    }

    form .already-account a:hover {
      text-decoration: underline;
    }

    @media(max-width: 584px) {
      .container {
        max-width: 100%;
      }

      form .user-details .input-box {
        margin-bottom: 15px;
        width: 100%;
      }

      .user-details .input-box textarea {
        height: auto;
      }

      .content form .user-details {
        max-height: 300px;
        overflow-y: auto;
      }

      .user-details::-webkit-scrollbar {
        width: 5px;
      }
    }

    @media(max-width: 459px) {
      .container .content .user-details {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="title">Registration Form</div>
    <div class="content">
      <form action="register.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="fullname" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phone_number" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Gender</span>
            <select id="gender" name="gender" required>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <textarea type="text" name="address" placeholder="Enter your address" required rows="4"></textarea>
          </div>
        </div>
        <!-- Display error message here -->
        <?php if (!empty($error_message)) : ?>
          <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="already-account">
          <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>
</body>

</html>