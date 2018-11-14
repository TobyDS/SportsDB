<?php
$servername = "sql2.freemysqlhosting.net";
$username = "sql2265455";
$password = "xF8%pG6*";
$dbname = "sql2265455";
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
