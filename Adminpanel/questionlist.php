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
  background-color:orange;
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
div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;

}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;

}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  margin-top: 10px;
}

input[type=submit] {
  background-color: #393fa8;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: black;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 40px;
  margin: 2%
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
    <a class="actived href="#home">Admin Panel</a>
  <a  href="dashboard.php">Dashboard</a>
  <a href="allpost.php" >Post List</a>
  <a href="addquestion.php"  >Add Question</a>
  <a href=""class="active">Questions List</a>
  <a href="createquiz.php">Create Quiz</a>
      <a href="quizlist.php">Quiz Lists</a>
   
      <a href="manageusers.php">Manage Users</a>
      
            <a href="managecompanies.php">Manage Companies</a>
  <a href="logout.php">Logout</a>
</div>

<div class="content">
  <center><h2>List of Question</h2></center>
  
<center><div style="
  text-align: center;">

<center>


<table>
  <tr style="background:#eb7734;color:white;height:50px">
    <th>Question</th>
    <th>Answer</th>
    <th>Company</th>
    <th>Action</th>
  </tr>
<?php
// Include config file
require_once "config.php";

 $sql = "SELECT * FROM questions ";
  $result = mysqli_query($conn, $sql);
                       if (mysqli_num_rows($result) > 0) {

                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                        echo "<td>".$row['title']."</td> ";
                                         echo "<td>".$row['answer']."</td> ";
                                         echo "<td>".$row['company_name']."</td> ";
                                         echo "<td><a href='deleteqs.php?id=".$row['id']."' title='Delete Record' data-toggle='tooltip'>Delete</a>&nbsp&nbsp&nbsp<a href='editquestion.php?id=". $row['id'] ."' title='Edit Record' data-toggle='tooltip'>Edit</a></td>";

                                    echo "</tr>";
                                }
                        }
                      




?>
</table>

</center>


</div>
</center>
</div>

</body>
</html>
