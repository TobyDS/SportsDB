<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
	// Connects to database
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);

	//Username is Oundle School username
  $user= $_POST['username'];
	//Selects all records in students with given username
	$stmt = $conn->prepare("SELECT * FROM Students where Username='$user'");
	$stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}

$conn=null;

// Stars a session to set session variables
session_start();

// If record in the database doesn't exist the user is sent back
if($row['Name']=='') {
     header('Location:login.php');
} else {
	// If record exists set username, name, sex and year as session variables
	$_SESSION['username']= $_POST['username'];
	$_SESSION['name'] = $row['Name'];
	$_SESSION['sex'] = $row['Sex'];
	$_SESSION['year'] = $row['Year'];
	// Once set send user to student choices (Using firefly, set role!!!)
	header('Location:studentChoice.php');
}
?>
