<?php
//security section
// Includes
$db_connect = $_SERVER['DOCUMENT_ROOT'];
$db_connect .= "/db_connect.php";
include($db_connect);
$sec_functions = $_SERVER['DOCUMENT_ROOT'];
$sec_functions .= "/sec_functions.php";
include($sec_functions);
//secure session start
sec_session_start();
//login check
if(login_check($mysqli) == true) {
//protected content
$allowedExts = array("csv");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";


      move_uploaded_file($_FILES["file"]["tmp_name"],
      "/home/content/20/11509220/html/php/oblisttest.csv");
      echo "Stored in: " . "php/oblisttest.csv";
    }
include '/home/content/20/11509220/html/php/mygetcsvTEST.php';
  }
else
  {
  echo "Invalid file";
  }
}
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}