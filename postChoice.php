<?php
header('Location:studentChoice.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
array_map("htmlspecialchars", $_POST);

//Creates connection to the database
include_once('connection.php');

//Imports session variables
session_start();
if( !isset($_SESSION['username']) ){
  header('Location:login.php');
}

try{
    // Get the current database year
    $stmt = $conn->prepare("SELECT DB FROM Current_DB");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $db = $row['DB'];
    }

    // Execute the insert statement
    $stmt = $conn->prepare(
        "INSERT INTO Student_Choices (Username, T1_Choice, T2_Choice, T3_Choice, DB_Year)
         VALUES (:username, :t1choice, :t2choice, :t3choice, :db)"
    );
    // Binds the post and session variables for the insert statement
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->bindParam(':t1choice', $_POST["term1sport"]);
    $stmt->bindParam(':t2choice', $_POST["term2sport"]);
    $stmt->bindParam(':t3choice', $_POST["term3sport"]);
    $stmt->bindParam(':db', $db);
    $stmt->execute();
	}
catch(PDOException $e)
	{
		echo "error".$e->getMessage();
	}
$conn=null;
?>
