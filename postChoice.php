<?php
header('Location:studentChoice.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
array_map("htmlspecialchars", $_POST);

include_once('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
        func();
    }
    function func()
    {
      $conn = mysqli_connect("localhost", "root", "", "SportsDB");
    }
session_start();
if( !isset($_SESSION['username']) ){
  header('Location:login.php');
}

try{
	$stmt = $conn->prepare("INSERT INTO Student_Choices (Username,T1_Choice,T2_Choice,T3_Choice,DB_Year)VALUES (:username,:t1choice,:t2choice,:t3choice,YEAR(NOW()))");
	$stmt->bindParam(':username', $_SESSION['username']);
	$stmt->bindParam(':t1choice', $_POST["term1sport"]);
  $stmt->bindParam(':t2choice', $_POST["term2sport"]);
  $stmt->bindParam(':t3choice', $_POST["term3sport"]);

	$stmt->execute();
	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;


?>
