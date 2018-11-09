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
