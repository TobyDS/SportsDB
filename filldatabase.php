<?php
include_once('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
        func();
    }
    function func()
    {
      $conn = mysqli_connect("localhost", "root", "", "SportsDB");

      // Reads sl.csv into Student table
      $file = fopen("csvs/sl.csv", "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          $sqlInsert = "INSERT into Students (Username,Name,House,Sex,Year)
                 values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "')";
          $result = mysqli_query($conn, $sqlInsert);
        }

        if (! empty($result)) {
            echo nl2br("Student CSV Data Imported into the Database \n");
        } else {
            echo "Problem in Importing CSV Data";
        }
      // Reads year.csv into Year table
      $file = fopen("csvs/year.csv", "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          $sqlInsert = "INSERT into Year (Year_ID,Code)
                 values ('" . $column[0] . "','" . $column[1] . "')";
          $result = mysqli_query($conn, $sqlInsert);
        }

        if (! empty($result)) {
            echo nl2br("Year CSV Data Imported into the Database \n");
        } else {
            echo "Problem in Importing CSV Data";
        }
      // Reads term.csv into Term table
      $file = fopen("csvs/term.csv", "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          $sqlInsert = "INSERT into Term (Name,Start_Date,End_Date)
                  values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "')";
          $result = mysqli_query($conn, $sqlInsert);
        }

        if (! empty($result)) {
            echo nl2br("Term CSV Data Imported into the Database \n");
        } else {
            echo "Problem in Importing CSV Data";
        }
      // Reads current.csv into Current_DB table
      $file = fopen("csvs/current.csv", "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          $sqlInsert = "INSERT into Current_DB (DB)
                  values ($column[0])";
          $result = mysqli_query($conn, $sqlInsert);
        }

        if (! empty($result)) {
            echo nl2br("CurrentDB CSV Data Imported into the Database \n");
        } else {
            echo "Problem in Importing CSV Data";
        }
      // Reads sports.csv into Sports table
      $file = fopen("csvs/sports.csv", "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          $sqlInsert = "INSERT into Sports (Name)
                  values ('".$column[0]."')";
          $result = mysqli_query($conn, $sqlInsert);
        }

        if (! empty($result)) {
            echo nl2br("Sports CSV Data Imported into the Database \n");
        } else {
            echo "Problem in Importing CSV Data";
        }
      // Reads choices.csv into Choices table
      $file = fopen("csvs/choices.csv", "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
          $sqlInsert = "INSERT into Choices (Sex,Term_ID,Year_ID,Sport_ID)
                  values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";
          $result = mysqli_query($conn, $sqlInsert);
        }

        if (! empty($result)) {
            echo nl2br("Choices CSV Data Imported into the Database \n");
        } else {
            echo "Problem in Importing CSV Data";
        }
  }
?>
<html>
<body>
  <form action="filldatabase.php" method="post">
      <input type="submit" name="someAction" value="Import CSV's" />
  </form>
  <input type="button" onclick="location.href='databasedrop.php';" value="DropDB" />
</body>

</html>
