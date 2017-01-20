<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <title>Editar Proyecto</title>
  <script>
    function addNewCourse() {
      var selectValue = document.getElementById("courses-list").value;
      if (selectValue === "new") {
        document.getElementById("new-course").style.display="block";
      }else{
        document.getElementById("new-course").style.display="none";
      }
    }

    function validateCourse (){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

              // Typical action to be performed when the document is ready:
              var response = this.responseText;
              var input = document.getElementById('edit-course-code');
              var className;

               if (response === '1') {
                  className ='inccorrect';
                  //input.style.border = "2px solid red";
                  input.focus();

               }else{
                  className = 'correct';
                  //input.style.border = "2px solid green";
               }

               input.setAttribute("class", className);


          }
      };

      var code = document.getElementById("edit-course-code").value;
      xhttp.open("GET", "../../php/checkCourse.php?code=" + code, true);
      xhttp.send();
    }

    function addCourse() {
      var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                // Typical action to be performed when the document is ready:
                var response = this.responseText;
                var input = document.getElementById('edit-course-code');


                 if (response === '-1') {
                  console.log("Error");

                 }else{
                  var coursesList = document.getElementById("courses-list");
                  var opt = document.createElement('option');

                  var courseName = document.getElementById("edit-course-name").value + '-' + document.getElementById('edit-course-code').value;

                  opt.value = response;
                  opt.text = courseName;
                  coursesList.add(opt);

                 }

            }
        };

        var code = document.getElementById("edit-course-code").value;
        var name = document.getElementById("edit-course-name").value;
        xhttp.open("GET", "../../php/addCourse.php?code=" + code + "&name=" + name, true);
        xhttp.send();
    }

    function addTech() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                // Typical action to be performed when the document is ready:
                var response = this.responseText;


                if(response != '0') {

                    var techsList = document.getElementById('techs-list');
                    var li = document.createElement("LI");

                    // Crear Input
                    var checkbox = document.createElement('INPUT');
                    var techName = document.getElementById("edit-tech-name").value;
                    checkbox.type = 'checkbox';
                    checkbox.value = response;
                    checkbox.name = techName;

                    // Crear Label
                    var label = document.createElement('LABEL');
                    label.innerHTML = techName;

                    li.appendChild(checkbox);
                    li.appendChild(label);
                    techsList.appendChild(li);

                }
            }
        };

        var techName = document.getElementById("edit-tech-name").value;

        xhttp.open("GET", "../../php/addTech.php?name=" + techName, true);
        xhttp.send();
    }
    function validateMeth() {
      if (document.getElementById("group-meth").checked){
        document.getElementById("group-details").style.display="block"
      }else{
        document.getElementById("group-details").style.display="none"
      }

    }
  </script>
</head>
<body>
  <div class="l-page">
    <header class="l-header">
      <nav class="l-navigation">
        <ul class="admin-main-menu">
          <li><a href="login.html">Inicio</a>
          <li><a href="adminAcademicTraining.html">Administrar Formación</a></li>
          <li><a href="adminSelfInterests.html">Administrar Intereses</a></li>
          <li><a href="adminCurrentSemester.html">Administrar Semestre Actual</a></li>
          <li><a href="adminBriefcase.php">Administrar Portafolio</a></li>
          <li><a href="adminContact.html">Administrar Información Contacto</a></li>
          </ul>
      </nav>
    </header>
    <main class="l-main">
    <h1>Editar/Agregar Proyecto</h1>

        <div class="form-item">
          <label for="edit-name">Nombre</label>
          <input type="text" id="edit-name" name="name">
        </div>
        <div class="form-item">
          <select name="courses" id="courses-list" onchange="addNewCourse();">
            <option value="">Seleccione uno</option>
            <?php
              include ("../../php/dbConnect.php");
              $query = "SELECT courseId, name, code FROM course";
              $result = $conn->query($query);
              if ($result->num_rows > 0) { // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo ("<option value='".$row["name"]."'>".$row["name"]. " - " . $row["code"]."</option>");
                }
              } else { echo "No hay datos"; }
             ?>
            <option value="new">Crear Nuevo</option>

          </select>
        </div>
        <div style="display: none;" id="new-course" class="form-item hidden">
          <label for="edit-course-name">Nombre del Curso</label>
          <input type="text" id="edit-course-name" name="course-name" placeholder="Nombre">
          <label for="edit-course-code">Código del Curso</label>
          <input type="text" id="edit-course-code" name="course-code" onchange="validateCourse()" placeholder="Código">
          <button onclick="addCourse();">Agregar</button>
        </div>
        <div class="form-item">
          <label for="edit-summary">Resumen</label>
          <textarea name="summary" id="edit-summary" cols="60" rows="5"></textarea>
        </div>
        <div class="form-item">
          <label for="edit-description">Descripción</label>
          <textarea name="description" id="edit-description" cols="60" rows="5"></textarea>
        </div>
        <div class="form-item">
          <label for="edit-project-type">Tipo de Proyecto</label><br>
          <input type="radio" name="project-type" value="infrastructure">Infraestructura<br>
          <input type="radio" name="project-type" value="development">Desarrollo<br>
          <input type="radio" name="project-type" value="research">Investigación
        </div>
        <div class="form-item">
          <label for="edit-metodology">Forma de Trabajo</label><br>
          <input type="radio" name="metodology" onclick="validateMeth();" value="individual">Individual<br>
          <input type="radio" id="group-meth" name="metodology" onclick="validateMeth();" value="group">Grupo<br>
        </div>
        <div style="display: none;" id="group-details" class="form-item hidden">
          <label for="edit-amount-">Cantidad de personas</label>
          <input type="text" id="edit-amount-" name="amount">
          <label for="edit-rol-">Rol</label>
          <input type="text" id="edit-rol-" name="rol">
        </div>
        <div class="form-item">
          <label for="edit-technologies">Tecnologías utilizadas</label><br>
          <ul id="techs-list">


          <?php
              include ("../../php/dbConnect.php");
              $query = "SELECT technologyId, name FROM technology";
              $result = $conn->query($query);
              if ($result->num_rows > 0) { // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo("<li><input type='checkbox' name='".$row["name"]."' value='".$row["technologyId"]."'> <label>".$row["name"]."</label></li> ");
                }
              } else { echo "No hay datos"; }
             ?>
          </ul>
          <label for="edit-tech-name">Nueva Tecnología</label><br>
          <input type="text" id="edit-tech-name" name="edit-tech-name" placeholder="Nueva Tecnología">
          <button onclick="addTech()">Agregar</button>
        </div>

        <div class="form-item">
          <input id="edit-submit" name="op" value="save" type="submit">
        </div>

    </main>
  </div>

</body>
</html>
