<?php 
session_start();
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
$id = "";
if($_SESSION["StoreUn"] != null)
{
  if(isset($_POST["ISBN"]))
  {
    $id = $_POST["ISBN"];
     $query = mysqli_query($conn, "Delete from books WHERE ISBNno='$id'"); 
        if($query>0)
        {
          echo 'Book deleted successfully!!!';
        }
        else
        {
          echo 'Book deletion unsuccessful!!!';
        }
        mysqli_close($conn);   
  }  
}
else
{
header("Location:logout.php");
}

?>
