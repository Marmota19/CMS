<?php 
  include("dbConnect.php");

  if(isset($_GET['courseId']) && isset($_GET['name']) && isset($_GET['projectTypeId']) && isset($_GET['methodologyId'])) {


    $query = "INSERT INTO project (name, summary, technology, methodologyId, projectTypeId, courseId) VALUES ('".$_GET['name']."','".$_GET['summary']. "','".$_GET['technology']."',".$_GET['methodologyId'].",".$_GET['projectTypeId'].",".$_GET['courseId'].")"; 
     $conn->query($query);
     $projectId = $conn->insert_id;

     // Insert project images
      if(count($_FILES) > 0) {
        $targetDir = "../img/";
        $imgCount = 0;
        foreach ($_FILES as &$imgItem) {
          if($imgItem['error'] == 0) {
            $imgName = $projectId . "_" . $imgCount . "_" . $imgItem['name'];
            $imgPath = $targetDir . $imgName;
            $query = "INSERT INTO image (projectId,name,url) VALUES (" . $projectId . "," .
              "'" . $imgName . "','" . $imgPath . "')";
            $conn->query($query);
            move_uploaded_file($imgItem["tmp_name"], $imgPath);
            $imgCount++;
          }
        }
      }

     

     echo $projectId;
  }else {
        echo "-1";
  } 
?>

