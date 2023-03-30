<?php
// Include config file
require_once "config.php";


 $sql = "SELECT * FROM user ORDER BY points desc, timee asc";

  $result = mysqli_query($conn, $sql);
     $user_arr = array();
if (mysqli_num_rows($result) > 0) {

while($row = mysqli_fetch_array($result)){
  $user_arr[]=array( $row['email'],$row['points'],$row['timee']);
                                };}
    $serialize_user_arr = serialize($user_arr);
$headers = ["Email", "Points", "Time(Seconds)"];
$headers2 = ["", "", ""];
$filename='userdata.csv';
$file = fopen($filename,"w");
 fputcsv($file,$headers);
  fputcsv($file,$headers2);
foreach ($user_arr as $line){
 fputcsv($file,$line);
}
fclose($fp);
header('Content-type: text/csv');
header('Content-disposition:attachment; filename="'.$filename.'"');
readfile($filename);

 header("location: manageusers.php",true,  301);
 exit;
        






?>