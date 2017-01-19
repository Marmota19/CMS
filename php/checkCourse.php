<?php 
  include("dbConnect.php");

  if(isset($_GET['code'])) {

    $query = "SELECT course.code FROM course WHERE course.code ='".$_GET['code']."'"; 
    $result = $conn->query($query);

    if ($result->num_rows > 0) { // output data of each row 
      echo 1;
    }else{
      echo 0;
    }
  }else {
        echo 0;
  } 
   
?>