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
    <form action="" method ="post">
      <select name="term1sport">
      <option value=" " selected disabled>Please select a first term sport...</option>
      <?php
      include_once('connection.php');
      $stmt = $conn->prepare("SELECT * FROM Year Where Code Like '%".$_SESSION['year']."%' ");
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $stmt1 = $conn->prepare("SELECT * FROM Choices Where Current='Y' AND (Sex='".$_SESSION['sex']."' OR Sex='B') AND Term_ID='1' AND Year_ID=".$row['Year_ID']."   ");
        $stmt1->execute();
        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
        {
          //echo("<option value='".$row1['Sport_ID']."'>".$row1['Sport_ID']."</option>");
          $stmt2 = $conn->prepare("SELECT DISTINCT * FROM Sports Where Sport_ID='".$row1['Sport_ID']."' ORDER BY Name ASC");
          $stmt2->execute();
          while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
          {
            echo("<option value='".$row1['Choice_ID']."'>".$row2['Name']."</option>");
          }
        }
      }
      ?>
  	  </select>
      <select name="term2sport">
      <option value=" " selected disabled>Please select a second term sport...</option>
      <?php
      try{
        $stmt = $conn->prepare("
        SELECT DISTINCT c.ChoiceID, s.Name
        FROM Sports AS s
        JOIN Choices AS c ON s.Sport_ID = c.Sport_ID
        JOIN Year AS y ON y.Year_ID = c.Year_ID
        WHERE y.Code LIKE CONCAT('%', :year, '%')
        AND c.Current = 'Y'
        AND c.Sex in (:sex, 'B')
        AND c.Term_ID = '1'
        ORDER BY s.Name");
        $stmt1->bindParam(':year', $_SESSION['year']);
        $stmt2->bindParam(':sex', $_SESSION['sex']);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
      <!-- Code to populate dropdown -->
  	  </select>
    </form>


    <form action="process.php" method="post">
      <input type="submit" value="Logout">
    </form>
  </body>
</html>
