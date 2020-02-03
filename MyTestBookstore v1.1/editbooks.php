<?php 
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
$id = "";
    $title = "";
    $year = 0;
    $price = 0.00;
    $medium = "";
    $filename = "";
    $tempname = "";
    $author = "";
    $cat = "";
    $subcat = "";
 if(isset($_POST["ISBN"]))
  {
    $id = $_POST["ISBN"];
    $query = mysqli_query($conn, "select b1.ISBNno, b1.Title, b1.YearOfPublishing, b1.Price, b1.Medium, b1.Image, b2.author, b3.Category, b3.SubCategory from books b1, books_has_authors b2, book_has_categories b3 WHERE b1.ISBNno=b2.book AND b2.book=b3.book AND b1.ISBNno=b3.book AND b1.ISBNno='$id'");
    while($row = mysqli_fetch_array($query))
    {
      $title = $row[1];
      $year = $row[2];
      $price = $row[3];
      $medium = $row[4];
      $filename = $row[5];
      $author = $row[6];
      $cat = $row[7];
      $subcat = $row[8];
    }
  }        
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Books</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Test Book Store</h1>
	<div class="content">
  <pre>
  		<form action="updatebooks.php" method="POST" enctype="multipart/form-data">
		ISBN: <input type="text" name="ISBNno" value="<?php echo $id; ?>"/><br/>
		Title: <input type="text" name="Title" value="<?php echo $title; ?>"/><br/>
    		Year of Publishing: <input type="text" name="YearOfPublishing" value="<?php echo $year; ?>"/><br/>
    		Price: <input type="text" name="Price" value="<?php echo $price; ?>"/><br/>
    		Medium: <input type="text" name="Medium" value="<?php echo $medium; ?>"/><br/>
    		Author: <select name="AuthorName">
    <?php 
      $query = mysqli_query($conn, "select * from authors");
      if(mysqli_num_rows($query) > 0)
      {
            while($row = mysqli_fetch_assoc($query))
            {
$sel = (isset($_POST['ISBN']) && $author == $row['authorID']) ? 'selected="selected"':'';
 
echo('<option name="'.$row['name'].'" value="'.$row['authorID'].'" '.$sel.' >'.$row['name'].'</option>');

            }            
          }
    ?>
    </select><br/>
    		Category: <select name="CategoryName">
    <?php 
      $query = mysqli_query($conn, "select * from categories");
      if(mysqli_num_rows($query) > 0)
      {
            while($row = mysqli_fetch_assoc($query))
            {
$sel1 = (isset($_POST['ISBN']) && $cat == $row['name']) ? 'selected="selected"':'';
 
echo('<option name="'.$row['name'].'" value="'.$row['name'].'" '.$sel1.' >'.$row['name'].'</option>');

            }            
          }
    ?>
    </select><br/>
    		Sub-Category: <select name="SubCategoryName">
    <?php 
      $query = mysqli_query($conn, "select * from subcategories");
      if(mysqli_num_rows($query) > 0)
      {
            while($row = mysqli_fetch_assoc($query))
            {
              $sel2 = (isset($_POST['ISBN']) && $subcat == $row['name']) ? 'selected="selected"':'';
 
	      echo('<option name="'.$row['name'].'" value="'.$row['name'].'" '.$sel2.' >'.$row['name'].'</option>');
            }            
          }
    ?>
    </select><br/>
    		Image: <input type="file" name="file1" src="<?php echo 'images/$filename'; ?>"/><br/>
		<input type="submit" name="Update" value="Update"/>
	</form>
  </pre>
	</div>
</body>
</html>