<?php
session_start();
print_r($_SESSION);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

    <!--- Link to CDN for Bootstrap 4, jQuery and DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>

</head>
<body>

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
