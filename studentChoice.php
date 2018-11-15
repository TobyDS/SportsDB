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
if( !isset($_SESSION['username']) ){
  header('Location:login.php');
}

print_r($_SESSION);
?>
<!DOCTYPE html>
  <html>

  <title>Choices</title>

  <!--- Link to CDN for Bootstrap 4, jQuery and DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>

  <body>
    <div class='container col-md-8 rounded p-5 mt-5 border'>
      <h2 class='text-center'>Oundle School Sports Database</h2>
      <h4 class='pt-4'><?php echo 'Welcome: '.$_SESSION['name'] ?></h4>
      <h5 class='pt-2'>Please fill all forms</h5>
      <form action="postChoice.php" method ="post">
        <div class='py-2 row'>
          <div class='col-md-4'>
            <select name="term1sport" id='select1' class='custom-select'>
            <option value=" " selected disabled>Please select a first term sport...</option>
            <?php
            try{
              $stmt = $conn->prepare(
                "SELECT DISTINCT c.Choice_ID, s.Name
                From Sports AS s INNER JOIN Choices As c
                ON c.Sport_ID = s.Sport_ID INNER JOIN Year As y
                ON y.Year_ID = c.Year_ID
                Where y.Code Like CONCAT('%', :year, '%') AND
                c.Current = 'Y' AND
                c.Sex IN (:sex, 'B') AND
                c.Term_ID = 1 ORDER BY Name ASC");
              $stmt->bindParam(':year', $_SESSION['year']);
              $stmt->bindParam(':sex', $_SESSION['sex']);
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                echo("<option value='".$row['Choice_ID']."'>".$row['Name']."</option>");
              }
            }
            catch(PDOException $e)
            {
              echo "error".$e->getMessage();
            }
            ?>
        	  </select>
          </div>
          <div class='col-md-4'>
            <select name="term2sport" id='select2' class='custom-select'>
            <option value=" " selected disabled>Please select a second term sport...</option>
            <?php
            try{
              $stmt = $conn->prepare(
                "SELECT DISTINCT c.Choice_ID, s.Name
                From Sports AS s INNER JOIN Choices AS c
                ON c.Sport_ID = s.Sport_ID INNER JOIN Year AS y
                ON y.Year_ID = c.Year_ID
                Where y.Code Like CONCAT('%', :year, '%') AND
                c.Current = 'Y' AND
                c.Sex IN (:sex, 'B') AND
                c.Term_ID = 2 ORDER BY Name ASC");
              $stmt->bindParam(':year', $_SESSION['year']);
              $stmt->bindParam(':sex', $_SESSION['sex']);
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                echo("<option value='".$row['Choice_ID']."'>".$row['Name']."</option>");
              }
            }
            catch(PDOException $e)
            {
              echo "error".$e->getMessage();
            }
            ?>
        	  </select>
          </div>
          <div class='col-md-4'>
            <select name="term3sport" id='select3' class='custom-select'>
            <option value=" " selected disabled>Please select a third term sport...</option>
            <?php
            try{
              $stmt = $conn->prepare(
                "SELECT DISTINCT c.Choice_ID, s.Name
                From Sports AS s INNER JOIN Choices As c
                ON c.Sport_ID = s.Sport_ID INNER JOIN Year As y
                ON y.Year_ID = c.Year_ID
                Where y.Code Like CONCAT('%', :year, '%') AND
                c.Current = 'Y' AND
                c.Sex IN (:sex, 'B') AND
                c.Term_ID = 3 ORDER BY Name ASC");
              $stmt->bindParam(':year', $_SESSION['year']);
              $stmt->bindParam(':sex', $_SESSION['sex']);
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                echo("<option value='".$row['Choice_ID']."'>".$row['Name']."</option>");
              }
            }
            catch(PDOException $e)
            {
              echo "error".$e->getMessage();
            }
            ?>
        	  </select>
          </div>
        </div>
        <div class='py-2 row'>
          <div class='col-md-12'>
            <input class='btn btn-success float-right'type="submit" value="Submit Choices">
          </div>
        </div>
      </form>

      <div class="collapse" id='testid'>
        <h6>Success</h6>
      </div>
      <div>
        <!-- Circus T1 code -->
      </div>
      <div>
        <!-- Circus T2 code -->
      </div>
      <div>
        <!-- Circus T3 code -->
      </div>

      <div>
        <!-- Rules and stuff go here -->
      </div>


      <form action="process.php" method="post" class='col-md-12'>
         <div class="text-center col-md-12">
           <input type="submit" class="btn btn-primary btn-sx" value="Logout">
         </div>
      </form>
    </div>
    <?php

    $stmt=$conn->prepare('SELECT COUNT(1) FROM Student_Choices JOIN Current_DB ON DB_Year = DB WHERE Username = :username');
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    {
    //Now to check, we use an if() statement
    if($row['COUNT(1)'] >= 1) {
      $stmt = $conn->prepare(
        "SELECT st.Name AS student, st.House AS house,
        (CASE WHEN st.Year = 6 THEN 'L6' WHEN st.Year = 7 THEN 'U6' ELSE st.Year END) as year,
        c1.Choice_ID AS T1, c2.Choice_ID AS T2, c3.Choice_ID AS T3
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
        Where sc.Username = :username
        ");
      $stmt->bindParam(':username', $_SESSION['username']);
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<script>';
        echo 'document.getElementById("select1").value='.$row['T1'].';';
        echo 'document.getElementById("select1").disabled=true;';
        echo 'document.getElementById("select2").value='.$row['T2'].';';
        echo 'document.getElementById("select2").disabled=true;';
        echo 'document.getElementById("select3").value='.$row['T3'].';';
        echo 'document.getElementById("select3").disabled=true;';
        echo '</script>';
        }
      }
    }
    ?>
  </body>
</html>
