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
      echo nl2br("Database created successfully \n");
  } else {
      echo nl2br("Error creating database: ".$conn->error."\n");
  }

  $conn->close();

    // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // sql to create table Students
  $sql = "CREATE TABLE Students (
  Username VARCHAR(20) NOT NULL PRIMARY KEY UNIQUE,
  Name VARCHAR(30) NOT NULL,
  House CHAR(3) NOT NULL,
  Sex enum('M','F') DEFAULT 'M' NOT NULL,
  Year enum('1','2','3','4','5','6','7') DEFAULT '1' NOT NULL,
  Current enum('Y','N') DEFAULT 'Y' NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Students created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  // sql to create table Sports
  $sql = "CREATE TABLE Sports (
  Sport_ID INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(30) NOT NULL,
  HS_Name VARCHAR(30) NOT NULL,
  HS_Address VARCHAR(20) NOT NULL,
  Current enum('Y','N') DEFAULT 'Y' NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Sports created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  // sql to create table Choices
  $sql = "CREATE TABLE Choices (
  Choice_ID INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Current enum('Y','N') DEFAULT 'Y' NOT NULL,
  Sex enum('M','F','B') NOT NULL,
  Term_ID INT(3) NOT NULL,
  Year_ID INT(3)  NOT NULL,
  Sport_ID INT(9) NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Choices created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  // sql to create table Term
  $sql = "CREATE TABLE Term (
  Term_ID INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(30) NOT NULL,
  Start_Date DATE NOT NULL,
  End_Date DATE NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Term created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  // sql to create table Year
  $sql = "CREATE TABLE Year (
  Year_ID INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Code VARCHAR(7) NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Year created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  // sql to create table Student_Choices
  $sql = "CREATE TABLE Student_Choices (
  Username VARCHAR(20) NOT NULL,
  T1_Choice INT(3) NOT NULL,
  T2_Choice INT(3) NOT NULL,
  T3_Choice INT(3) NOT NULL,
  DB_Year VARCHAR(5) NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Student_Choices created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  // sql to create table Current_DB
  $sql = "CREATE TABLE Current_DB (
  DB VARCHAR(5) NOT NULL
  )";

  if ($conn->query($sql) === TRUE) {
      echo nl2br("Table Current_DB created successfully\n");
  } else {
      echo nl2br("Error creating table: ".$conn->error."\n");
  }

  $conn->close();
  ?>
  <input type="button" onclick="location.href='databasedrop.php';" value="DropDB" />

</body>
</head>
</html>
