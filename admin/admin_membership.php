<?php
include_once "../config/dbconnect.php";
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

// Fetch all membership applications
$sql = "SELECT u.id, u.fullname, u.email, m.membership_plan, m.workout_time, m.emergency_contact_phone, u.membership_status
        FROM users u 
        JOIN membership_applications m ON u.id = m.user_id";

$result = $conn->query($sql);
?>

<?php include './shortcuts/admin_header.php' ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>All GYM Membership</h1>
      <ul class="breadcrumb">
        <li><a href="#">All GYM Membership</a></li>
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
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Membership Plan</th>
            <th>Workout Time</th>
            <th>Emergency Contact</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tbody>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['fullname']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['membership_plan']) ?></td>
              <td><?= htmlspecialchars($row['workout_time']) ?></td>
              <td><?= htmlspecialchars($row['emergency_contact_phone']) ?></td>
              <td>
                <!-- Show both buttons, disable one based on status -->
                <?php if ($row['membership_status'] === 'approved'): ?>
                  <button class="status completed pointer" disabled title="This membership is approved">Approved</button>
                  <button onclick="approveMembership(<?= $row['id'] ?>, 'reject', this)" class="status rejected pointer">Reject</button>
                <?php elseif ($row['membership_status'] === 'rejected'): ?>
                  <button onclick="approveMembership(<?= $row['id'] ?>, 'approve', this)" class="status completed pointer">Approve</button>
                  <button class="status rejected pointer" disabled title="This membership is rejected">Rejected</button>
                <?php else: ?>
                  <button onclick="approveMembership(<?= $row['id'] ?>, 'approve', this)" class="status completed pointer approve-btn">Approve</button>
                  <button onclick="approveMembership(<?= $row['id'] ?>, 'reject', this)" class="status rejected pointer reject-btn">Reject</button>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</main>

<script src="./js/script.js"></script>
</body>

</html>