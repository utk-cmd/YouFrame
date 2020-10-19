<?php 
require "connect.php";
$sql = "SELECT * FROM imageupload ORDER BY id DESC";
?>



<!DOCTYPE html>
<html>
<head>
	<title>YouFrame</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">	</script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="mainpage.css">
</head>
<body>
<section>
	<div class="row header">Gallery</div>
	<div class="container">
	<div class ="row uploadbtn">
		<div class="uploadlink">
			<a href="upload.php" ><img src="icons/upload.svg" class="icon">
			Upload</a>
		</div>
	</div>
	<div class="grid-image">
	
		<?php 
		if($result = $conn->query($sql))
		{
		while($row = $result->fetch())
     	{
     	

		?>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 image-set">
			<img class="img-responsive preview-image" src="upload/<?php echo $row['image']; ?>" id="" >
			<div class="image-name"><?php echo $row['name'] ; ?></div>
		</div>
		<?php 
		}
		}
		?>
	
	</div>
	</div>

	<footer class="row footer">Fullstack Challenge - 2020</footer>

</section>
</body>
</html>