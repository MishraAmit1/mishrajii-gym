<?php
ob_start();
session_start();
?>
<header class="header" data-header>

  <div class="container">

    <a href="index.php" class="logo">
      <img src="./assets/images/logo-gym.png" alt="Gym Logo">
    </a>

    <nav class="navbar" data-navbar>

      <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
        <i class="fas fa-times-circle"></i>
      </button>

      <ul class="navbar-list">

        <li>
          <a href="index.php" class="navbar-link active" data-nav-link>Home</a>
        </li>

        <li>
          <a href="about.php" class="navbar-link" data-nav-link>About Us</a>
        </li>

        <li>
          <a href="classes.php" class="navbar-link" data-nav-link>Classes</a>
        </li>
        <li>
          <a href="princing.php" class="navbar-link" data-nav-link>Pricing</a>
        </li>
        <li>
          <a href="contact.php" class="navbar-link" data-nav-link>Contact Us</a>
        </li>

      </ul>

    </nav>


    <?php if (isset($_SESSION['username'])): ?>
      <a href="profile.php" class="btn btn-secondary">Profile</a>
      <a href="logout.php" class="btn btn-secondary">Logout</a>
    <?php else: ?>
      <a href="register.php" class="btn btn-secondary">Register</a>
    <?php endif; ?>
    <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
      <i class="fas fa-bars menu"></i>
    </button>
    <!-- <a href="register.php" class="btn btn-secondary">Register</a>
      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <i class="fas fa-bars menu"></i>
      </button> -->

  </div>
</header>