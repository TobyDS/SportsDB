<!DOCTYPE html>
<html>
	<head>
		<body>
			<?php
  $servername = "sql2.freemysqlhosting.net";
  $username = "sql2265455";
  $password = "xF8%pG6*";
  $dbname = "sql2265455";

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
