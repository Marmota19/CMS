<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
	<title>Administrar Protafolio</title>
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
      <section>
        <h2>Agregar Nuevo Proyecto</h2>
          <a href="editProject.php">Agregar</a>
      </section>
      <section>
        <h2>Proyectos Desarrollados</h2>
        <table border="1">
            <tr>
                <th>Curso</th>
                <th>Nombre</th>
                <th>Resumen</th>
            </tr>

            <?php 
              include ("../../php/dbConnect.php");
              $query = "SELECT course.name AS course, project.name AS project,project.summary AS summary  FROM project INNER JOIN course ON project.courseId = course.courseId"; 
              $result = $conn->query($query); 
              if ($result->num_rows > 0) { // output data of each row 
                while($row = $result->fetch_assoc()) { 
                  echo ("<tr><td>".$row["course"]."</td> <td>".$row["project"]."</td> <td>".$row["summary"]."</td> </tr>");
                } 
              } else { 
                echo ("<tr><td>No hay datos</td> <td>No hay datos</td> </tr>"); 
              }
             ?>
        </table>
      </section>
    </main>
  </div>
</body>
</html>