<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Creates connection to database
include_once('connection.php');

$username = array();
$sex = array();
$year = array();
$Term1 = array();
$Term2 = array();
$Term3 = array();

$stmt = $conn->prepare("SELECT st.Username, st.Sex, st.Year
FROM Students AS st
LEFT JOIN Student_Choices sc ON sc.Username = st.Username
WHERE sc.Username IS NULL");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  $username[] = $row['Username'];
  $sex[] = $row['Sex'];
  $year[] = $row['Year'];
};

$i=-1;
foreach($username as $user){
  $i++;
  $tempSex = $sex[$i];
  $tempYear = $year[$i];
  $stmt = $conn->prepare(
    "SELECT DISTINCT c.Choice_ID, s.Name
    From Sports AS s INNER JOIN Choices As c
    ON c.Sport_ID = s.Sport_ID INNER JOIN Year As y
    ON y.Year_ID = c.Year_ID
    Where y.Code Like CONCAT('%', :year, '%') AND
    c.Current = 'Y' AND
    c.Sex IN (:sex, 'B') AND
    c.Term_ID = 1 ORDER BY Name ASC");
  $stmt->bindParam(':year', $tempYear);
  $stmt->bindParam(':sex', $tempSex);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    //print_r($row['Choice_ID'].' ');
    $Term1[] = $row['Choice_ID'];
  }
  $targno = rand(0, sizeof($Term1) - 1);
  $T1_C = $Term1[$targno];
  unset($Term1);

  $stmt = $conn->prepare(
    "SELECT DISTINCT c.Choice_ID, s.Name
    From Sports AS s INNER JOIN Choices AS c
    ON c.Sport_ID = s.Sport_ID INNER JOIN Year AS y
    ON y.Year_ID = c.Year_ID
    Where y.Code Like CONCAT('%', :year, '%') AND
    c.Current = 'Y' AND
    c.Sex IN (:sex, 'B') AND
    c.Term_ID = 2 ORDER BY Name ASC");
  $stmt->bindParam(':year', $tempYear);
  $stmt->bindParam(':sex', $tempSex);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $Term2[] = $row['Choice_ID'];
  }
  $targno = rand(0, sizeof($Term2) - 1);
  $T2_C = $Term2[$targno];
  unset($Term2);

  $stmt = $conn->prepare(
    "SELECT DISTINCT c.Choice_ID, s.Name
    From Sports AS s INNER JOIN Choices As c
    ON c.Sport_ID = s.Sport_ID INNER JOIN Year As y
    ON y.Year_ID = c.Year_ID
    Where y.Code Like CONCAT('%', :year, '%') AND
    c.Current = 'Y' AND
    c.Sex IN (:sex, 'B') AND
    c.Term_ID = 3 ORDER BY Name ASC");
  $stmt->bindParam(':year', $tempYear);
  $stmt->bindParam(':sex', $tempSex);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $Term3[] = $row['Choice_ID'];
  }
  $targno = rand(0, sizeof($Term3) - 1);
  $T3_C = $Term3[$targno];
  unset($Term3);

  $stmt = $conn->prepare("SELECT DB FROM Current_DB");
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $db = $row['DB'];
  }

  $stmt = $conn->prepare(
      "INSERT INTO Student_Choices (Username, T1_Choice, T2_Choice, T3_Choice, DB_Year)
       VALUES (:username, :t1choice, :t2choice, :t3choice, :db)"
  );
  // Binds the post and session variables for the insert statement
  $stmt->bindParam(':username', $user);
  $stmt->bindParam(':t1choice', $T1_C);
  $stmt->bindParam(':t2choice', $T2_C);
  $stmt->bindParam(':t3choice', $T3_C);
  $stmt->bindParam(':db', $db);
  $stmt->execute();

  print_r($user.' '.$T1_C.' '.$T2_C.' '.$T3_C.'<br>');
}
?>
