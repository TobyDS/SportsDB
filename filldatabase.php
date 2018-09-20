<?php
include_once('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
        func();
    }
    function func()
    {
      $conn = mysqli_connect("localhost", "root", "", "SportsDB");
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
