<?php
include_once "../config/dbconnect.php";
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

?>

<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>All Trainers</h1>
      <ul class="breadcrumb">
        <li><a href="#">All Trainers</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>
  <div class="table-data">
    <div class="order">
      <div class="head">
        <h3>Recent Orders</h3>
        <i class='bx bx-search'></i>
        <i class='bx bx-filter'></i>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM userquery";
          $query_run = mysqli_query($conn, $query);
          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
          ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td>
                  <a href="delete_userquery.php?id=<?= $row['id'] ?>" class="status btn-bg-color-delete" onclick="return confirm('Are you sure you want to delete this query?');">Delete</a>

                </td>
              <?php
            }
          } else {
              ?>
              <tr>
                <td>no record found</td>
              </tr>
            <?php
          }
            ?>
        </tbody>

      </table>
    </div>

  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>