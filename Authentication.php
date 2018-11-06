<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);

  $user= $_POST['username'];
	$stmt = $conn->prepare("SELECT * FROM Students where Username='$user'");
	$stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;

session_start();

if($row['Name']=='') {
     header('Location:login.php');
} else {
	$_SESSION['username']= $_POST['username'];
	$_SESSION['name'] = $row['Name'];
	$_SESSION['sex'] = $row['Sex'];
	$_SESSION['year'] = $row['Year'];
	header('Location:studentChoice.php');
}
?>
