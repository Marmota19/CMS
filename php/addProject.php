<?php
  include("dbConnect.php");

  if(isset($_POST['courses']) && isset($_POST['name']) && isset($_POST['project-type']) && isset($_POST['methodology'])) {
    if ($_POST['methodology'] == 1) {
      $query = "INSERT INTO project (name, summary, description, methodologyId, projectTypeId, courseId) VALUES ('".$_POST['name']."','".$_POST['summary']. "','".$_POST['description']."',".$_POST['methodology'].",".$_POST['project-type'].",".$_POST['courses'].")";
    } else {
      $query = "INSERT INTO project (name, summary, description, methodologyId, projectTypeId, courseId, peopleAmount, role) VALUES ('".$_POST['name']."','".$_POST['summary']. "','".$_POST['description']."',".$_POST['methodology'].",".$_POST['project-type'].",".$_POST['courses'].",".$_POST['amount'].",'".$_POST['rol']."')";
    }
     $conn->query($query);
     $projectId = $conn->insert_id;


     // Get the technology count
    $query = "SELECT COUNT(*) techCount FROM technology";
    $result = $conn->query($query);
    $techCount = -1;

    if($row = $result->fetch_assoc()) {
      $techCount = $row['techCount'];
    }

    $technologyIndex = 1;
    $technologyValues = "";

    while ($technologyIndex <= $techCount) {
      $techParam = "technology_" . $technologyIndex;

      if (isset($_POST[$techParam])) {
        $technologyValues .= "(" . $projectId . "," . $_POST[$techParam] . "),";
      }
      $technologyIndex++;
    }

    if ($technologyValues != "") {
      $technologyValues = rtrim($technologyValues, ",");
      $query = "INSERT INTO technologiesPerProject (projectId, technologyId) VALUES " . $technologyValues;
      $conn->query($query);
    }


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
     $url='../templates/admin/adminBriefcase.php';
     echo '<script>window.location = "'.$url.'";</script>';
  }else {
        echo "-1";
  }
?>

