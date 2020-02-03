<?php 
session_start();
require_once('connection.php');
date_default_timezone_set("Asia/Colombo");
if($_SESSION["StoreUn"] == null)
{
header("Location:logout.php");
}         
          
          
?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>
	function showAlert(){
  if($("#myAlert").find("div#myAlert2").length==0){
    $("#myAlert").append("<div class='alert alert-success alert-dismissable' id='myAlert2'> <button type='button' class='close' data-dismiss='alert'  aria-hidden='true'>&times;</button> ISBN='.$row[0].' Title='.$row[1].' Author='.$row[2].' Category='.$row[3].' Sub-Category='.$row[4].' Price='.$row[5].'</div>");
  }
  $("#myAlert").css("display", "");
}
    </script>
</head>
<body>
<h1>Test Book Store</h1>
	<div class="sidebar">
		<ul>
			<li><a href="authors.php">Authors</a></li>			
			<li><a href="categories.php">Categories</a></li>	
			<li><a href="subcategories.php">Sub-Categories</a></li>	
			<li><a href="books.php">Books</a></li>	
      <li><a href="logout.php">Log-out</a></li>
		</ul>
	</div>
	<div class="content">
  <form action="#" method="POST">
      <input type="text" placeholder="Search by Name or Author" name="searchBook">
      <button type="submit" name="SearchBookButton"><i class="fa fa-search"></i></button>
    </form>
    <pre>
    <form action="savebooks.php" method="POST" enctype="multipart/form-data">
    ISBN: <input type="text" name="ISBNno" /><br/>

    Title: <input type="text" name="Title" /><br/>

    Year of Publishing: <input type="text" name="YearOfPublishing" /><br/>

    Price: <input type="text" name="Price" /><br/>

    Medium: <input type="text" name="Medium" /><br/>

    Author: <select name="AuthorName">
    <?php 
      require_once('connection.php');
      $query = mysqli_query($conn, "select * from authors");
      if(mysqli_num_rows($query) > 0)
      {
            while($row = mysqli_fetch_array($query))
            {
              echo '<option name='.$row[1].' value='.$row[0].'>'.$row[1].'</option>';
            }            
          }
     
    ?>
    </select><br/>

    Category: <select name="CategoryName">
    <?php 
      require_once('connection.php');
      $query = mysqli_query($conn, "select * from categories");
      if(mysqli_num_rows($query) > 0)
      {
            while($row = mysqli_fetch_array($query))
            {
              echo '<option name='.$row[0].' value='.$row[0].'>'.$row[0].'</option>';
            }            
          }
      
    ?>
    </select><br/>

    Sub-Category: <select name="SubCategoryName">
    <?php 
      require_once('connection.php');
      $query = mysqli_query($conn, "select * from subcategories");
      if(mysqli_num_rows($query) > 0)
      {
            while($row = mysqli_fetch_array($query))
            {
              echo '<option name='.$row[0].' value='.$row[0].'>'.$row[0].'</option>';
            }            
          }
      
    ?>
    </select><br/>

    Image: <input type="file" name="file1" /><br/>
		<input type="submit" name="Save" value="Save">
		
	</form>
<?php 
require_once('connection.php');
if(isset($_POST["SearchBookButton"]))
          {
          $searchText = $_POST["searchBook"];
          $query = mysqli_query($conn, "select b1.ISBNno, b1.Title, b2.author, b3.Category, b3.SubCategory, b1.Price, b1.Image from books b1, books_has_authors b2, book_has_categories b3, authors a WHERE b1.ISBNno=b2.book AND b2.book=b3.book AND b1.ISBNno=b3.book AND a.authorID=b2.author AND (b1.Title LIKE '{$searchText}%' OR a.name LIKE '{$searchText}%')");
          	if(mysqli_num_rows($query) > 0)
          	{
          	echo '<table border=1>';
          	echo '<tr bordercolor=black>';
          	echo '<th bordercolor=black>ISBN</th>';
            echo '<th bordercolor=black>Image</th>';
          	echo '<th bordercolor=black>Title</th>';
          	echo '</tr>';
          	while($row = mysqli_fetch_array($query))
          	{
          		echo '<tr bordercolor=black>';
          		echo '<td bordercolor=black>'.$row[0].'</td>';
              echo "<td bordercolor=black><img src='images/$row[6]' width='60px' height='100px'></img></td>";
          		echo '<td bordercolor=black>'.$row[1].'</td>';
              echo '<td><form action="editbooks.php" method="POST"><input type="hidden" name="ISBN" value="'.$row[0].'"/><input type="submit" name="Edit" value="Edit"></form> </td>';
              
	      echo '<td><button value="showAlert" onclick="showAlert();">View</button>

    <div class="container" style="display:none;" id="myAlert">
        <div class="alert alert-success alert-dismissable" id="myAlert2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             ISBN='.$row[0].' Title='.$row[1].' Author='.$row[2].' Category='.$row[3].' Sub-Category='.$row[4].' Price='.$row[5].'
        </div>

    </div></td>';
		echo '<td><form action="deletebooks.php" method="POST"><input type="hidden" name="ISBN" value="'.$row[0].'"/><input type="submit" name="Delete" value="Delete"></form></td>';

          		echo '</tr>';          	
		}
          	echo '</table>';           
          }
          mysqli_close($conn);
        }
else
{
$query = mysqli_query($conn, "select b1.ISBNno, b1.Title, b2.author, b3.Category, b3.SubCategory, b1.Price, b1.Image from books b1, books_has_authors b2, book_has_categories b3 WHERE b1.ISBNno=b2.book AND b2.book=b3.book AND b1.ISBNno=b3.book");
          	if(mysqli_num_rows($query) > 0)
          	{
          	echo '<table border=1>';
          	echo '<tr bordercolor=black>';
          	echo '<th bordercolor=black>ISBN</th>';
            echo '<th bordercolor=black>Image</th>';
          	echo '<th bordercolor=black>Title</th>';
          	echo '</tr>';
          	while($row = mysqli_fetch_array($query))
          	{
          		echo '<tr bordercolor=black>';
          		echo '<td bordercolor=black>'.$row[0].'</td>';
              echo "<td bordercolor=black><img src='images/$row[6]' width='60px' height='100px'></img></td>";
          		echo '<td bordercolor=black>'.$row[1].'</td>';
              echo '<td><form action="editbooks.php" method="POST"><input type="hidden" name="ISBN" value="'.$row[0].'"/><input type="submit" name="Edit" value="Edit"></form> </td>';
              
	      echo '<td><button value="showAlert" onclick="showAlert();">View</button>

    <div class="container" style="display:none;" id="myAlert">
        <div class="alert alert-success alert-dismissable" id="myAlert2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             ISBN='.$row[0].' Title='.$row[1].' Author='.$row[2].' Category='.$row[3].' Sub-Category='.$row[4].' Price='.$row[5].'
        </div>

    </div></td>';
		echo '<td><form action="deletebooks.php" method="POST"><input type="hidden" name="ISBN" value="'.$row[0].'"/><input type="submit" name="Delete" value="Delete"></form></td>';

          		echo '</tr>';          	
		}
          	echo '</table>';
          	
          }
         }

?>
  </pre>
	</div>
</body>
</html>