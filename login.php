<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

</head>
<body>
  <form action="Authentication.php" method ="post">
    <h3>Please Login</h3>
    <h4>Enter Username and Password</h4>
      <input placeholder="Username" type="text" name="username"><br>
      <input placeholder="Password" type="password" name="password"><br>
    <input type="submit" value="Login">
  </form>
</div>

<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM Students");
$stmt->execute();
?>

</body>
</html>
