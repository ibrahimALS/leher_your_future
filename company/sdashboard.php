<?php
     include "config.php";  
   session_start();

$ID=$_SESSION['id'];

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
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<div class="sidebar">
    <a class="actived href="#home">Company Panel</a>
  <a class="active" href="#home">Dashboard</a>
  <a href="addpost.php">Add Post</a>
   <a href="addqs.php">Add Question</a>

     <a href="questionlist.php">Questions List</a>
  
  <a href="index.php">Logout</a>
</div>

<div class="content">
   <center> <img src="images/mainlogo.jpg"style="width: 30%"></center>
  <center><h2>MY POSTS</h2></center>
  
<center><div style="background:white;width:70%;height: 500px;
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;">

<table>
  <tr style="background:#eb7734;color:white;height:50px">
    <th>ID</th>
    <th>TITLE</th>
    <th>DESCRIPTION</th>
    <th>SKILL</th>
    <th>SALARY</th>
    <th>ACTIONS</th>
  </tr>
<?php
// Include config file
require_once "config.php";

 $sql = "SELECT * FROM posts where company_id='$ID' ";
  $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {

                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                     echo "<td>".$row['id']."</td> ";
                                        echo "<td>".$row['title']."</td> ";
                                        echo "<td>".$row['description']."</td> ";
                                         echo "<td>".$row['skill']."</td> ";
                                         
                                          echo "<td>".$row['salary']."</td> ";
                                         echo "<td><a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'>Delete</a>&nbsp&nbsp&nbsp<a href='editpost.php?id=". $row['id'] ."' title='Edit Record' data-toggle='tooltip'>Edit</a></td>";
                                        
                                    echo "</tr>";
                                }
                        }
                      




?>
</table>


</div>
</center>
</div>

</body>
</html>
