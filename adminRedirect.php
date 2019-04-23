<?php
if($_POST['submit']==0){header('Location:adminSports.php');}
else if($_POST['submit']==1) {header('Location:adminOptions.php');}
else if($_POST['submit']==2) {header('Location:adminStudents.php');}
else if($_POST['submit']==3) {header('Location:adminChoices.php');}
else if($_POST['submit']==4) {header('Location:adminYears.php');}
?>
