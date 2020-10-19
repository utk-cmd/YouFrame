
<?php  
require_once "connect.php";
$errorMsg=$errorinput=$msg ="";
if(isset($_REQUEST['submit']))
{
 try{
 $comment = $_REQUEST["insert_text"];
 $image_file = $_FILES["insert_image"]["name"];
 $type = $_FILES["insert_image"]["type"];
 $size = $_FILES["insert_image"]["size"];
 $temp = $_FILES["insert_image"]["tmp_name"];

 $path = "upload/" .$image_file;
 if($type=="image/jpg" || $type=="image/jpeg"||$type=="image/png"||$type=="image/gif")
  {
    if(!file_exists($path))
    {
      if($size < 8000000)
      {
      move_uploaded_file($temp, "upload/" .$image_file);
      
      }  
      else{
      	
      $errorMsg = "<i class='fa fa-info-circle' aria-hidden='true'>"." Your filesize is more than 8mb"."</i>";
      $errorinput=$errorMsg;
      
      }
    }
    else{
      $errorMsg = "<i class='fa fa-info-circle' aria-hidden='true'>"." File already exists"."</i>";
      $errorinput=$errorMsg;

      }
  }
  else{

    $errorMsg = "<i class='fa fa-info-circle' aria-hidden='true'>"." Not in proper format ,files with extension of jpg,jpeg,png,gif are supported"."</i>";
      $errorinput=$errorMsg;

  }
 
  if(empty($errorMsg))
  {
    $sql = $conn->prepare('INSERT INTO imageupload(image,name)VALUES(:fimage,:fname)');
    $sql->bindParam(':fname',$comment);
    $sql->bindParam(':fimage',$image_file);
  
  if(!empty($sql->execute()))
  {


    $msg = "<i class='fa fa-check' aria-hidden='true'>"."Successfully Inserted. Redirecting to main page"."</i>";
    		header("refresh:2;index.php");
	    
  }
  }
  else{
    $errorinput=$errorMsg;
   
  }  
 }
 catch(PDOException $e){
  echo "<br>".$e->getMessage();
 }
} 

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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="mainpage.css">
	<link rel="stylesheet" href="upload.css">

</head>
	<body>
	<div class="row header">Gallery</div>

		<div class="container form_collection">
		<form method="post" enctype="multipart/form-data">
			<table>
				<tr>
			<div class="isa_error">
   			<?php echo "$errorinput"; ?>
			</div>
		    <div class="isa_success"><?php echo "$msg";?>
		    	
		    </div>
		</tr>
				<tr>
		<div class="form-group ">
		<td><label for="insert-image">Insert image: </label></td>
		<td><input type="file" name="insert_image" id="insert-image" required></td>
		
			
		
		</div>
		<br>
	</tr>
	<tr>
		<div class="form-group ">
		<td><label for="insert-name">Insert name: </label></td>
		<td><input type="text" name="insert_text" id="insert-name" autocomplete="off" required></td>
		<td></td>
		<br>
	</div>
	</tr>
	</table>
	<div class="buttons">
	<input type="Submit" name="submit" class="btn btn-primary" value="Submit">
	
	<a href="mainpage.php" class="btn btn-danger">Cancel</a>
	</div>
	</form>
	</div>
	<footer class="row footer">Fullstack Challenge - 2020</footer>

	</body>
</html>