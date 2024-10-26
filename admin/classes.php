<?php
include_once "../config/dbconnect.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit();
}

// Fetching class schedules from the database
$query = "SELECT * FROM classes";
$result = $conn->query($query);

$schedule = [];
while ($row = $result->fetch_assoc()) {
  $time_slot = date("g:i a", strtotime($row['start_time'])) . " - " . date("g:i a", strtotime($row['end_time']));
  $schedule[$row['day']][$time_slot] = [
    'class_name' => $row['class_name'],
    'trainer_name' => $row['trainer_name'],
    'id' => $row['id'] // Store the class ID for editing
  ];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Manage Classes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .schedule-container {
      width: 90%;
      margin: 40px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 16px;
    }

    thead {
      background-color: #3f51b5;
      color: white;
    }

    td,
    th {
      padding: 15px;
      text-align: center;
      border: 1px solid #e0e0e0;
    }

    th {
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: bold;
    }

    td {
      background-color: #fafafa;
    }

    tr:nth-child(even) td {
      background-color: #f1f1f1;
    }

    strong {
      color: #e91e63;
      font-weight: 600;
    }

    .edit-button {
      background-color: #2196f3;
      color: white;
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 5px;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .edit-button:hover {
      background-color: #1976d2;
    }

    td:hover {
      background-color: #e3f2fd;
    }

    table,
    th,
    td {
      border-radius: 5px;
    }

    a {
      text-decoration: none;
    }

    @media (max-width: 768px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        margin-bottom: 15px;
      }

      td {
        text-align: right;
        padding-left: 50%;
        position: relative;
      }

      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        text-align: left;
        font-weight: bold;
      }

      td:last-child {
        border-bottom: 0;
      }
    }
  </style>
</head>

<body>

  <?php include './shortcuts/admin_header.php'; ?>

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
              $class_id = $schedule[$day][$time_slot]['id']; // Get the class ID

              // If class_name is "No Classes Today", show only that
              if ($class_name === 'No Classes Today') {
                echo "<td><strong>$class_name</strong><br>
                                  <a class='edit-button' href='edit_class.php?id=$class_id'>Edit</a></td>";
              } else {
                echo "<td><strong>$class_name</strong><br>$trainer_name<br>
                                  <a class='edit-button' href='edit_class.php?id=$class_id'>Edit</a></td>";
              }
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
  <script src="./js/script.js"></script>
</body>

</html>