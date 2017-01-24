<?php
  include("dbConnect.php");

  if(isset($_GET['name'])) {


    $query = "INSERT INTO technology (name) VALUES ('".$_GET['name']."')";
    $conn->query($query);

    echo $result = $conn->insert_id;
  }else {
        echo "-1";
  }

?>
