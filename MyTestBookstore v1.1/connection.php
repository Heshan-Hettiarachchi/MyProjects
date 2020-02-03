<?php 

date_default_timezone_set("Asia/Colombo");
    define("DB_SERVER", "127.0.0.1");
define("DB_USER", "cweb");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "bookstoredb");

$conn = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
   if(!$conn)
    {
	die('Could not connect:'.mysqli_connect_error());
    }  
    
?>