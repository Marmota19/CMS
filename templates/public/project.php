<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<title>Proyecto</title>
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
					<?php
						if(isset($_COOKIE['projectId'])) {
							$projectId = $_COOKIE['projectId'];
							include ("../../server/conexion.php");
							// Get the list of technologies
							$listaTech = "";
							$sql = "SELECT tech.name name
							FROM technology tech
							INNER JOIN technologiesPerProject techP ON techP.technologyId = tech.technologyId
							WHERE techP.projectId = $projectId";
							$technologies = $conn->query($sql);
							if ($technologies->num_rows > 0){
								while($row = $technologies->fetch_assoc()){
									$tech = $row["name"];
									$listaTech .= $tech . ",";
								}
							}
							// Get the list of images
							$tableContent = "";
							$sql = "SELECT imgName
							FROM projectImages
							WHERE projectId = $projectId";
							$dbImages = $conn->query($sql);
							if ($dbImages->num_rows > 0){
								while($row = $dbImages->fetch_assoc()) {
									$imgName = $row['imgName'];
									$tableContent .= "<tr>
										<td>
											<img alt='" . $imgName . "' src='../../img/cms_img/" . $imgName . "'>
										</td>
									</tr>";
								}
							}
			             	$query = "SELECT project.name projectName, project.summary projectSummary,
								projectType.name projectType,
								course.name courseName, course.teacher courseTeacher,
								meth.name methForm, meth.peopleAmount methCount, meth.role methRole
							FROM project project
							INNER JOIN projectType projectType ON projectType.projectTypeId = project.projectTypeId
							INNER JOIN course course ON course.courseId = project.courseId
							INNER JOIN methodology meth ON meth.metodologyId = project.metodologyId
							WHERE project.projectId = $projectId";
							$result = $conn->query($query);
			             	if ($result->num_rows > 0) { // output data of each row
			                	while($row = $result->fetch_assoc()) {
									echo ("
										<header class='page-header'>
											<h1>" .
												$row['projectName'] .
											"</h1>
										</header>
										<main>
											<article>
												<section>
													<dl>
														<dt>Resumen</dt>
									  					<dd><textarea readonly>" .
									  						$row['projectSummary'] .
									  						"</textarea>
									  					</dd>
														<dt>Curso</dt>
									  					<dd><input type='text' readonly value='" .
									  						$row['courseName'] . "'></dd>
									  					<dt>Profesor</dt>
									  					<dd><input type='text' readonly value='" .
									  						$row['courseTeacher'] . "'></dd>
									  					<dt>Tipo de Proyecto</dt>
									  					<dd><input type='text' readonly value='" .
									  						$row['projectType'] . "'></dd>
									  					<dt>Forma trabajo</dt>
									  					<dd><input type='text' readonly value='" .
									  						$row['methForm'] . "'></dd>
									  					<dt>Cantidad de Personas</dt>
									  					<dd><input type='text' readonly value='" .
									  						$row['methCount'] . "'></dd>
									  					<dt>Rol en el Proyecto</dt>
									  					<dd><input type='text' readonly value='" .
									  						$row['methRole'] . "'></dd>
									  					<dt>Tecnologias utilizadas</dt>
									  					<dd><input type='text' readonly value='" .
									  						$listaTech . "'></dd>
													</dl>
												</section>
												<section class='gallery'>
													<header class='page-header'>
														<h1>
															Galeria
														</h1>
													</header>
													<table>"
														. $tableContent .
													"</table>
												</section>
											</article>
										</main>
										<footer>
											<p>Curso Web Verano</p>
										</footer>
								    ");
			                	}
			              	} else {
			                	echo ("");
			              	}
						} else {
						    echo ("
								<header class='page-header'>
									<h1>
										Seleccione un proyecto
									</h1>
								</header>
						    ");
						}
			        ?>

				</article>
			</main>
			<footer class="l-footer">
				<p>Curso Web Verano</p>
			</footer>
		</div>
	</body>
</html>
