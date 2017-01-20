<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<title>Portafolio</title>
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
	</head>
	<body>
		<div class="l-page">
			<header class="l-header">
				<nav class="l-navigation">
					<ul class="main-menu" >
						<li><a href="index.html">Inicio</a>
						<li><a href="academicTraining.html">Formación</a></li>
						<li><a href="selfInterests.html">Intereses Personales</a></li>
						<li><a href="briefcase.php">Portafolio de Proyectos</a></li>
						<li><a href="contact.html">Contácteme</a></li>
					</ul>
				</nav>
			</header>
			<main class="l-main">
				<article>

					<section>
						<h2>Cursos Semestre Actual</h2>
						<h3>Verano 2016 - 2017</h3>
						<table border="1">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Profesor</th>
									<th>Horario</th>
								</tr>
							</thead>
							<tbody>
								<?php
		              include ("../../php/dbConnect.php");
		              $query = "SELECT course.code, course.name, course.teacher, course.schedule FROM course";
		              $result = $conn->query($query);
		              if ($result->num_rows > 0) { // output data of each row
		                while($row = $result->fetch_assoc()) {
		                  echo ("<tr><td>".$row["code"]."</td> <td>".$row["name"]."</td> <td>".$row["teacher"]."</td> <td>".$row["schedule"]."</td> </tr>");
		                }
		              } else {
		                echo ("<tr><td>No hay datos</td> <td>No hay datos</td> td>No hay datos</td>td>No hay datos</td></tr>");
		              }
		            ?>
							</tbody>
						</table>
					</section>

					<section>
				        <h2>Proyectos Desarrollados</h2>
				        <table border="1">
				        	<thead>
				            <tr>
				                <th>Curso</th>
				                <th>Nombre</th>
				                <th>Resumen</th>
				            </tr>
									</thead>
									<tbody>
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
				          </tbody>
				        </table>
				      </section>

				</article>
			</main>
			<footer class="l-footer">
				<p>Curso Web Verano</p>
			</footer>
		</div>
	</body>
</html>
