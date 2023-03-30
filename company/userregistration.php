<?php
// Include config file
require_once "config.php";
 




if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $filename = $_FILES["fileUpload"]["name"];
    $tempname = $_FILES["fileUpload"]["tmp_name"];    
        $folder = "images/".$filename;
  $name = trim($_POST["name"]);
   $about = trim($_POST["about"]);
   $email = trim($_POST["email"]);
      $phone = trim($_POST["phone"]);
         $password = trim($_POST["password"]);
        

    
if(!empty( $name)&&!empty( $email)&&!empty($phone)&&!empty( $password)&&!empty( $about))
{
    // Check input errors before inserting in database

       
        $sql = "INSERT INTO company (name,email,password,phone,logo,about) VALUES ( '$name','$email','$password','$phone','$filename','$about')";
         

if (mysqli_query($conn, $sql)) {

  echo '<script>alert("New account created successfully")</script>';
   header("location: index.php");

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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <style type="text/css">
          *, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  font-family: 'Nunito', sans-serif;
  color: #384047;

}

form {
  max-width: 300px;
  margin: 10px auto;
  padding: 10px 20px;
  background: #f4f7f8;
  border-radius: 8px;
}

h1 {
  margin: 0 0 30px 0;
  text-align: center;
}

input[type="text"],
input[type="password"],
input[type="phone"],
input[type="date"],
input[type="datetime"],
input[type="email"],
input[type="number"],
input[type="search"],
input[type="tel"],
input[type="time"],
input[type="url"],
textarea,
select {
  background: rgba(255,255,255,0.1);
  border: none;
  font-size: 16px;
  height: auto;
  margin: 0;
  outline: 0;
  padding: 15px;
  width: 100%;
  background-color: #e8eeef;
  color: #8a97a0;
  box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
  margin-bottom: 30px;
}

input[type="radio"],
input[type="checkbox"] {
  margin: 0 4px 8px 0;
}

select {
  padding: 6px;
  height: 32px;
  border-radius: 2px;
}

button {
  padding: 19px 39px 18px 39px;
  color: #FFF;
  background-color: #050403;
  font-size: 18px;
  text-align: center;
  font-style: normal;
  border-radius: 5px;
  width: 100%;
  border: 1px solid #3ac162;
  border-width: 1px 1px 3px;
  box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
  margin-bottom: 10px;
}
.header {

  text-align: center;
  background: #29c785;
  color: white;
}
fieldset {
  margin-bottom: 30px;
  border: none;
}

legend {
  font-size: 1.4em;
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 8px;
}

label.light {
  font-weight: 300;
  display: inline;
}

.number {
  background-color:#eb7734;
  color: #fff;
  height: 30px;
  width: 30px;
  display: inline-block;
  font-size: 0.8em;
  margin-right: 4px;
  line-height: 30px;
  text-align: center;
  text-shadow: 0 1px 0 rgba(255,255,255,0.2);
  border-radius: 100%;
}

@media screen and (min-width: 480px) {

  form {
    max-width: 480px;
  }

}
button:hover,.form button:active,.form button:focus {
  background:#eb7734 ;

}      </style>
    </head>
    <body>
<br><br><br><br>
<div class="header">
 

</div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <br><br>
        <h1>Sign Up</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Company Info</legend>
          <label for="name">Company Name:</label>
          <input type="text" id="name" name="name" placeholder="Name">
           
<h7>About</h7>
<textarea name='about' placeholder="e.g About.."></textarea>

          <label for="mail">Email:</label>
          <input type="email" id="mail" name="email" placeholder="Email">
         
            <label for="phone">Phone:</label>
          <input type="phone" id="phone" name="phone" placeholder="Phone">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Password">
           <label >Company Logo:</label>
         
           
            <div class="user-image mb-3 text-center">
    <div style="width: 100px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
      <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
    </div>
  </div>

  <div class="custom-file">
    <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
    <label class="custom-file-label" for="chooseFile">Select file</label>
  </div>
          
        </fieldset>
        
       
      
        <button type="submit">Sign Up</button>
        <p class="message"> Already have an account      <a href="index.php">Login Page</a></p>
      </form>
       <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#imgPlaceholder').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#chooseFile").change(function () {
      readURL(this);
    });
  </script>
    </body>
</html>