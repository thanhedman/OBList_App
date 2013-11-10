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
echo "<html>
<body>
<form action=\"php/uploadCSV.php\" method=\"post\"
enctype=\"multipart/form-data\">
<label for=\"file\">OB List	:</label>
<input type=\"file\" name=\"file\" id=\"file\"><br>
<input type=\"submit\" name=\"submit\" value=\"Submit\">
</form>

</body>
</html>";
}
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}