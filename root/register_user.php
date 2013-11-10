<?php
include 'db_connect.php';
include 'sec_functions.php';
sec_session_start(); // Our custom secure way of starting a php session. 
 
if(isset($_POST['email'], $_POST['p'])) { 
   $email = $_POST['email'];
   $user = $_POST['user'];
   $code = $_POST['code'];
   $password = $_POST['p']; // The hashed password.
   if(register($user, $email, $password, $code, $mysqli) == true) {
      // Login success
	  //register login
	  echo "<script>
	    alert('Success: You have been registered!');
	    setTimeout(function(){window.location.href = '/login.html';}, 1000);
	  </script>";
      echo 'Success: You have been registered!';
	  echo '<br><a href="http://mob-gyn.com/login.html">Continue to Login Page</a>';
   } else {
      // registration failed
      echo "<script>
	    alert('Failure: You were not registered!');
	    setTimeout(function(){window.location.href = '/register.html';}, 1000);
	  </script>";
      echo 'Failure: You were not registered';
	  echo '<br><a href="http://mob-gyn.com/register.html">Continue to Login Page</a>';
	  }
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request';
}