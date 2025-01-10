<?php #include("dataconnection.php"); ?>

<html>
<head><title>Movie List</title>
<link href="design.css" type="text/css" rel="stylesheet" />

<script type="text/javascript">

//create a javascript function named confirmation()
function confirmation(){
	answer = confirm("Do you want to delete this movie?");
	return answer;
}
</script>


</head>
<body>
<?php include('rds.conf.php'); ?>
<div id="wrapper">

	<div id="left">
		<?php include("menu1.php"); ?>
	</div>
	
	<div id="right">

		<h1>List of Movies</h1>

		<table border="1">
			<tr>
				<th>Movie ID</th>
				<th>Movie Title</th>
				<th>Movie Ticket Price</th>
				<th colspan="3">Action</th>
			</tr>
			
			<!--copy the code from movie_list(edit) and add on the delete hyperlink-->
			<?php
			mysqli_select_db($connect, "cinema");
			$result = mysqli_query($connect, "SELECT * FROM movie");	
			$count = mysqli_num_rows($result);//used to count number of rows
			
			while($row = mysqli_fetch_assoc($result))
			{
			
			?>			

			<tr>
				<td><?php echo $row["movie_id"]; ?></td>
				<td><?php echo $row["movie_title"]; ?></td>
				<td><?php echo $row["movie_ticket_price"]; ?></td>
				<td><a href="movie_detail.php?view&movid=<?php echo $row['movie_id']; ?>">More Details</a></td>
				<td><a href="movie_edit.php?edit&movid=<?php echo $row['movie_id']; ?>">Edit</a></td>
				<td><a href="movie_list.php?del&movid=<?php echo $row['movie_id']; ?>" onclick="return confirmation();">Delete</a></td>
			</tr>
			<?php
			
			}
			
			?>
		</table>


		<p> Number of records : <?php echo $count; ?></p>

	</div>
	
</div>


</body>
</html>
<?php

if (isset($_REQUEST["del"])) 
{
	$movid = $_REQUEST["movid"];
	mysqli_query($connect, "DELETE FROM movie WHERE movie_id = $movid");
	
	header("Location: movie_list.php"); //refresh the page
}

?>
