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
  <title>Admin Sports Editor</title>

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
        <a class="nav-link" style="background-color: black; color:white; font-weight: bold;" href="adminSports.php">Sports</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="adminOptions.php">Options</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="adminStudents.php">Students</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="adminChoices.php">Choices</a>
      </li>
      <li class="nav-item px-3">
        <a class="nav-link" style="color:white; font-weight: bold" href="adminYears.php">Years</a>
      </li>
      <form action="process.php" class="mb-0 pl-2" method="post">
         <div class="text-center">
           <input type="submit" class="btn btn-primary btn-sx" value="Logout">
         </div>
      </form>
    </ul>
  </nav>

  <div class="col-md-12 pt-5">
    <h1 style="font: Helvetica; font-weight: normal; font-size: 230%">Sports Manager</h1>
    <hr>
    <div class="text-center">
      <h1><u>Sports Table</u></h1>
    </div>
    <div class="row">
      <div class="col-md-8 mx-auto">
        <table class="table table-bordered table-hover" id='Sports'>
          <thead>
            <tr>
              <td>Sport</td>
              <td>Head of Sport</td>
              <td>Number Taking Sport</td>
              <td>Cap</td>
              <td>Current</td>
            </tr>
          </thead>
          <tbody>
            <?php
              ini_set("display_errors", 1);
              try{
                $stmt = $conn->prepare(
                  "SELECT Name, HS_Name,
                  CASE WHEN Cap IS NULL THEN 'None' END AS Cap,
                  CASE WHEN Current = 'Y' THEN 'Yes' ELSE 'No' END AS Current
                  FROM Sports;
                  ");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>
                  <td>'.$row['Name'].'</td>
                  <td>'.$row['HS_Name'].'</td>
                  <td>Blank</td>
                  <td>'.$row['Cap'].'</td>
                  <td>'.$row['Current'].'</td>
                  </tr>
                  ';
                }
              }
              catch(PDOException $e)
              {
                echo "error".$e->getMessage();
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <script type="text/javascript">
    $('#Sports').DataTable( {
        'dom': 'frtip',
        } );
    </script>
  </div>
  <div class="container">
    <div class="col-md-8 text-center mx-auto py-3">
      <form action='adminSportsRedirect.php' method='post'>
        <div class='btn-group' role='group'>
          <button class='btn btn-secondary' name='submit' value='0'>Manage Sports</button>
          <button class='btn btn-secondary' name='submit' value='1'>Add New Sports</button>

        </div>
      </form>
    </div>
  </div>
</body>

</body>
</html>
