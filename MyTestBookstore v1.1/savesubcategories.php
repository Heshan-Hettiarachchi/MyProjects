<?php 
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
if(isset($_POST["SubCategoryName"]))
  {
    $c = $_POST["SubCategoryName"];
 
    if($c != null)
    {
        
        $query = mysqli_query($conn, "insert into subcategories(name) values('$c')");
        if($query>0)
        {
          echo 'Successfully inserted sub-category to database!!!';
        }
        mysqli_close($conn);        
    }
    else
    {
        mysqli_close($conn);
        echo "Invalid sub-category details";
    }  
  }  
  else
  {
        echo "Invalid sub-category details";
  }

?>