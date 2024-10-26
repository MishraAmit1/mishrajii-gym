<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "mishrajii_gym";

$conn = mysqli_connect("$db_host", "$db_username", "$db_password", "$db_name");
if (!$conn) {
  die(mysqli_connect_error($conn));
}
