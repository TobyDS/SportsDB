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
session_start();
if( !isset($_SESSION['username']) ){
  header('Location:login.php');
}

print_r($_SESSION);
?>
<!DOCTYPE html>
  <html>
  <title>Choices</title>
  <body>
    <h2>Oundle School Sports database</h2>
    <h3><?php echo 'Welcome '.$_SESSION['name'] ?></h4>
    <h4>Please fill all forms</h4>
    <form action="" method ="post">
      <select name="term1sport">
      <option value=" " selected disabled>Please select a first term sport...</option>
      <!-- Code to populate dropdown -->
  	  </select>
      <select name="term2sport">
      <option value=" " selected disabled>Please select a seconed term sport...</option>
      <!-- Code to populate dropdown -->
  	  </select>
      <select name="term3sport">
      <option value=" " selected disabled>Please select a third term sport...</option>
      <!-- Code to populate dropdown -->
  	  </select>
    </form>


    <form action="process.php" method="post">
      <input type="submit" value="Logout">
    </form>
  </body>
</html>
