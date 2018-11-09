<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
	session_start();

	if($_POST['submit']==0)      {header('Location:studentTester.php');}
	else if($_POST['submit']==1) {
		$_SESSION['username']= 'testTeacher.test';
		$_SESSION['name'] = 'Tester';
		$_SESSION['role'] = '1';
		header('Location:registers.php');
	}
	else if($_POST['submit']==2) {header('Location:studentChoice.php');}

  }
  catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;

session_start();
$_SESSION['username']= $_POST['username'];
$_SESSION['name'] = $row['Name'];
$_SESSION['sex'] = $row['Sex'];
$_SESSION['year'] = $row['Year'];
?>
