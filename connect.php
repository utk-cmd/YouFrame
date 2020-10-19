<?php  
$servername = "localhost";
$username = "ijdbuser";
$password = "Root@12345";
$dbname = "youframe";
try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $e){
echo "<br>".$e->getMessage();
}
?>