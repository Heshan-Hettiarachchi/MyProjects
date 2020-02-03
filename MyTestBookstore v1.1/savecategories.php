<?php 
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
if(isset($_POST["CategoryName"]))
  {
    $c = $_POST["CategoryName"];
    if($c != null)
    {
        
        $query = mysqli_query($conn, "insert into categories(name) values('$c')");
        if($query>0)
        {
        	echo 'Successfully inserted category to database!!!';
        }
        mysqli_close($conn);        
    }
    else
    {
        mysqli_close($conn);
        echo "Invalid category details";
    }  
  }  
  else
  {
        echo "Invalid category details";
  }

?>