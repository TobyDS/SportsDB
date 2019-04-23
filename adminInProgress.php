<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Creates connection to database
include_once('connection.php');

// Imports session variables
session_start();
if( ($_SESSION['role']) != 2 ){
  header('Location:login.php');
}

print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset="UTF-8">
  <title>Register exporting</title>

  <!--- Link to CDN for Bootstrap 4, jQuery and DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>

</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:#606060">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="admin.php">Oundle School Sports Database</a>

    <!-- Links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="#">Sports</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="#">Options</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="#">Students</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="#">Choices</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="#">Years</a>
      </li>
      <form action="process.php" class="mb-0 pl-2" method="post">
         <div class="text-center">
           <input type="submit" class="btn btn-primary btn-sx" value="Logout">
         </div>
      </form>
    </ul>
  </nav>

  <div class="container col-md-12 pt-5">
      <h1 style="font: Helvetica; font-weight: normal; font-size: 230%">Administrator Control Panel</h1>
      <hr>
      <div class="row">
          <div class="col-sm-3" style="height: 140px;">
              <!-- Sports Box -->
              <a href="" style="width: 100%; height: 100%;">
                  <div id="Sport" href="" class=" h-100 px-0" style="background-color: #167acc; border-radius: 10px;">
                      <h3 class="text-white" style="float: left; position: absolute; top: 30%; left: 5%; transform: translate(-10%, -40%); margin:15px;">Sports</h3>
                      <p class="text-white" style="float: right; position: absolute; top: 15%; left: 78%; transform: translate(-50%, -10%);">You have</p>
                      <h3 class="text-white" style="float: right; position: absolute; top: 40%; left: 83%; transform: translate(-50%, -40%);">18</h3>
                      <p class="text-white" style="float: right; position: absolute; top: 63%; left: 81%; transform: translate(-50%, -40%);">Sports</p>
                      <div style="background-color: white; border:solid #167acc; border-radius: 10px; border-top-right-radius: 0px; border-top-left-radius: 0px; border-width:1px; position: absolute; bottom: 0; width: 92.8%;">
                          <p style="float: left; margin:5px; padding-left: 10px; font-size: 75%;">Manage Them</p>
                      </div>
                  </div>
              </a>

          </div>
          <div class="col-sm-3" style="height: 140px;">
              <!-- Options Box -->
              <a href="" style="width: 100%; height: 100%;">
                  <div class=" h-100 px-0" style="margin-left:5px; background-color: #5bba4a; border-radius: 10px;">
                      <h3 class="text-white" style="float: left; position: absolute; top: 30%; left: 5%; transform: translate(-10%, -40%); margin:15px;">Options</h3>
                      <p class="text-white" style="float: right; position: absolute; top: 15%; left: 78%; transform: translate(-50%, -10%);">You have</p>
                      <h3 class="text-white" style="float: right; position: absolute; top: 40%; left: 83%; transform: translate(-50%, -40%);">18</h3>
                      <p class="text-white" style="float: right; position: absolute; top: 63%; left: 81%; transform: translate(-50%, -40%);">Options</p>
                      <div style="background-color: white; border:solid #5bba4a; border-radius: 10px; border-top-right-radius: 0px; border-top-left-radius: 0px; border-width:1px; position: absolute; bottom: 0;width: 91.6%;">
                          <p style="float: left; margin:5px; padding-left: 10px; font-size: 75%;">Manage Them</p>
                      </div>
                  </div>
              </a>
          </div>
      </div>
  </div>

</body>
</html>
