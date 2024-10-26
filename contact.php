<?php
include_once('./shortcuts/header.php');
include_once "./config/dbconnect.php";
if (isset($_POST['submittttt'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  $query = "INSERT INTO `userquery`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
  $user_query_runn = mysqli_query($conn, $query);
  if ($user_query_runn) {
?>
    <script type="text/javascript">
      alert("Your Message was sent Sucessfully !");
    </script>
<?php
  } else {
    echo "please re enter ";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mishra - Gym</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!--- custom css link -->

  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .text-center {
      text-align: center;
    }

    .mb-5 {
      margin-bottom: 3rem;
    }

    .highlight {
      color: red
    }

    h4 {
      font-weight: bold;
      margin-bottom: 0.5rem;
      font-size: 3rem;
      color: black;
    }

    .contact-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 2rem;
    }

    .contact-item {
      flex: 1;
      text-align: center;
      margin-bottom: 1rem;
    }

    .contact-item i {
      color: red;
      margin-bottom: 1rem;
    }

    .contact-form-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .map,
    .form {
      flex: 1;
      min-width: 300px;
      margin-right: 1rem;
    }

    .map iframe {
      width: 100%;
      height: 100%;
      min-height: 400px;
    }

    .control-group {
      margin-bottom: 1rem;
    }

    .control-group input,
    .control-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn-submit {
      background-color: red;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-submit:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="page-header">
    <div class="page-header-content">
      <h4 class="page-title">Pricing</h4>
      <div class="breadcrumb">
        <p><a class="breadcrumb-link" href="index.php">Home</a></p>
        <p class="breadcrumb-separator">/</p>
        <p>Pricing</p>
      </div>
    </div>
  </div>



  <div class="container">
    <div class="text-center mb-5">
      <h4 class="highlight">Get In Touch</h4>
      <h4>Email Us For Any Query</h4>
    </div>
    <div class="contact-info">
      <div class="contact-item">
        <i class="fa fa-2x fa-map-marker-alt text-primary"></i>
        <h4>Address</h4>
        <p>123 Street, New York, USA</p>
      </div>
      <div class="contact-item">
        <i class="fa fa-2x fa-phone-alt text-primary"></i>
        <h4>Phone</h4>
        <p>+012 345 6789</p>
      </div>
      <div class="contact-item">
        <i class="far fa-2x fa-envelope text-primary"></i>
        <h4>Email</h4>
        <p>info@example.com</p>
      </div>
    </div>
    <div class="contact-form-container">
      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
      <div class="form">
        <form method="POST">
          <div class="control-group">
            <input type="text" name="name" placeholder="Your Name" required />
          </div>
          <div class="control-group">
            <input type="email" name="email" placeholder="Your Email" required />
          </div>
          <div class="control-group">
            <input type="text" name="subject" placeholder="Subject" required />
          </div>
          <div class="control-group">
            <textarea name="message" rows="6" placeholder="Message" required></textarea>
          </div>
          <div>
            <button class="btn-submit" type="submit" name="submittttt">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <i class="fas fa-arrow-up"></i>
  </a>

  <script src="./assets/js/script.js" defer></script>
  <?php include('./shortcuts/footer.php');  ?>
</body>

</html>