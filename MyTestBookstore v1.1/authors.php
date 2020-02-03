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
	<title>Authors</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

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
    <pre>
		<form action="saveauthors.php" method="POST">
		Author: <input type="text" name="AuthorName" /><br/>
		Country: <input type="text" name="country" /><br/>
		<input type="submit" name="Save" value="Save">
		<?php 
		require_once('connection.php');
          $query = mysqli_query($conn, "select * from authors");
          if(mysqli_num_rows($query) > 0)
          {
          	echo '<table border=1>';
          	echo '<tr bordercolor=black>';
          	echo '<th bordercolor=black>Author ID</th>';
          	echo '<th bordercolor=black>Name</th>';
          	echo '<th bordercolor=black>Country</th>';
          	echo '</tr>';
          	while($row = mysqli_fetch_array($query))
          	{
          		echo '<tr bordercolor=black>';
          		echo '<td bordercolor=black>'.$row[0].'</td>';
          		echo '<td bordercolor=black>'.$row[1].'</td>';
          		echo '<td bordercolor=black>'.$row[2].'</td>';
          		echo '</tr>';
          	}
          	echo '</table>';
		
          	
          }
          mysqli_close($conn);
		?>
	</form>
</pre>
	</div>
</body>
</html>