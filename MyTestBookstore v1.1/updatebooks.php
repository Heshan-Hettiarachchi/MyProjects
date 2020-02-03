<?php 
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
$id = "";
    $title = "";
    $year = 0;
    $price = 0;
    $medium = "";
    $filename = "";
    $tempname = "";
    $author = "";
    $cat = "";
    $subcat = "";
if(isset($_POST["Update"]))
  {
    $id = $_POST["ISBNno"];
    $title = $_POST["Title"];
    $year = $_POST["YearOfPublishing"];
    $price = $_POST["Price"];
    $medium = $_POST["Medium"];
    $filename = $_FILES["file1"]["name"];
    $tempname = $_FILES["file1"]["tmp_name"];
    $author = $_POST['AuthorName'];
    $cat = $_POST['CategoryName'];
    $subcat = $_POST['SubCategoryName'];
    
   //echo 'ID:'.$id.' Title:'.$title.' Year:'.$year.' Price:'.$price.' Medium:'.$medium.' Author:'.$author.' Category:'.$cat.' Subcategory:'.$subcat;
    if($id != null && $title != null && $year != 0 && $price != 0 && $medium != null && $author != null && $cat != null && $subcat != null)
    {
     if($filename != null)
    	{
	move_uploaded_file($tempname, "images/$filename");
	$query = mysqli_query($conn, "Update books set Title='{$title}', YearOfPublishing={$year}, Price='{$price}', Medium='{$medium}', Image='{$filename}' WHERE ISBNno='{$id}'");
         if($query==1)
        {
		echo 'Book updated successfully!!!';	
		$query2 = mysqli_query($conn, "Update books_has_authors set author={$author} WHERE book='{$id}'");
        	if($query2==1)
        	{
			echo 'Author updated successfully!!!'; 
			$query3 = mysqli_query($conn, "Update book_has_categories set category='{$cat}', subcategory='{$subcat}' WHERE book='{$id}'");
        		if($query3==1)
			{

				echo 'Category updated successfully!!!';
     
			}
			else
        		{
          			echo 'Category updation unsuccessful!!!';
        		} 	              		
        	}
        	else
        	{
			echo 'Author updation unsuccessful!!!';
        	}   
        }
        else
        {
                echo 'Book updation unsuccessful!!!';
        }               

    	}
        else
	{
    		$query = mysqli_query($conn, "Update books set Title='$title', YearOfPublishing='$year', Price='$price', Medium='$medium' WHERE ISBNno='$id'");
         if($query==1)
        {
		echo 'Book updated successfully!!!';	
		$query2 = mysqli_query($conn, "Update books_has_authors set author='$author' WHERE book='$id'");
        	if($query2==1)
        	{
			echo 'Author updated successfully!!!'; 
			$query3 = mysqli_query($conn, "Update book_has_categories set category='$cat', subcategory='$subcat' WHERE book='$id'");
        		if($query3==1)
			{

				echo 'Category updated successfully!!!';
     
			}
			else
        		{
          			echo 'Category updation unsuccessful!!!';
        		} 	              		
        	}
        	else
        	{
			echo 'Author updation unsuccessful!!!';
        	}   
        }
        else
        {
                echo 'Book updation unsuccessful!!!';
        }  
	}
    }
    else
    {
          echo 'Invalid data!!!';
    }
        mysqli_close($conn);   
        
  }
?>
