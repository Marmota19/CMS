<?php
  include("dbConnect.php");

  if(isset($_GET['code']) && isset($_GET['name'])) {


    $query = "INSERT INTO course (name, code) VALUES ('".$_GET['name']."','".$_GET['code']."')";
    $conn->query($query);

    echo $result = $conn->insert_id;
  }else {
        echo "-1";
  }

?>
