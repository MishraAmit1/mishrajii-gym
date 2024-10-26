<?php
include_once "../config/dbconnect.php";
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}
// Fetch all users' details
$sql = "SELECT id, fullname, email, membership_status, gender, address, phone_number FROM users";
$result = $conn->query($sql);
?>

<?php
include './shortcuts/admin_header.php'
?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>All Registered Users</h1>
      <ul class="breadcrumb">
        <li>
          <a href="#">All Registered Users</a>
        </li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li>
          <a class="active" href="admin_home.php">Home</a>
        </li>
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
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Membership Status</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['fullname'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= ucfirst($row['membership_status']) ?></td>
              <td><?= $row['gender'] ?></td>
              <td><?= $row['address'] ?></td>
              <td><?= $row['phone_number'] ?></td>
              <td>
                <a href="edit_user.php?id=<?= $row['id'] ?>" class="status btn-bg-color-edit">Edit</a><br><br>
                <a href="delete_user.php?id=<?= $row['id'] ?>" class="status btn-bg-color-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
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