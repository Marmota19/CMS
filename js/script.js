function addNewCourse() {
  var selectValue = document.getElementById("courses-list").value;
  if (selectValue === "new") {
    document.getElementById("new-course").style.display="block";
  }else{
    document.getElementById("new-course").style.display="none";
  }
}


function validateCourse() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "0") {
        document.getElementById("edit-course-code").style.box-shadow=" 0 0 3px #CC0000";
        document.getElementById("edit-course-code").autofocus;
      }
     
    }
  };
  var userCode = document.getElementById("edit-course-code").value;
  xhttp.open("GET", "../php/checkCourse.php?code=" + userCode, true);
  xhttp.send();
} 