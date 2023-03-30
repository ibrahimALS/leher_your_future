<?php
// Initialize the session
session_start();

// Include config file


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tenderfu_rizvi17');
define('DB_PASSWORD', '#Rizvi175');
define('DB_NAME', 'tenderfu_there');
 
 

try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT * FROM company WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $email = $row["email"];
                        $gpassword = $row["password"];
                         $username = $row["name"];
                          $logo = $row["logo"];
                           $phone= $row["phone"];
                        if($password==$gpassword){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                         $_SESSION["phone"] = $phone; 
                            $_SESSION["logo"] = $logo; 
                            $_SESSION["name"] = $username; 
                            // Redirect user to welcome page
                            header("location:sdashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            echo '<script>alert("Invalid email or password.")</script>';
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                  
                    echo '<script>alert("Invalid email or password.")</script>';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">


.login-page {
  width: 30%;
  padding: 8% 0 0;
  margin: auto;
}.header {

  text-align: center;
  background: white;
  color: white;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;

  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {

  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {

  text-transform: uppercase;
  outline: 0;
  background:#050403;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #eb7734 ;

}
a{
  text-decoration: none;
  color: white;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
span{
  margin-right:80px;
  color: silver;
}
body {
  background: white; 
  font-family: "Arial"
    }

  </style>
</head>
<body>
<div class="header">
  <img src="images/mainlogo.jpg"style="width: 30%">

</div>

<div class="login-page">
  <div class="form">
  
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <h2>Company Login</h2>
      <input type="text" placeholder="Email" name="email" />
<span class="invalid-feedback"><?php echo $email_err; ?></span>
      <input type="password" placeholder="Password" name="password" />
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
      <button >login</button>
      <p class="message">Not registered? <a href="userregistration.php">Create an account</a></p>
       <p class="message">  <a href="../Adminpanel/index.php"  style="font-size: 20px: background:" >Admin Page</a></p>
    </form>
  </div>
</div>

</body>
</html>







