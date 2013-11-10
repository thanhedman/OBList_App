<?php
define("HOST", "obscurelogin.db.11509220.hostedresource.com"); // The host you want to connect to.
define("USER", "obscurelogin"); // The database username.
define("PASSWORD", "jFRHceN!zJpaK1"); // The database password. 
define("DATABASE", "obscurelogin"); // The database name.
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter.