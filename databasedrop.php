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
  $sql = "DROP DATABASE ".$dbname;
  if ($conn->query($sql) === TRUE) {
      echo "Database dropped successfully";
  } else {
      echo "Error dropping database: " . $conn->error;
  }

  $conn->close();
  ?>
</body>
</head>
</html>
