<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
if( !isset($_SESSION['username']) ){ /* Change into role = teacher or admin*/
  header('Location:login.php');
}

print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset="UTF-8">
  <title>Register exporting</title>
  <!--- Link to Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <!-- Link to jquery -->
  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <!-- Link to Data Tables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.css"/>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/r-2.2.2/datatables.min.js"></script>


</head>
<body>
  <div class='container-fluid' style='margin-top: 20px'>
    <div class="row">
      <div class="col-md-8 mx-auto">
        <table class="table table-bordered table-hover" id='register'>
          <thead>
            <tr>
              <td>Name</td>
              <td>T1_choice</td>
              <td>T2_choice</td>
              <td>T3_choice</td>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td>Name</td>
              <td>T1_choice</td>
              <td>T2_choice</td>
              <td>T3_choice</td>
            </tr>
          </tfoot>
          <tbody>
            <?php
              ini_set("display_errors", 1);
              try{
                $stmt = $conn->prepare(
                  "SELECT st.Name AS student, s.Name AS sport
                  From Sports AS s INNER JOIN Choices AS c
                  ON s.Sport_ID = c.Sport_ID INNER JOIN Student_Choices AS sc
                  ON sc.T1_Choice = c.Choice_ID INNER JOIN Students AS st
                  ON st.Username = sc.Username
                  ");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<tr>
                  <td>'.$row['student'].'</td>
                  <td>'.$row['sport'].'</td>
                  <td>'.$row['sport'].'</td>
                  <td>'.$row['sport'].'</td>
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
  </div>
<script type="text/javascript">
$('#register').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );
</script>
</body>
</html>
