<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>Mishra Jii</title>
  <!-- Before your closing </head> tag or at the start of your <body> -->
  <script>
    // Immediately check for dark mode preference and apply it
    if (localStorage.getItem("darkMode") === "enabled") {
      document.body.classList.add("dark-mode");
    }
  </script>


</head>

<body>
  <!-- JavaScript to handle dark mode toggle and other functionality -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const submenuToggles = document.querySelectorAll(".has-submenu > a");

      submenuToggles.forEach((toggle) => {
        toggle.addEventListener("click", function(e) {
          e.preventDefault();
          const parentLi = this.parentElement;

          if (parentLi.classList.contains("active")) {
            parentLi.classList.remove("active");
          } else {
            document
              .querySelectorAll(".side-menu .has-submenu.active")
              .forEach((activeLi) => {
                activeLi.classList.remove("active");
              });
            parentLi.classList.add("active");
          }
        });
      });

      // Handle dark mode toggle
      const switchMode = document.getElementById("switch-mode");

      // Apply the correct mode on page load based on local storage
      if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("dark-mode");
        switchMode.checked = true;
      } else {
        document.body.classList.remove("dark-mode");
        switchMode.checked = false;
      }

      // Listen for changes to the toggle
      switchMode.addEventListener("change", function() {
        if (switchMode.checked) {
          document.body.classList.add("dark-mode");
          localStorage.setItem("darkMode", "enabled");
        } else {
          document.body.classList.remove("dark-mode");
          localStorage.setItem("darkMode", "disabled");
        }
      });
    });
  </script>


  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="brand">
      <i class='fas fa-smile size-big'></i>
      <span class="text">GYM</span>
    </a>
    <ul class="side-menu top">
      <li class="active">
        <a href="./admin_home.php">
          <i class='fas fa-tachometer-alt size-small'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./admin_membership.php">
          <i class='fa fa-id-card size-small'></i>
          <span class="text">GYM Membership</span>
        </a>
      </li>
      <li>
        <a href="all_users.php">
          <i class="fa fa-users size-small"></i>
          <span class="text">All Users</span>
        </a>
      </li>
      <li>
        <a href="all_trainers.php">
          <i class="fa fa-dumbbell size-small"></i>
          <span class="text">Trainers</span>
        </a>
      </li>
      <li>
        <a href="basic_plan_display.php">
          <i class='fa fa-running size-small'></i>
          <span class="text">Basic Gym Plan</span>
        </a>
      </li>
      <li>
        <a href="premium_plan_display.php">
          <i class='fa fa-crown size-small'></i>
          <span class="text">Premium Gym Plan</span>
        </a>
      </li>
      <li>
        <a href="ultimate_plan_display.php">
          <i class='fa fa-bullseye size-small'></i>
          <span class="text">Ultimate Gym Plan</span>
        </a>
      </li>
      <li>
        <a href="classes.php">
          <i class="fas fa-th-list size-small" style="margin-left: 1rem;"></i>
          <span class="text">Classes</span>
        </a>
      </li>
      <li>
        <a href="blog.php">
          <i class="fas fa-blog size-small" style="margin-left: 1rem;"></i>
          <span class="text">Blog</span>
        </a>
      </li>
      <li>
        <a href="users_query.php">
          <i class="fas fa-comments size-small" style="margin-left: 1rem;"></i>
          <span class="text">Query</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <li>
        <a href="admin_profile.php">
          <i class='fas fa-user size-small'></i>
          <span class="text">Profile</span>
        </a>
      </li>
      <li>
        <a href="logout.php" class="logout">
          <i class='fas fa-sign-out-alt size-small '></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='fas fa-bars'></i>
      <div class="right-section">
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>

      </div>
    </nav>
    <!-- NAVBAR -->