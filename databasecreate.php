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
      echo "Database created successfully";
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
  address VARCHAR(20) PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  house CHAR(3) NOT NULL,
  sex enum('M','F') DEFAULT 'M' NOT NULL,
  year enum('1','2','3','4','5','6','7') DEFAULT '1' NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo "Table MyGuests created successfully";
  } else {
      echo "Error creating table: " . $conn->error;
  }

  $conn->close();
  ?>
</body>
</head>
</html>
