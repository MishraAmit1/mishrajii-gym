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
            <th>Full Name</th>
            <th>Role</th>
            <th>Image</th>
            <th>Twitter Link</th>
            <th>Facebook Link</th>
            <th>LinkedIn Link</th>
            <th>Instagram Link </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM trainers";
          $query_run = mysqli_query($conn, $query);
          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $row) {
              // echo $row['name'];
          ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?php echo '<img src="upload/' . $row['image'] . '" width="200px"; height="200px;" alt="image">' ?></td>

                <td><?= $row['twitter_link'] ?></td>
                <td><?= $row['facebook_link'] ?></td>
                <td><?= $row['linkedin_link'] ?></td>
                <td><?= $row['instagram_link'] ?></td>
                <td>
                  <a href="edit_trainer.php?id=<?= $row['id'] ?>" class="status btn-bg-color-edit">Edit</a><br><br>
                  <a href="delete_trainer.php?id=<?= $row['id'] ?>" class="status btn-bg-color-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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