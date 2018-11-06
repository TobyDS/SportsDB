<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);
  }
catch(PDOException $e)
{
  echo "error".$e->getMessage();
}
$conn=null;

session_start();

$_SESSION['username']= 'studnentTester.test';
$_SESSION['name'] = 'Tester';
$_SESSION['sex'] = $_POST['Sex'];
$_SESSION['year'] = $_POST['Year'];
header('Location:studentChoice.php');

?>
