<?php
// ob_start();
// session_start();
include_once('./shortcuts/header.php');
include_once "./config/dbconnect.php";
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
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .pricing-text {
      max-width: 900px;
      margin: 0 auto;
    }

    .text-center {
      text-align: center;
    }

    .mb-5 {
      margin-bottom: 3rem;
    }

    .mt-3 {
      margin-top: 1.5rem;
    }

    .mt-5 {
      margin-top: 3rem;
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
      color: black;
    }

    p {
      font-size: 1rem;
      margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
      h1 {
        font-size: 2.5rem;
      }

      p {
        font-size: 1.25rem;
      }
    }



    h1.demo-title {
      text-align: center;
      font-size: 30px;
      font-weight: 600;
      color: black;
      letter-spacing: 2px;
    }

    h1.demo-title a {
      font-size: 16px;
      font-weight: 300;
    }

    .pricing-table {
      display: flex;
      flex-flow: row wrap;
      width: 100%;
      max-width: 1100px;
      margin: 0 auto;
      background: #ffff;
    }

    .pricing-table .ptable-item {
      width: 33.33%;
      padding: 0 15px;
      margin-bottom: 30px;
    }

    @media (max-width: 992px) {
      .pricing-table .ptable-item {
        width: 33.33%;
      }
    }

    @media (max-width: 768px) {
      .pricing-table .ptable-item {
        width: 50%;
      }
    }

    @media (max-width: 576px) {
      .pricing-table .ptable-item {
        width: 100%;
      }
    }

    .pricing-table .ptable-single {
      position: relative;
      width: 100%;
      overflow: hidden;
    }

    .pricing-table .ptable-header,
    .pricing-table .ptable-body,
    .pricing-table .ptable-footer {
      position: relative;
      width: 100%;
      text-align: center;
      overflow: hidden;
    }

    .pricing-table .ptable-status,
    .pricing-table .ptable-title,
    .pricing-table .ptable-price,
    .pricing-table .ptable-description,
    .pricing-table .ptable-action {
      position: relative;
      width: 100%;
      text-align: center;
    }

    .pricing-table .ptable-single {
      background: #f6f8fa
    }

    .pricing-table .ptable-single:hover {
      box-shadow: 0 0 10px #999999;
    }

    .pricing-table .ptable-header {
      margin: 0 30px;
      padding: 30px 0 45px 0;
      width: auto;
      background: black;
    }

    .pricing-table .ptable-header::before,
    .pricing-table .ptable-header::after {
      content: "";
      position: absolute;
      bottom: 0;
      width: 0;
      height: 0;
      border-bottom: 100px solid #f6f8fa;
    }

    .pricing-table .ptable-header::before {
      right: 50%;
      border-right: 250px solid transparent;
    }

    .pricing-table .ptable-header::after {
      left: 50%;
      border-left: 250px solid transparent;
    }

    .pricing-table .ptable-item.featured-item .ptable-header {
      background: red;
    }

    .pricing-table .ptable-status {
      margin-top: -30px;
    }

    .pricing-table .ptable-status span {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 30px;
      padding: 5px 0;
      text-align: center;
      color: #FF6F61;
      font-size: 14px;
      font-weight: 300;
      letter-spacing: 1px;
      background: #2A293E;
    }

    .pricing-table .ptable-status span::before,
    .pricing-table .ptable-status span::after {
      content: "";
      position: absolute;
      bottom: 0;
      width: 0;
      height: 0;
      border-bottom: 10px solid #FF6F61;
    }

    .pricing-table .ptable-status span::before {
      right: 50%;
      border-right: 25px solid transparent;
    }

    .pricing-table .ptable-status span::after {
      left: 50%;
      border-left: 25px solid transparent;
    }

    .pricing-table .ptable-title h2 {
      color: #ffffff;
      font-size: 24px;
      font-weight: 300;
      letter-spacing: 2px;
    }

    .pricing-table .ptable-price h2 {
      margin: 0;
      color: #ffffff;
      font-size: 45px;
      font-weight: 700;
      margin-left: 15px;
    }

    .pricing-table .ptable-price h2 small {
      position: absolute;
      font-size: 18px;
      font-weight: 300;
      margin-top: 16px;
      margin-left: -15px;
    }

    .pricing-table .ptable-price h2 span {
      margin-left: 3px;
      font-size: 16px;
      font-weight: 300;
    }

    .pricing-table .ptable-body {
      padding: 20px 0;
    }

    .pricing-table .ptable-description ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .pricing-table .ptable-description ul li {
      color: #2A293E;
      font-size: 14px;
      font-weight: 300;
      letter-spacing: 1px;
      padding: 7px;
      border-bottom: 1px solid #dedede;
    }

    .pricing-table .ptable-description ul li:last-child {
      border: none;
    }

    .pricing-table .ptable-footer {
      padding-bottom: 30px;
    }

    .pricing-table .ptable-action a {
      display: inline-block;
      padding: 10px 20px;
      color: #FF6F61;
      font-size: 14px;
      font-weight: 500;
      letter-spacing: 2px;
      text-decoration: none;
      background: #2A293E;
    }

    .pricing-table .ptable-action a:hover {
      color: #2A293E;
      background: #FF6F61;
    }

    .pricing-table .ptable-item.featured-item .ptable-action a {
      color: #2A293E;
      background: red;
    }

    .pricing-table .ptable-item.featured-item .ptable-action a:hover {
      color: red;
      background: black
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
  <section class="section">
    <div class="container">
      <header class="text-center mb-5 pricing-text">
        <h1>Experience Quality Fitness at a Fair Price: Our Transparent Pricing Model</h1>
        <p>Quality fitness shouldn't break the bank. Sweat FXBG offers affordable pricing and transparent services, including personalized training and group classes.</p>
        <p class="mt-3">Get ready to sweat, transform, and conquer your fitness goals with Sweat Membership. Unlock unlimited classes, round-the-clock access to our state-of-the-art facilities, and a supportive community that will keep you motivated every step of the way.</p>
        <p class="mt-5">Join us now and experience the power of Sweat. Elevate your workouts, challenge your limits, and achieve the results you've always desired. Don't wait, start your fitness journey today!</p>
      </header>
    </div>
  </section>


  <div class="container" style="margin-top: -10rem;">
    <h1 class="demo-title"><span style="color:red;">Pricing Table</span>
    </h1>
    <div class="pricing-table">
      <?php
      $sql = "SELECT * FROM `gym_basic_plan`";
      $run = mysqli_query($conn, $sql);
      while ($result = mysqli_fetch_array($run)) {
      ?>
        <div class="ptable-item">
          <div class="ptable-single">
            <div class="ptable-header">
              <div class="ptable-title">
                <h2>Basic</h2>
              </div>
              <div class="ptable-price">
                <h2><small>₹</small> <?php echo $result['price']; ?>
                  <span>/ M</span>
                </h2>
              </div>
            </div>
            <div class="ptable-body">
              <div class="ptable-description">
                <ul>
                  <li>ALL Basic things</li>
                  <li><?php echo $result['months']; ?></li>
                  <li><?php echo $result['selectservices']; ?></li>
                  <li>100% use of gym Equipment</li>
                </ul>
              </div>
            </div>
            <div class="ptable-footer">
              <div class="ptable-action">
                <a href="membership_form.php">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
      <?php  } ?>
      <?php
      $sql = "SELECT * FROM `gym_premium_plan`";
      $run = mysqli_query($conn, $sql);
      while ($result = mysqli_fetch_array($run)) {
      ?>
        <div class="ptable-item featured-item">
          <div class="ptable-single">
            <div class="ptable-header">
              <div class="ptable-status">
                <span>HOT</span>
              </div>
              <div class="ptable-title">
                <h2>Premium</h2>
              </div>
              <div class="ptable-price">
                <h2><small>₹</small><?php echo $result['price']; ?><span>/ M</span></h2>
              </div>
            </div>
            <div class="ptable-body">
              <div class="ptable-description">
                <ul>
                  <li>Basic + Premium</li>
                  <li><?php echo $result['months']; ?></li>
                  <li><?php echo $result['selectservices']; ?></li>
                  <li>Free Yoga Class</li>
                  <li>80% use of gym Equipment</li>
                </ul>
              </div>
            </div>
            <div class="ptable-footer">
              <div class="ptable-action">
                <a href="membership_form.php">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
      <?php  } ?>

      <?php
      $sql = "SELECT * FROM `gym_ultimate_plan`";
      $run = mysqli_query($conn, $sql);
      while ($result = mysqli_fetch_array($run)) {
      ?>
        <div class="ptable-item">
          <div class="ptable-single">
            <div class="ptable-header">
              <div class="ptable-title">
                <h2>Ultimate</h2>
              </div>
              <div class="ptable-price">
                <h2><small>₹</small><?php echo $result['price']; ?><span>/ M</span></h2>
              </div>
            </div>
            <div class="ptable-body">
              <div class="ptable-description">
                <ul>
                  <li>Basic + Premium + Ultimate</li>
                  <li><?php echo $result['months']; ?></li>
                  <li><?php echo $result['selectservices']; ?></li>
                  <li>Free Protein</li>
                  <li>100% use of gym Equipment</li>
                  <li>Lifetime Guidance</li>
                </ul>
              </div>
            </div>
            <div class="ptable-footer">
              <div class="ptable-action">
                <a href="membership_form.php">Buy Now</a>
              </div>
            </div>
          </div>
        </div>
      <?php  } ?>

    </div>


  </div>




  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <i class="fas fa-arrow-up"></i>
  </a>

  <script src="./assets/js/script.js" defer></script>
  <?php include('./shortcuts/footer.php');  ?>
</body>

</html>