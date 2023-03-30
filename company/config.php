<?php
$servername = "localhost";
$username = "tenderfu_rizvi17";
$password = "#Rizvi175";
$dbname = "tenderfu_there";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>