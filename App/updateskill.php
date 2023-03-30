<?php

$username = "tenderfu_rizvi17";
$password = "#Rizvi175";
$dbname = "tenderfu_there";
$con=mysqli_connect($servername,$username,$password,$dbname);


  $name = trim($_POST["skill"]);
  
   $email = trim($_POST["email"]);
     
           $sql = "Update Users  Set  skill='$name' where  email='$email'";
         

if (mysqli_query($con, $sql)) {

  echo "account updated successfully";


} else {
  echo "Error:".mysqli_error($con);
}



mysqli_close($conn);

	

?>
