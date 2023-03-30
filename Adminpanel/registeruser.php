<?php
// Include config file

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tenderfu_rizvi17');
define('DB_PASSWORD', '#Rizvi175');
define('DB_NAME', 'tenderfu_quizzinger');
 
 

try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

$username=$_POST['username'];

$email=$_POST['email'];
$phone=$_POST['phone'];
$pass=$_POST['pass'];



       
        $sql = "INSERT INTO user(username,email,password,phone,points) VALUES (:username,:email ,:pass,:phone,:points)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
          
            $stmt->bindParam("username", $param_username, PDO::PARAM_STR);
             $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":pass", $param_pass, PDO::PARAM_STR);
             $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
              $stmt->bindParam(":points", $param_points, PDO::PARAM_STR);
           
            // Set parameters
         $param_username = $username;
   
            $param_email= $email;
             $param_pass = $pass;
            $param_phone = $phone;
             $param_points = $points;
           
           
            if($stmt->execute()){
                // Redirect to login page
                echo "data submitted";
// Now 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    
    
    // Close connection
    unset($pdo);

?>  
