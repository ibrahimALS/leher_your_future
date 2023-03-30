<?php
// Include config file
require_once "config.php";
 




if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  $privacy = trim($_POST["privacy"]);
   $term = trim($_POST["term"]);
      $contact = trim($_POST["contact"]);
     

    
if(!empty( $privacy)&&!empty( $term)&&!empty($contact))
{
    // Check input errors before inserting in database

       
        $sql = "INSERT INTO setting (privacy,term,contact) VALUES ( '$privacy','$term','$contact')";
         

if (mysqli_query($conn, $sql)) {

  echo '<script>alert("setting added successfully")</script>';

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
else{
  echo '<script>alert("Enter credentials please")</script>';
}
mysqli_close($conn);
}
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
  background-color:#20cbb6;
  color: white;
}
.sidebar a.actived {
  background-color:#bdd516;
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
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;

}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
 width: 400px
}
.wrapper{
  display: inline-row;
  background: #fff;
  
  width: 200px;
  align-items: center;
  justify-content: space-between;
  border-radius: 5px;
  padding: 20px 5px;
  box-shadow: 5px 5px 30px rgba(0,0,0,0.2);
}
.wrapper .option{
  
  background: #fff;
  height: 60%;
  width: 80%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 0 10px;
  border-radius: 5px;
  cursor: pointer;
  padding: 0 10px;
  border: 2px solid lightgrey;
  transition: all 0.3s ease;
}
.table{
display: flex;
justify-content: space-between;
}
.wrapper .option .dot{
  height: 20px;
  width: 20px;
  background: #d9d9d9;
  border-radius: 50%;
  position: relative;
}
.wrapper .option .dot::before{
  position: absolute;
  content: "";
  top: 4px;
  left: 4px;
  width: 12px;
  height: 12px;
  background: #0069d9;
  border-radius: 50%;
  opacity: 0;
  transform: scale(1.5);
  transition: all 0.3s ease;

}
input[type="radio"]{
  display: none;
}
#option-1:checked:checked ~ .option-1,
#option-3:checked:checked ~ .option-3,
#option-2:checked:checked ~ .option-2{
  border-color: #0069d9;
  background: #0069d9;
}
#option-1:checked:checked ~ .option-1 .dot,
#option-3:checked:checked ~ .option-3 .dot,
#option-2:checked:checked ~ .option-2 .dot{
  background: #fff;
}
#option-1:checked:checked ~ .option-1 .dot::before,
#option-3:checked:checked ~ .option-3 .dot::before,
#option-2:checked:checked ~ .option-2 .dot::before{
  opacity: 1;
  transform: scale(1);
}
.wrapper .option span{
  font-size: 20px;
  color: #808080;
}
#option-1:checked:checked ~ .option-1 span,
#option-3:checked:checked ~ .option-3 span,
#option-2:checked:checked ~ .option-2 span{
  color: #fff;
}

.flex-container {
  display: flex;
  
}

.flex-container > div {
  
  margin: 5px;
  padding: 15px;
  font-size: 14px;
}

</style>
</head>
<body>

<div class="sidebar">
    <a class="actived href="#home">Admin Panel</a>
  <a  href="dashboard.php">Dashboard</a>
   <a href="categorylist.php" >Category List</a>
  <a href="addquestion.php"  >Add Question</a>
  <a href="questionlist.php">Questions List</a>
   <a href="createquiz.php">Create Quiz</a>
 
    <a href="quizlist.php">Quiz List</a>
     <a href="manageusers.php">Manage Users</a>
      
              <a href="setting.php" class="active">Setting</a>
  <a href="logout.php">Logout</a>
  
</div>

<div class="content">
  <center><h2>Setting</h2></center>
  
<center><div style="
  text-align: center;">

<center>
<br><br>
<div class="container">
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">





    <label for="fname">Term Condition</label>
    <input type="text" id="fname" name="term" placeholder="https://www.google.com">

   <label for="fname">Privacy Policy</label>
    <input type="text" id="fname" name="privacy" placeholder="https://www.google.com">

   <label for="fname">Contact info</label>
    <input type="text" id="fname" name="contact" placeholder="https://www.google.com">

 


<center>
<div class="submit">
    <input type="submit" value="Save" style=" width:150px" >
</div>
</center>



  </form>
</div>

</center>


</div>
</center>
</div>

</body>
</html>
