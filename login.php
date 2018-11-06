<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

</head>
<body>

<?php
session_start();
print_r($_SESSION);
?>

<div>
  <form action="Authentication.php" method ="post">
    <h3>Please Login</h3>
    <h4>Enter Username and Password</h4>
      <input placeholder="Username" type="text" name="username"><br>
      <input placeholder="Password" type="password" name="password"><br>
    <input type="submit" value="Login">
  </form>
</div>

<div>
  <form action='Backdoor.php' method='post'>
  <button name='submit' value='0'>Student</button>
  <button name='submit' value='1'>Teacher</button>
  <button name='submit' value='2'>Admin</button>
</form>
</div>

</body>
</html>
