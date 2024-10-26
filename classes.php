<?php
include_once "./config/dbconnect.php";
// Fetching class schedules from the database
$query = "SELECT * FROM classes";
$result = $conn->query($query);

$schedule = [];
while ($row = $result->fetch_assoc()) {
  $time_slot = date("g:i a", strtotime($row['start_time'])) . " - " . date("g:i a", strtotime($row['end_time']));
  $schedule[$row['day']][$time_slot] = ['class_name' => $row['class_name'], 'trainer_name' => $row['trainer_name']];
}
?>
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
  <style>
    .schedule-container {
      width: 100%;
      margin: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    thead {
      background-color: #000;
      color: #fff;
    }

    td,
    th {
      padding: 15px;
      text-align: center;
      border: 1px solid #ddd;
    }

    td {
      background-color: #f9f9f9;
    }

    strong {
      color: red;
    }

    .class-row.highlight {
      background-color: yellow;
      /* Highlight color */
    }
  </style>
</head>

<body>
  <?php include('./shortcuts/header.php');  ?>
  <div class="page-header">
    <div class="page-header-content">
      <h4 class="page-title">Classes </h4>
      <div class="breadcrumb">
        <p><a class="breadcrumb-link" href="index.php">Home</a></p>
        <p class="breadcrumb-separator">/</p>
        <p>Classes</p>
      </div>
    </div>
  </div>




  <div class="container gym-feature">
    <div class="text-center mb-5">
      <h4 class="text-primary">Class Timetable</h4>
      <h4 class="display-4">Working Hours and Class Time</h4>
    </div>
    <div class="tab-class">
      <ul class="nav justify-content-center mb-4">
        <li class="nav-item">
          <a class="nav-link active" data-filter="all">All Classes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-filter="cardio">Cardio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-filter="strength training">Strength Training</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-filter="boxing">Boxing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-filter="hiit">HIIT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-filter="zumba">Zumba</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-filter="yoga">Yoga</a>
        </li>
      </ul>

      <div class="class-list">
        <div class="schedule-container">
          <table>
            <thead>
              <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Define the time slots to appear in the first column
              $time_slots = [
                '6:00 am - 8:00 am',
                '10:00 am - 12:00 pm',
                '5:00 pm - 7:00 pm',
                '7:00 pm - 9:00 pm'
              ];

              foreach ($time_slots as $time_slot) {
                echo "<tr>";
                echo "<td>$time_slot</td>";

                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                foreach ($days as $day) {
                  if (isset($schedule[$day][$time_slot])) {
                    $class_name = $schedule[$day][$time_slot]['class_name'];
                    $trainer_name = $schedule[$day][$time_slot]['trainer_name'];

                    // Add a data-type attribute for filtering
                    $data_type = strtolower($class_name); // Assuming class_name corresponds to the filter name (e.g., 'zumba', 'cardio')
                    echo "<td class='class-row' data-type='$data_type'><strong>$class_name</strong><br>$trainer_name</td>";
                  } else {
                    echo "<td></td>";
                  }
                }

                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>








  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <i class="fas fa-arrow-up"></i>
  </a>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const navLinks = document.querySelectorAll(".nav-link");
      const classRows = document.querySelectorAll(".class-row");

      navLinks.forEach((link) => {
        link.addEventListener("click", function() {
          // Remove 'active' class from all links
          navLinks.forEach((nav) => nav.classList.remove("active"));
          this.classList.add("active");

          const filter = this.getAttribute("data-filter");

          // Reset all rows visibility
          classRows.forEach((row) => {
            // row.style.display = "none"; // Hide all classes first
            row.classList.remove("highlight"); // Remove highlight from all rows
          });

          // Show/Hide class rows based on the selected filter
          classRows.forEach((row) => {
            if (filter === "all") {
              row.style.display = "table-cell"; // Show all classes if "All Classes" is selected
            } else if (row.getAttribute("data-type") === filter) {
              row.style.display = "table-cell"; // Show matching classes
              row.classList.add("highlight"); // Optional: Add highlight effect
            }
          });
        });
      });
    });
  </script>
  <script src="./assets/js/script.js" defer></script>
  <?php include('./shortcuts/footer.php');  ?>
</body>

</html>