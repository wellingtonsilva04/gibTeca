<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
<<<<<<< HEAD
define('DB_USERNAME', 'welconv');
define('DB_PASSWORD', 'sawe2404');
=======
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'steamfree');
>>>>>>> 2ad6b32a2884369ac587431008e873c5126501c4
define('DB_NAME', 'mydb');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>