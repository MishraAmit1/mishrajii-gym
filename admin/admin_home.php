<?php
include_once "../config/dbconnect.php";
include './shortcuts/admin_header.php';
?>

<!-- MAIN -->
<main>
  <div class="head-title">
    <div class="left">
      <h1>Dashboard</h1>
      <ul class="breadcrumb">
        <li>
          <a href="#">Dashboard</a>
        </li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li>
          <a class="active" href="#">Home</a>
        </li>
      </ul>
    </div>

  </div>
  <ul class="box-info">
    <li>
      <i class="fa fa-users size-small"></i>
      <a href="all_users.php">
        <span class="text">
          <?php
          $query = "SELECT id FROM users ORDER BY id";
          $query_run = mysqli_query($conn, $query);
          $row = mysqli_num_rows($query_run);
          echo '<h1> ' . $row . ' </h1>';
          ?>
          <p>All Users</p>
        </span>
      </a>
      </a>

    </li>
    <li>
      <i class='fa fa-id-card size-small'></i>
      <a href="admin_membership.php">
        <span class="text">
          <?php
          $query = "SELECT id FROM membership_applications ORDER BY id";
          $query_run = mysqli_query($conn, $query);
          $row = mysqli_num_rows($query_run);
          echo '<h1> ' . $row . ' </h1>';
          ?>
          <p>Member Ship </p>
        </span>
      </a>


    </li>
    <li>
      <i class="fa fa-dumbbell size-small"></i>
      <a href="all_trainers.php">
        <span class="text">
          <?php
          $query = "SELECT id FROM trainers ORDER BY id";
          $query_run = mysqli_query($conn, $query);
          $row = mysqli_num_rows($query_run);
          echo '<h1> ' . $row . ' </h1>';
          ?>
          <p>Total Trainers</p>
        </span>
      </a>

    </li>
    <li>
      <i class='fa fa-envelope size-small'></i>
      <a href="users_query.php">
        <span class="text">
          <?php
          $query = "SELECT id FROM userquery ORDER BY id";
          $query_run = mysqli_query($conn, $query);
          $row = mysqli_num_rows($query_run);
          echo '<h1> ' . $row . ' </h1>';
          ?>
          <p>Total Query</p>
        </span>
      </a>
    </li>
  </ul>
</main>
<!-- MAIN -->
</section>
<!-- CONTENT -->


<script src="./js/script.js"></script>
</body>

</html>