<?php
// Initialize the session
session_start();
 

	       $_SESSION["loggedin"] = false;
	       $_SESSION["id"] =0;

    header("location: index.php",true,  301);
    exit;

?>
