<?php
$servername = "fdb23.awardspace.net";
$username = "2880778_sportsdb";
$password = "L@nhams1";
$dbname = "2880778_sportsdb";
try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
