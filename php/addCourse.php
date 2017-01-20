<?php 
  include("dbConnect.php");

  if(isset($_GET['code']) && isset($_GET['name'])) {


    $query = "INSERT INTO course (name, code) VALUES ('".$_GET['name']."','".$_GET['code']."')"; 
    $result = $conn->query($query);

    echo $result->insert_id;
  }else {
        echo "-1";
  } 
   
?>