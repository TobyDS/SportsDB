<!DOCTYPE html>
<html>
<head>
<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "SportsDB";

  // Create connection
  $conn = new mysqli($servername, $username, $password);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Create database
  $sql = "CREATE DATABASE ".$dbname;
  if ($conn->query($sql) === TRUE) {
      echo "Database created successfully \n";
  } else {
      echo "Error creating database: " . $conn->error;
  }

  $conn->close();

    // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // sql to create table
  $sql = "CREATE TABLE sl (
  Address VARCHAR(20) NOT NULL PRIMARY KEY UNIQUE,
  Name VARCHAR(30) NOT NULL,
  House CHAR(3) NOT NULL,
  Sex enum('M','F') DEFAULT 'M' NOT NULL,
  Year enum('1','2','3','4','5','6','7') DEFAULT '1' NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo "Table sl created successfully";
  } else {
      echo "Error creating table: " . $conn->error;
  }

  // sql to create table
  $sql = "CREATE TABLE Sports (
  Sport_ID INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(30) NOT NULL,
  HS_Name VARCHAR(30) NOT NULL,
  HS_Address VARCHAR(20) NOT NULL,
  Current enum('0','1') DEFAULT '1' NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo "Table Sports created successfully";
  } else {
      echo "Error creating table: " . $conn->error;
  }

  $conn->close();
  ?>
</body>
</head>
</html>
