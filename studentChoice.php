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
    <h2>Oundle School Sports database</h2>
    <h3><?php echo 'Welcome '.$_SESSION['name'] ?></h4>
    <h4>Please fill all forms</h4>
    <form action="postChoice.php" method ="post">
      <select name="term1sport">
      <option value=" " selected disabled>Please select a first term sport...</option>
      <?php
      include_once('connection.php');
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
      <select name="term2sport">
      <option value=" " selected disabled>Please select a second term sport...</option>
      <?php
      include_once('connection.php');
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
      <select name="term3sport">
      <option value=" " selected disabled>Please select a third term sport...</option>
      <?php
      include_once('connection.php');
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
      <input type="submit" value="Submit Choices">
  	  </select>
    </form>


    <form action="process.php" method="post">
      <input type="submit" value="Logout">
    </form>
  </body>
</html>
