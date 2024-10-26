<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

// Fetch the data of the plan that needs to be edited
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM gym_ultimate_plan WHERE id='$id'";
  $query_run = mysqli_query($conn, $query);
  $plan = mysqli_fetch_assoc($query_run);
}

// Update the plan details
if (isset($_POST['update_plan'])) {
  $price = $_POST['price'];
  $months = $_POST['months'];
  $services = $_POST['selectservices'];

  $sql = "UPDATE gym_ultimate_plan SET price='$price', months='$months', selectservices='$services' WHERE id='$id'";
  if (mysqli_query($conn, $sql)) {
    header("Location: ultimate_plan_display.php");
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}
?>

<?php include './shortcuts/admin_header.php'; ?>
<main>
  <div class="head-title">
    <div class="left">
      <h1>Edit Basic Plan</h1>
      <ul class="breadcrumb">
        <li><a href="#">Edit Basic Plan</a></li>
        <li><i class='fas fa-chevron-right'></i></li>
        <li><a class="active" href="admin_home.php">Home</a></li>
      </ul>
    </div>
  </div>
  <div class="form-container">
    <h2 class="form-title">Edit Plan</h2>
    <form action="" method="POST" class="user-form">
      <label for="price" class="form-label">Price:</label>
      <input type="text" name="price" value="<?php echo $plan['price']; ?>" class="form-input" required>

      <label for="months" class="form-label">Months:</label>
      <select class="form-control" name="months" required>
        <option value="2 Months" <?php echo $plan['months'] == '2 Months' ? 'selected' : ''; ?>>2 Months</option>
        <option value="3 Months" <?php echo $plan['months'] == '3 Months' ? 'selected' : ''; ?>>3 Months</option>
        <option value="4 Months" <?php echo $plan['months'] == '4 Months' ? 'selected' : ''; ?>>4 Months</option>
        <option value="5 Months" <?php echo $plan['months'] == '5 Months' ? 'selected' : ''; ?>>5 Months</option>
        <option value="6 Months" <?php echo $plan['months'] == '6 Months' ? 'selected' : ''; ?>>6 Months</option>
        <option value="7 Months" <?php echo $plan['months'] == '7 Months' ? 'selected' : ''; ?>>7 Months</option>
        <option value="8 Months" <?php echo $plan['months'] == '8 Months' ? 'selected' : ''; ?>>8 Months</option>
        <option value="9 Months" <?php echo $plan['months'] == '9 Months' ? 'selected' : ''; ?>>9 Months</option>
        <option value="10 Months" <?php echo $plan['months'] == '10 Months' ? 'selected' : ''; ?>>10 Months</option>
        <option value="11 Months" <?php echo $plan['months'] == '11 Months' ? 'selected' : ''; ?>>11 Months</option>
        <option value="12 Months" <?php echo $plan['months'] == '12 Months' ? 'selected' : ''; ?>>12 Months</option>
      </select>

      <label for="selectservices" class="form-label">Services:</label>
      <select class="form-control" name="selectservices" required>
        <option value="Cardio" <?php echo $plan['selectservices'] == 'Cardio' ? 'selected' : ''; ?>>Cardio</option>
        <option value="Cardio + Power Lifting" <?php echo $plan['selectservices'] == 'Cardio + Power Lifting' ? 'selected' : ''; ?>>Cardio + Power Lifting</option>
        <option value="Cardio + Power Lifting + Crossfit" <?php echo $plan['selectservices'] == 'Cardio + Power Lifting + Crossfit' ? 'selected' : ''; ?>>Cardio + Power Lifting + Crossfit</option>
      </select>

      <button type="submit" class="form-button" name="update_plan">Update Plan</button>
    </form>
  </div>
</main>
<!-- MAIN -->
</section>

<script src="./js/script.js"></script>
</body>

</html>