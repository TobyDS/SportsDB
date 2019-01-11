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
    <script src="js/script.js"></script>

</head>
<body>

<div class='container-fluid col-md-3 rounded p-5 mt-5 border'>
  <form action="Authentication.php" method ="post">
    <h3 class='text-center' style="font-size:2vw;">Please Login</h3>
    <h5 class='pt-3 flexFont'>Enter Username and Password</h5>
    <div class="form-group mb-0">
      <input class='form-control float-left mt-3 mb-1 flexFont' placeholder="Username" type="text" name="username"><br>
      <input class='form-control float-left mb-3 flexFont' placeholder="Password" type="password" name="password"><br>
    </div>
    <div class="text-center">
      <input type="submit" class='btn btn-primary btn-sx'  style="font-size:1vw;" value="Login">
    </div>
  </form>
</div>

<div class='container col-md-2 rounded p-3 mt-5 border text-center'>
  <h6 class='flexFont'>Buttons for testing purposes:</h6>
   <div>
     <form action='Backdoor.php' method='post'>
       <div class='btn-group' role='group'>
         <button class='btn btn-secondary' style="font-size:0.75vw;" name='submit' value='0'>Student</button>
         <button class='btn btn-secondary' style="font-size:0.75vw;" name='submit' value='1'>Teacher</button>
         <button class='btn btn-secondary' style="font-size:0.75vw;" name='submit' value='2'>Admin</button>
       </div>
     </form>
   </div>
</div>

</body>
</html>
