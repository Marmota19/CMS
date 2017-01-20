<?php 
  include("dbConnect.php");

  if(isset($_GET['name'])) {


    $query = "INSERT INTO technology (name) VALUES ('".$_GET['name']."')"; 
    $result = $conn->query($query);

    echo $result->insert_id;
  }else {
        echo "-1";
  } 
   
?>