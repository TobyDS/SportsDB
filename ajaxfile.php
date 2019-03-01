<?php
include 'connection.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Custom Field value
$ssearchBySport = $_POST['searchBySport']; 
$searchByTerm = $_POST['searchByTerm'];
$searchBySex = $_POST['searchBySex'];
$searchByYear = $_POST['searchByYear'];
$searchByHouse = $_POST['searchByHouse'];

## Search
$searchQuery = " ";
if($searchBySport != ''){
   $searchQuery .= " and (sc.T1_Choice='".$searchBySport."') or (sc.T2_Choice='".$searchBySport."') or (sc.T3_Choice='".$searchBySport."')";
}


## Total number of records without filtering
$sel = $conn->prepare(
  "SELECT count(*)
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
$sel->execute();
while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
  $records = $sel
}
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = $conn->prepare(
  "SELECT count(*)
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
  WHERE 1 ".$searchQuery
  );
  $sel->execute();
  while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
    $records = $sel
  }
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = $conn->prepare("SELECT *
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
WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage);
$empQuery->execute();
$data = array();
while ($row = $empQuery->fetch(PDO::FETCH_ASSOC)) {
  $data[] = array(
    "student"=>$row['student'],
       "house"=>$row['house'],
       "year"=>$row['year'],
       "T1"=>$row['T1'],
       "T2"=>$row['T2']
       "T3"=>$row['T3']

     );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);
