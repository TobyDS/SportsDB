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

header('Location:studentChoice.php');
?>
