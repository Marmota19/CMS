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
                  className ='incorrect';
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

    function getProjectTypeValue () {
      var radios = document.getElementsByName('project-type');

        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                return(radios[i].value);

                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    }

    function getMethodologyValue () {
      var radios = document.getElementsByName('methodology');

        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                return(radios[i].value);

                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    }

    function getUsedTech(argument) {


      var checkboxes = document.getElementsByName('edit-technologies');
      var vals = "";
      for (var i=0, n=checkboxes.length;i<n;i++)
      {
          if (checkboxes[i].checked)
          {
              vals += ","+checkboxes[i].value;
          }
      }
      if (vals) vals = vals.substring(1);
      return(vals);


    }


    function addProject() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                // Typical action to be performed when the document is ready:
                var response = this.responseText;


                if(response != '0') {

                }
            }
        };

        var projectName = "";
        var courseId = "";
        var projectSummary = "";
        var projectDescription = "";
        var projectTypeId = "";
        var methodologyId = "";
        var usedTech = "";

        projectName = document.getElementById("edit-name").value;
        courseId = document.getElementById("courses-list").value;
        projectSummary = document.getElementById("edit-summary").value;
        projectDescription = document.getElementById("edit-description").value;
        peopleAmount = document.getElementById("edit-amount-").value;
        role = document.getElementById("edit-rol-").value;
        projectTypeId = getProjectTypeValue();
        methodologyId = getMethodologyValue();
        usedTech = getUsedTech();

        alert("Proyecto agregado");

        xhttp.open("GET", "../../php/addProject.php?name="+projectName+"&courseId="+courseId+"&summary="+projectSummary+"&description="+projectDescription+"&projectTypeId="+projectTypeId+"&methodologyId="+methodologyId+"&technology="+usedTech+"&amount="+peopleAmount+"&role="+role, true);
        xhttp.send();
    }
    var imgCount = 0;
    function agregarImagen() {
      var listaImg = document.getElementById('listaImg');
      var nodo = document.createElement("LI");
      // Crear Input
      var inputFile = document.createElement('INPUT');
      inputFile.type = 'file';
      inputFile.name = 'imageFile_' + imgCount;
      // Crear Button
      var button = document.createElement('BUTTON');
      button.innerHTML = "X";
      button.addEventListener("click", removerImagen, false);
      nodo.appendChild(inputFile);
      nodo.appendChild(button);
      listaImg.appendChild(nodo);
      imgCount++;
    }
    function removerImagen(pEvent) {
      var element = pEvent.currentTarget;
      var node = element.parentNode;
      var list = node.parentNode;
      list.removeChild(node);
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
                  echo ("<option value='".$row["courseId"]."'>".$row["name"]. " - " . $row["code"]."</option>");
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
          <textarea name="summary" id="edit-summary" cols="60" rows="5" value="hh"></textarea>
        </div>
        <div class="form-item">
          <label for="edit-description">Descripción</label>
          <textarea name="description" id="edit-description" cols="60" rows="5"></textarea>
        </div>
        <div class="form-item">
          <label for="edit-project-type">Tipo de Proyecto</label><br>

          <?php
              include ("../../php/dbConnect.php");
              $query = "SELECT projectTypeId, name FROM projectType";
              $result = $conn->query($query);
              if ($result->num_rows > 0) { // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo ("<input type='radio' value='".$row["projectTypeId"]."' name='project-type'>".$row["name"]."<br>");
                }
              } else { echo "No hay datos"; }
             ?>

        </div>
        <div class="form-item">
          <label for="edit-methodology">Forma de Trabajo</label><br>
          <input type="radio" name="methodology" onclick="validateMeth();" value="1">Individual<br>
          <input type="radio" id="group-meth" name="methodology" onclick="validateMeth();" value="2">Grupo<br>
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
                  echo("<li><input type='checkbox' name='edit-technologies' value='".$row["name"]."'> <label>".$row["name"]."</label></li> ");
                }
              } else { echo "No hay datos"; }
             ?>
          </ul>
          <label for="edit-tech-name">Nueva Tecnología</label><br>
          <input type="text" id="edit-tech-name" name="edit-tech-name" placeholder="Nueva Tecnología">
          <button onclick="addTech()">Agregar</button>
        </div>

        <div class="form-item">
          <label>Imagenes</label>
          <ul id="listaImg"></ul>
          <button type="button" class="add-item" onclick="agregarImagen()">Agregar Imagen Nueva</button>
        </div>

        <div class="form-item">
          <input id="edit-submit" name="op" value="save" type="submit" onclick="addProject();">
        </div>

    </main>
  </div>

</body>
</html>
