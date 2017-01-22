<?php 
  include("dbConnect.php");

  if(isset($_GET['courseId']) && isset($_GET['name']) && isset($_GET['projectTypeId']) && isset($_GET['methodologyId'])) {


    $query = "INSERT INTO project (name, summary, technology, methodologyId, projectTypeId, courseId) VALUES ('".$_GET['name']."','".$_GET['summary']. "','".$_GET['technology']."',".$_GET['methodologyId'].",".$_GET['projectTypeId'].",".$_GET['courseId']."')"; 
    $result = $conn->query($query);

    echo $result->insert_id;
  }else {
        echo "-1";
  } 
?>

