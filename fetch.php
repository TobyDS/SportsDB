<?php
$con=mysqli_connect('localhost','root','','SportsDB')
    or die("connection failed".mysqli_errno());
$request=$_REQUEST;
$col =array(
    0   =>  'student',
    1   =>  'year',
    2   =>  'house',
    3   =>  'T1',
    4   =>  'T2',
    5   =>  'T3'
);  //create column like table in database

$filter_sport = intval($_REQUEST['filter_sport']);
$filter_term = strval($_REQUEST['filter_term']);
$filter_sex = strval($_REQUEST['filter_sex']);
$filter_year = strval($_REQUEST['filter_year']);
$filter_house = strval($_REQUEST['filter_house']);

if($filter_term != 'NULL'){
  if($filter_term == '1'){
    if($filter_sport != 'NULL'){
      $filter_sport = " AND T1.Sport_ID = '".$filter_sport."' ";
    }
    else{
      $filter_sport = '';
    }
  }
  if($filter_term == '2'){
    if($filter_sport != 'NULL'){
      $filter_sport = " AND T2.Sport_ID = '".$filter_sport."' ";
    }
    else{
      $filter_sport = '';
    }
  }
  if($filter_term == '3'){
    if($filter_sport != 'NULL'){
      $filter_sport = " AND T3.Sport_ID = '".$filter_sport."' ";
    }
    else{
      $filter_sport = '';
    }
  }
}
else{
  // Sets query for sport filter
  if($filter_sport != 'NULL'){
    $filter_sport = ' AND (T1.Sport_ID = '.$filter_sport.' OR T2.Sport_ID = '.$filter_sport.
    ' OR T3.Sport_ID = '.$filter_sport.')';
  }
  else{
    $filter_sport = '';
  }
}

// Sets query for sex filter
if($filter_sex != 'NULL'){
  $filter_sex = " AND st.Sex = '".$filter_sex."' ";
}
else{
  $filter_sex = '';
}
// Sets query for house filter
if($filter_house != 'NULL'){
  $filter_house = " AND st.House = '".$filter_house."' ";
}
else{
  $filter_house = '';
}
// Sets query for year filter
if($filter_year != 'NULL'){
  $sql ="SELECT * FROM Year WHERE Year_ID = '".$filter_year."' ";
  $filter_year = '';
  $query=mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($query)){
    $arr = str_split($row['Code']);
    foreach ($arr as &$value) {
      $filter_year .= ' OR st.Year ='.$value;
    }
  }
  $filter_year = substr($filter_year, 3);
  $filter_year = ' AND ('.$filter_year.')';
}
else{
  $filter_year = '';
}


$sql ="SELECT st.Name AS student, st.House AS house,
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
WHERE 1=1";

// Apply calculated filters to sql stament
$sql.= "$filter_sport";
$sql.= "$filter_sex";
$sql.= "$filter_house";
$sql.= "$filter_year";

$query=mysqli_query($con,$sql);
$totalFilter=mysqli_num_rows($query);
$totalData=$totalFilter;
//Search
$sql ="SELECT st.Name AS student, st.House AS house,
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
WHERE 1=1";

$sql.= "$filter_sport";
$sql.= "$filter_sex";
$sql.= "$filter_house";
$sql.= "$filter_year";

if(!empty($request['search']['value'])){
    $sql.=" AND ( st.Name Like '%".$request['search']['value']."%' ";
    $sql.=" OR st.Year Like '%".$request['search']['value']."%' ";
    $sql.=" OR st.House Like '%".$request['search']['value']."%' ";
    $sql.=" OR T1.Name Like '".$request['search']['value']."%' ";
    $sql.=" OR T2.Name Like '".$request['search']['value']."%' ";
    $sql.=" OR T3.Name Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalFilter=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY st.House, st.year DESC, st.Name  LIMIT ".
    $request['start']."  ,".$request['length']."  ";
$query=mysqli_query($con,$sql);
$data=array();
while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row[0]; //student
    $subdata[]=$row[1]; //house
    $subdata[]=$row[2]; //year
    $subdata[]=$row[3]; //T1
    $subdata[]=$row[4]; //T2
    $subdata[]=$row[5]; //T3
    $data[]=$subdata;
}
$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);
echo json_encode($json_data);
?>
