<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  
  <title>Editar Proyecto</title>
</head>
<body>
  <div class="l-page">
    <header class="l-header">
      <nav class="l-navigation">
        <ul class="admin-main-menu">
          <li><a href="home.html">Inicio</a>
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
      <form action="" accept-charset="UTF-8">
        <div class="form-item">
          <label for="edit-name">Nombre</label>
          <input type="text" id="edit-name" name="name">
        </div>
        <div class="form-item">
          <select name="courses" id="courses-list" onchange="addNewCourse()">
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
          <div id="new-course" class="form-item hidden">
            <label for="edit-course-name">Nombre del Curso</label>
            <input type="text" id="edit-course-name" name="course-name">
            <label for="edit-course-code">Código del Curso</label>
            <input type="text" id="edit-course-code" name="course-code" onchange="validateCourse()">
          </div>
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
          <input type="radio" name="metodology" value="individual">Individual<br>
          <input type="radio" name="metodology" value="group">Grupo
        </div>
        <div id="group-details" class="form-item hidden">
          <label for="edit-amount-">Cantidad de personas</label>
          <input type="text" id="edit-amount-" name="amount">
          <label for="edit-rol-">Rol</label>
          <input type="text" id="edit-rol-" name="rol">
        </div>
        <div class="form-item">
          <label for="edit-technologies">Tecnologías utilizadas</label><br>
          <?php 
              include ("../../php/dbConnect.php");
              $query = "SELECT name FROM technology"; 
              $result = $conn->query($query); 
              if ($result->num_rows > 0) { // output data of each row 
                while($row = $result->fetch_assoc()) { 
                  echo("<input type='checkbox' name='".$row["name"]."' value='".$row["name"]."'>".$row["name"]."<br>"); 
                } 
              } else { echo "No hay datos"; }
             ?>
          <!-- <textarea name="technologies" id="edit-technologies" cols="60" rows="5"></textarea> -->
        </div>

        <div class="form-item">
          <input id="edit-submit" name="op" value="save" type="submit">
        </div>
      </form>
    </main>
  </div>
  <script type="text/javascript" src="../../js/script.js"></script>
</body>
</html>
