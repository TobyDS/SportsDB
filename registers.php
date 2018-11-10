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
if( ($_SESSION['role']) == 0 ){ /* Change into role = teacher or admin*/
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


</head>
<body>
  <div class='container-fluid' style='margin-top: 20px'>
    <div class="row">
      <div class="col-md-8 mx-auto">
        <table class="table table-bordered table-hover" id='register'>
          <thead>
            <tr>
              <td>Name</td>
              <td>House</td>
              <td>Year</td>
              <td>Term 1 Sport</td>
              <td>Term 2 Sport</td>
              <td>Term 3 Sport</td>
            </tr>
          </thead>
          <tbody>
            <?php
              ini_set("display_errors", 1);
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
  </div>
<script type="text/javascript">
$('#register').DataTable( {
    'dom': 'Bfrtip',
    'buttons': [{
      extend: 'copy'
    },
    {
      extend: 'excel'
    },
    {
      extend: 'pdf',
      title: 'Oundle School Sports Database',
      download: 'open',
      customize: function (doc) {
        doc.content[1].table.widths =
        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
      },
    },
    {
      extend: 'print',
      title: 'Oundle School Sports Database',
      messageTop: 'This is a list of all pupils sports options',
      footer: false,
      header: false
    }
    ]
    } );
</script>

  <form action="process.php" method="post">
     <div class="text-center">
       <input type="submit" class="btn btn-primary btn-sx" value="Logout">
     </div>
  </form>

</div>
</body>
</html>