<?php #include("dataconnection.php"); ?>

<html>
<head><title>Movie List</title>
<link href="design.css" type="text/css" rel="stylesheet" />


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
if (isset($_REQUEST["movid"]))
{
	$movid = $_REQUEST["movid"];
	mysqli_query($connect, "DELETE FROM movie WHERE movie_id = $movid");
	header("Location: movie_list.php");
}
?>