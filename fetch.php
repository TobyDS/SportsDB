<?php

// Creates connection to database
include_once('connection.php');

$column = array('Name', 'House', 'Year',
  'T1_Choice', 'T2_Choice', 'T3_Choice');

$query = "SELECT st.Name AS student, st.House AS house,
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
  ";

$criteria = '';

if(isset($_POST['filter_sex']))
{
  $criteria = $criteria ."AND st.Sex=".$_POST['filter_sex'];
}
if(isset($_POST['filter_house']))
{
  $criteria = $criteria ."AND st.House=".$_POST['filter_house'];
}

$criteria = substr($criteria, 3);

$query .= 'WHERE"'.$criteria.'"';

if(isset($_POST['order']))
{
  $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.
      $_POST['order']['0']['dir'].' ';
}
else
{
  $query .= 'ORDER BY st.Name DESC';
}

$query1 = '';

// if($_POST['length'] != -1)
// {
//   $query1 = 'LIMIT '.$_POST['start'].', '.$_POST['length'];
// }

$stmt = $conn->prepare($query);
$stmt->execute();

$number_filter_row = $stmt->rowCount();

$stmt = $conn->prepare($query . $query1);
$stmt->execute();
$result = $stmt->fetchAll();

$data = array();

foreach ($result as $row)
{
  $sub_array = array();
  $sub_array[] = $row['student'];
  $sub_array[] = $row['house'];
  $sub_array[] = $row['year'];
  $sub_array[] = $row['T1'];
  $sub_array[] = $row['T2'];
  $sub_array[] = $row['T3'];
  $data[] = $row_array;
}

function count_all_data($conn)
{
  $query = "SELECT st.Name AS student, st.House AS house,
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
    ";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  return $stmt->rowCount();
}

$output = array (
  // 'draw'            =>  intval($_POST['draw']),
  'recordsTotal'    =>  count_all_data($conn),
  'recordsFiltered' =>  $number_filter_row,
  'data'            =>  $data
);

echo json_encode($output);

?>
