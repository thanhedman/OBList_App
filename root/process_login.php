<?php
include 'db_connect.php';
include 'sec_functions.php';
sec_session_start(); // Our custom secure way of starting a php session. 
 
if(isset($_POST['email'], $_POST['p'])) { 
   $email = $_POST['email'];
   $password = $_POST['p']; // The hashed password.
   if(login($email, $password, $mysqli) == true) {
      // Login success
	  //register login

      echo 'Success: You have been logged in!';
	  echo '<br><a href="http://mob-gyn.com/">Continue to Main Page</a>';
	  echo "<script>
		window.location.href = '/index.php';
	  </script>";
   } else {
      // Login failed
	  echo 'Failure: You were not logged in!';
	  echo '<br><a href="http://mob-gyn.com/login.html">Return to Login Page</a>';
	  echo "<script>
	    alert('Failure: You were not logged in!');
	    setTimeout(function(){window.location.href = '/login.html';}, 1000);
	  </script>";
   }
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request';
}