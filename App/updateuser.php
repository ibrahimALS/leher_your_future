<?php

$username = "tenderfu_rizvi17";
$password = "#Rizvi175";
$dbname = "tenderfu_there";
$con=mysqli_connect($servername,$username,$password,$dbname);


  $name = trim($_POST["fullname"]);
  
   $email = trim($_POST["email"]);
     
         $city = trim($_POST["city"]);
           $sql = "Update Users  Set  fullname='$name',city='$city' where  email='$email'";
         

if (mysqli_query($con, $sql)) {

  echo "account updated successfully";


} else {
  echo "Error:".mysqli_error($con);
}



mysqli_close($conn);

	

?>

