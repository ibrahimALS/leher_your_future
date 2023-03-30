<?php

$username = "tenderfu_rizvi17";
$password = "#Rizvi175";
$dbname = "tenderfu_there";
$con=mysqli_connect($servername,$username,$password,$dbname);


  $name = trim($_POST["fullname"]);
  
   $email = trim($_POST["email"]);
      $phone = trim($_POST["phone"]);
         $password = trim($_POST["password"]);
         $city = trim($_POST["city"]);
         $sql = "INSERT INTO Users (email,password,fullname,city,skill,points) VALUES ( '$email','$password','$name','$city','no','0')";
         

if (mysqli_query($con, $sql)) {

  echo "New account created successfully";


} else {
  echo "Error:".mysqli_error($con);
}



mysqli_close($conn);

	

?>

