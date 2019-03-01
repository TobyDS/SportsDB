<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Creates connection to database
include_once('connection.php');

// Imports session variables
session_start();
if( ($_SESSION['role']) == 0 ){ /* Change into role = teacher or admin*/
  header('Location:login.php');
}

// Shows contense of session for testing (REMOVE!!!)
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
  <!-- Open a div to contian the table and Filters -->
  <div class='container-fluid rounded border col-md-11 py-5' style='margin-top: 20px'>
    <div class='container-fluid col-md-8 text-center border rounded mb-3 pt-3'>
      <h5 class='text-left'>Please select filters if you wish to filter your results:</h5>
      <div class='row'>
        <div class='col-md-2 text-left mr-3'>
          <h6>Sport:</h6>
        </div>
        <div class='col-md-2 text-left mr-3'>
          <h6>Term:</h6>
        </div>
        <div class='col-md-2 text-left mr-3'>
          <h6>Sex:</h6>
        </div>
        <div class='col-md-2 text-left mr-3'>
          <h6>Year:</h6>
        </div>
        <div class='col-md-2 text-left mr-3'>
          <h6>House:</h6>
        </div>
      </div>

      <form class='form-group container row'>
        <select class='form-control-sm col-md-2 mr-4' id="filter_sport">
          <option value="">Not Set</option>
          <?php
            try{
              $stmt = $conn->prepare("SELECT * FROM Sports ORDER BY Name ASC");
              $stmt->execute();
              while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['Sport_ID'].'">'.$row['Name'].'</option>';
              }
            }
            catch(PDOException $e)
            {
              echo "error".$e->getMessage();
            }
          ?>
        </select>

        <select class='form-control-sm col-md-2 mr-4' id="filter_term">
          <option value="">Not Set</option>
          <?php
            try{
              $stmt = $conn->prepare("SELECT * FROM Term");
              $stmt->execute();
              while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'.$row['Term_ID'].'">'.$row['Name'].'</option>';
              }
            }
            catch(PDOException $e)
            {
              echo "error".$e->getMessage();
            }
          ?>
        </select>

        <select class='form-control-sm col-md-2 mr-4' id="filter_sex">
          <option value="">Not Set</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>

        <select class='form-control-sm col-md-2 mr-4' id="filter_year">
          <option value="" >Not Set</option>
          <option value="1" >1st Form</option>
          <option value="2" >2nd Form</option>
          <option value="3" >3rd Form</option>
          <option value="4" >4th Form</option>
          <option value="5" >5th Form</option>
          <option value="6" >L6th Form</option>
          <option value="7" >U6th Form</option>
          <option value="9" >6th Form</option>
          <option value="8" >1st and 2nd Form</option>
          <option value="13" >3rd - U6th</option>
          <option value="11" >4th - U6th</option>
          <option value="12" >5th - U6th</option>
        </select>

        <select class='form-control-sm col-md-2 mr-4' id="filter_house">
          <option value="">Not Set</option>
          <option value="B" >Bramston</option>
          <option value="" >Berrystead</option>
          <option value="C" >Crosby</option>
          <option value="D" >Dryden</option>
          <option value="F" >Fisher</option>
          <option value="G" >Grafton</option>
          <option value="K" >Kirkeby</option>
          <option value="Ldr" >Laundimer</option>
          <option value="L" >Laxon</option>
          <option value="N" >New House</option>
          <option value="Sn" >Sanderson</option>
          <option value="Sc" >School House</option>
          <option value="S" >Sidney</option>
          <option value="" >Scott House</option>
          <option value="StA" >St Anthony</option>
          <option value="W" >Wyatt</option>
        </select>
      </form>
    </div>

    <div class="row">
      <!-- Sets the width of the div contianing table -->
      <div class="col-md-8 mx-auto border rounded py-3 mb-3">
        <table class="table table-bordered table-hover" id='register_data'>
          <!-- Contians the headdings of the table -->
          <thead>
            <tr>
              <td width="20%">Name</td>
              <td width="10%">House</td>
              <td width="10%">Year</td>
              <?php
                try{
                  $stmt = $conn->prepare("SELECT * FROM Term");
                  $stmt->execute();
                  while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<td width="20%">'.$row['Name'].' Sport</td>';
                  }
                }
                catch(PDOException $e)
                {
                  echo "error".$e->getMessage();
                }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php
              ini_set("display_errors", 1);
              // SQL Statment that looks up each records name, house, year and sports options
              try{
                $stmt = $conn->prepare(
                  "SELECT st.Name AS student, st.House AS house,
                  (CASE WHEN st.Year = 6 THEN 'L6' WHEN st.Year = 7 THEN 'U6' ELSE st.Year END) as year,
                  T1.Name AS T1, T2.Name AS T2, T3.Name AS T3
                  From Students AS st
                  INNER JOIN Student_Choices AS sc
                  ON st.Username = sc.Username INNER JOIN Current_DB AS db
                  ON sc.DB_year = db.DB
                  INNER JOIN Choices AS c1
                  ON sc.T1_Choice = c1.Choice_ID
                  INNER JOIN Sports AS T1
                  ON c1.Sport_ID = T1.Sport_ID
                  INNER JOIN Choices AS c2
                  ON sc.T2_Choice = c2.Choice_ID
                  INNER JOIN Sports AS T2
                  ON c2.Sport_ID = T2.Sport_ID
                  INNER JOIN Choices AS c3
                  ON sc.T3_Choice = c3.Choice_ID
                  INNER JOIN Sports AS T3
                  ON c3.Sport_ID = T3.Sport_ID
                  ");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  // echos the values found into the array for each row
                  echo '<tr>
                  <td>'.$row['student'].'</td>
                  <td>'.$row['house'].'</td>
                  <td>'.$row['year'].'</td>
                  <td>'.$row['T1'].'</td>
                  <td>'.$row['T2'].'</td>
                  <td>'.$row['T3'].'</td>
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
    <form action="process.php" method="post">
       <div class="text-center">
         <input type="submit" class="btn btn-primary btn-sx" value="Logout">
       </div>
    </form>
  </div>
<!-- Calls a fuction which contains the tables id which makes it dynamic usingthe datatables CDN -->
<script>
document.querySelector('#filter_sport').addEventListener('change', function() {
    var selectedValue = this.options[this.selectedIndex].value;
    if (selectedValue) {
        var request = new XMLHttpRequest();
        request.open('GET', '/path/to/your/php-script.php?value=' + selectedValue, true);
        request.onload = function() {
            if (request.status >= 200 && request.status < 400) {
                var dropdownResult = document.querySelector('#dropdown-result');
                dropdownResult.innerHTML = request.responseText;
                dropdownResult.style.display = '';
            }
        };
        request.send();
    }
});
</script>
</div>
</body>
</html>
