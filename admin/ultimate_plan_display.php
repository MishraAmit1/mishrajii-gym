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
    <a href="add_trainers_member.php" class="btn-download">
      <i class='bx bxs-cloud-download'></i>
      <span class="text">Add Trainers ➕</span>
    </a>
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
            <th>Price</th>
            <th>Time</th>
            <th>Services</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM gym_ultimate_plan";
          $query_run = mysqli_query($conn, $query);
          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
          ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['months']; ?></td>
                <td><?php echo $row['selectservices']; ?></td>
                <td>
                  <a href="edit_ultimate_plan.php?id=<?= $row['id'] ?>" class="status btn-bg-color-edit">Edit</a><br><br>
                  <a href="delete_premium_plan.php?id=<?= $row['id'] ?>" class="status btn-bg-color-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>

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