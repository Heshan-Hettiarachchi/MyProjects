<?php 
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
if(isset($_POST["Save"]))
  {
    $id = $_POST["ISBNno"];
    $title = $_POST["Title"];
    $year = $_POST["YearOfPublishing"];
    $price = $_POST["Price"];
    $medium = $_POST["Medium"];
    $filename = $_FILES["file1"]["name"];
    $tempname = $_FILES["file1"]["tmp_name"];
    $author = $_POST["AuthorName"];
    $cat = $_POST["CategoryName"];
    $subcat = $_POST["SubCategoryName"];
    if($id != null && $title != null && $year != 0 && $price != 0.00 && $medium != null && $author != null && $cat != null && $subcat != null && move_uploaded_file($tempname, "images/$filename"))
    {
        
        $query = mysqli_query($conn, "insert into books(ISBNno, Title, YearOfPublishing, Price, Medium, Image) values('$id', '$title', '$year', '$price', '$medium', '$filename')");
        
        if($query==1)
        {
		$query2 = mysqli_query($conn, "insert into books_has_authors(book, author) values('$id', '$author')");
		if($query2==1)
                {
                	$query3 = mysqli_query($conn, "insert into book_has_categories(book, category, subcategory) values('$id', '$cat', '$subcat')");
			if($query3==1)
	                {
				echo 'Successfully inserted book to database!!!';
			}
			else
        		{
          			echo 'Category saving unsuccessful!!!';
        		} 		
                }
		else
        	{
          		echo 'Author saving unsuccessful!!!';
        	}          
        }
        else
        {
          echo 'Book saving unsuccessful!!!';
        }
        mysqli_close($conn);        
    }
    else
    {
        mysqli_close($conn);
        echo "Invalid book details";
    }  
  }  
  else
  {
        echo "Invalid book details";
  }

?>