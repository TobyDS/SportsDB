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
//print_r($_SESSION);
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
          <option value="NULL">Not Set</option>
          <?php
          include_once('connection.php');
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
          <option value="NULL">Not Set</option>
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
          <option value="NULL">Not Set</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>

        <select class='form-control-sm col-md-2 mr-4' id="filter_year">
          <option value="NULL" >Not Set</option>
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
          <option value="NULL">Not Set</option>
          <option value="B" >Bramston</option>
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
          <option value="Sco" >Scott House</option>
          <option value="S" >Sidney</option>
          <option value="StA" >St Anthony</option>
          <option value="By" >Berrystead</option>
          <option value="W" >Wyatt</option>
        </select>
      </form>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto border rounded py-3 mb-3">
          <table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th width="20%">Name</th>
                <th width="10%">House</th>
                <th width="10%">Year</th>
                <?php
                  try{
                    $stmt = $conn->prepare("SELECT * FROM Term");
                    $stmt->execute();
                    while ($row =$stmt->fetch(PDO::FETCH_ASSOC)){
                      echo '<th width="20%">'.$row['Name'].' Sport</th>';
                    }
                  }
                  catch(PDOException $e)
                  {
                    echo "error".$e->getMessage();
                  }
                ?>
              </tr>
              </thead>
          </table>
        </div>
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
    $(document).ready(function(){
        var dataTable=$('#example').DataTable({
          "processing": true,
          "serverSide":true,
          lengthMenu: [[10, 25, 100, 5000], [10, 25, 100, "All"]],
          pageLength: 10,
          "ajax":{
            url:"fetch.php",
            type:"post",
            "data": function ( d ) {
            d.filter_sport = $('#filter_sport').val();
            d.filter_term = $('#filter_term').val();
            d.filter_sex = $('#filter_sex').val();
            d.filter_year = $('#filter_year').val();
            d.filter_house = $('#filter_house').val();
          },
          dataType: 'json',
          },
          'dom': 'Bfrtipl',
          'buttons': [
            {
              "text" : 'Email'
          },
          {
          extend: 'excel',
          },
          {
            extend: 'pdf',
            orientation: 'landscape',
            title: 'Oundle School Student Sports Options',
            download: 'open',
            // Function to automatically size and center each collumn in export
            customize: function (doc) {
              doc.content[1].table.widths =
              Array(doc.content[1].table.body[0].length + 1).join('*').split('');

              var rowCount = doc.content[1].table.body.length;
              for (i = 1; i < rowCount; i++) {
                doc.content[1].table.body[i][0].alignment = 'center';
                doc.content[1].table.body[i][1].alignment = 'center';
                doc.content[1].table.body[i][2].alignment = 'center';
                doc.content[1].table.body[i][3].alignment = 'center';
                doc.content[1].table.body[i][4].alignment = 'center';
                doc.content[1].table.body[i][5].alignment = 'center';
              };
            },
          },
          ]
        });
    });
    $(document).ready(function()
    {
      $("#filter_sport").on('change',function(){
        $('#example').DataTable().ajax.reload()
      });
    });
    $(document).ready(function()
    {
      $("#filter_term").on('change',function(){
        $('#example').DataTable().ajax.reload()
      });
    });
    $(document).ready(function()
    {
      $("#filter_sex").on('change',function(){
        $('#example').DataTable().ajax.reload()
      });
    });
    $(document).ready(function()
    {
      $("#filter_year").on('change',function(){
        $('#example').DataTable().ajax.reload()
      });
    });
    $(document).ready(function()
    {
      $("#filter_house").on('change',function(){
        $('#example').DataTable().ajax.reload()
      });
    });
</script>

</div>
</body>
</html>
