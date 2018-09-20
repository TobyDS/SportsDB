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
      echo nl2br("Database dropped successfully\n");
  } else {
      echo nl2br("Error dropping database: " . $conn->error."\n");
  }

  $conn->close();
  ?>
  <input type="button" onclick="location.href='databasecreate.php';" value="CreateDB" />
</body>
</head>
</html>
