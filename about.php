<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mishra - Gym</title>
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!--- custom css link -->
  <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
</head>

<body>
  <?php include('./shortcuts/header.php');  ?>
  <div class="page-header">
    <div class="page-header-content">
      <h4 class="page-title">About Us</h4>
      <div class="breadcrumb">
        <p><a class="breadcrumb-link" href="index.php">Home</a></p>
        <p class="breadcrumb-separator">/</p>
        <p>About Us</p>
      </div>
    </div>
  </div>




  <section class="section about" id="about" aria-label="about">
    <div class="container">

      <div class="about-banner has-after">
        <img src="./assets/images/about-banner.png" width="660" height="648" loading="lazy" alt="about banner"
          class="w-100">

        <img src="./assets/images/about-circle-one.png" width="660" height="534" loading="lazy" aria-hidden="true"
          alt="" class="circle circle-1">
        <img src="./assets/images/about-circle-two.png" width="660" height="534" loading="lazy" aria-hidden="true"
          alt="" class="circle circle-2">

        <img src="./assets/images/fitness.png" width="650" height="154" loading="lazy" alt="fitness"
          class="abs-img w-100">
      </div>

      <div class="about-content">

        <p class="section-subtitle">About Us</p>

        <h2 class="h2 section-title">Welcome To Our Mishra Jii Gym</h2>

        <p class="section-text">
          Nam ut hendrerit leo. Aenean vel ipsum nunc. Curabitur in tellus vitae nisi aliquet dapibus non et erat.
          Pellentesque
          porta sapien non accumsan dignissim curabitur sagittis nulla sit amet dolor feugiat.
        </p>

        <p class="section-text">
          Integer placerat vitae metus posuere tincidunt. Nullam suscipit ante ac aliquet viverra vestibulum ante
          ipsum primis.
        </p>

        <div class="wrapper">

          <div class="about-coach">
            <div class="coach-icons">
              <div class="icon-item">
                <i class="fas fa-dumbbell"></i>
                <p>Certified GYM Center</p>
              </div>
              <div class="icon-item">
                <i class="fas fa-trophy"></i>
                <p>Award Winning</p>
              </div>
              <div class="icon-item">
                <i class="fas fa-heartbeat"></i>
                <p>Health Focused</p>
              </div>
              <div class="icon-item">
                <i class="fas fa-users"></i>
                <p>Professional Trainers</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>


  <section class="section video" aria-label="video" style="margin-bottom: 3rem;">
    <div class="container">

      <div class="video-card has-before has-bg-image"
        style="background-image: url('./assets/images/video-banner.jpg')">

        <h2 class="h2 card-title">Explore Fitness Life</h2>

        <button class="play-btn" aria-label="play video">
          <i class="fas fa-play"></i>
        </button>

        <a href="#" class="btn-link has-before">Watch More</a>

      </div>

    </div>
  </section>

  <div class="team-section">
    <div class="team-header">
      <h4 class="team-subtitle">Our Trainers</h4>
      <h4 class="team-title">Meet Our Expert Trainers</h4>
    </div>
    <?php
    include_once "./config/dbconnect.php";
    ?>

    <div class="team-grid">
      <?php
      $sql = "SELECT * FROM trainers";
      $run = mysqli_query($conn, $sql);

      if ($run->num_rows > 0) {
        while ($result = mysqli_fetch_array($run)) {
      ?>
          <div class="team-member">
            <div class="card">
              <img class="card-img" src="admin/upload/<?php echo $result['image'];  ?>" alt="not found">
              <div class="card-social">
                <a class="social-btn" href="<?php echo $result['twitter_link'] ?>"><i class="fab fa-twitter"></i></a>
                <a class="social-btn" href="<?php echo $result['facebook_link'] ?>"><i class="fab fa-facebook-f"></i></a>
                <a class="social-btn" href="<?php echo $result['linkedin_link'] ?>"><i class="fab fa-linkedin-in"></i></a>
                <a class="social-btn" href="<?php echo $result['instagram_link'] ?>"><i class="fab fa-instagram"></i></a>
              </div>
              <div class="card-bodyy">
                <h4 class="card-titles"><?php echo $result['name'];  ?></h4>
                <p class="card-text"><?php echo $result['role'];  ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "No trainers found.";
      }
      ?>
    </div>


  </div>




  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <i class="fas fa-arrow-up"></i>
  </a>

  <script src="./assets/js/script.js" defer></script>
  <?php include('./shortcuts/footer.php');  ?>
</body>

</html>