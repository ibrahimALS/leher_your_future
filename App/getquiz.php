<?php


$username = "tenderfu_rizvi17";
$password = "#Rizvi175";
$dbname = "tenderfu_there";
$con=mysqli_connect($servername,$username,$password,$dbname);





$sql="SELECT * FROM quiz where status='Active'";
$result=mysqli_query($con,$sql);
 
$data=array();

 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
   $data["data"][]=$row;
  }
} else {
  echo "0 results";
}

 
 
 
 
 header('Content-Type:Application/json');
 
 echo json_encode($data);

	

?>