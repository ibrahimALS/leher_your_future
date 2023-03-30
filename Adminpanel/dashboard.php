<?php
// Include config file
require_once "config.php";

$qcount=0;
$ucount=0;
$ccount=0;
 $sql = "SELECT * FROM questions ";
  $result = mysqli_query($conn, $sql);
                       
$rows_count_value = mysqli_num_rows($result);
                             

                               $qcount=$rows_count_value ;
                              
                        
                 

 $sql2 = "SELECT * FROM Users ";
  $result2 = mysqli_query($conn, $sql2);
                       
$rows_count_value2 = mysqli_num_rows($result2);
                             

                               $ucount=$rows_count_value2 ;
                              
                        
              $sql3 = "SELECT * FROM company ";
  $result3 = mysqli_query($conn, $sql3);
                       
$rows_count_value3 = mysqli_num_rows($result3);
                             

                               $ccount=$rows_count_value3 ;          


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color:#555;
  color: white;
}
.sidebar a.actived {
  background-color:#eb7734;
  color: white;
  font-size: 20px;
  font-weight: bold;
}
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}


div.card 
  width: 200px;
  height:200px;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
}
div.header {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  font-size:20px;
}.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #f1f1f1;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color:#56d7c6;
}
.column {
  float: left;
  width: 25%;
  margin-left:200px;
  padding: 0 10px;
}
div.container {
  padding: 10px;
}

p{
  font-weight: bold;
  color: white;

}
.header h1{
  color: white;

}
</style>
</head>
<body>

<div class="sidebar">
    <a class="actived href="#home">Admin Panel</a>
  <a class="active" href="#home">Dashboard</a>
  <a href="allpost.php" >Posts List</a>
  <a href="addquestion.php">Add Question</a>
  <a href="questionlist.php">Questions List</a>
 
     <a href="createquiz.php">Create Quiz</a>
      <a href="createquiz.php">Quiz Lists</a>


       <a href="manageusers.php">Manage Users</a>
     <a href="managecompanies.php">Manage Companies</a>
  <a href="logout.php">Logout</a>
</div>

<div class="content">
   <center> <img src="images/mainlogo.jpg"style="width: 30%"></center>
  <center><h2>Dashboard</h2></center>
  
<center><div style="
  text-align: center;">
<center>
<br><br>
<div style="width:30%;background:#eb7734;color:white;padding:30px;display:inline-block">
  
<h1>Total Questions</h1>
<h3><?php echo $qcount ?></h1>
</div>
<div style="width:30%;background:#eb7734;color:white;padding:30px;display:inline-block">
  
<h1>Total Companies</h1>
<h3><?php echo $ccount ?></h1>
</div>
</center>

</div>
<br>

<div style="width:30%;background:#555;color:white;padding:30px;">
  
<h1>Total Users</h1>
<h3><?php echo $ucount ?></h1>
</div>
</center>


</div>
</center>
</div>

</body>
</html>
