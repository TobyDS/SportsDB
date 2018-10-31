<?php
include_once('connection.php');
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
        func();
    }
    function func()
    {
      $conn = mysqli_connect("localhost", "root", "", "SportsDB");
    }
?>
<!DOCTYPE html>
  <html>
  <title>Choices</title>
  <body>
    <h1>You have reached studentChoice</h1>
  </body>
</html>
