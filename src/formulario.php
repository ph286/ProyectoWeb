<?php

    session_start();

    if (!(isset($_SESSION["id"]) && $_SESSION["type"] == "user")) header("Location: ../");

    $mysqli = new mysqli('localhost', 'root', '', 'funator');

    if (isset($_POST["alumno_id"])) {
        $alumnoId = $_POST["alumno_id"];

        $alumnoQuery = "SELECT `nombre_alumno`,`carrera_id` FROM `alumnos` WHERE alumno_id = ".$alumnoId;
        $alumnoArray = mysqli_fetch_array(mysqli_query($mysqli, $alumnoQuery));

        $carreraId = $alumnoArray["carrera_id"];
        $nombreAlumno = $alumnoArray["nombre_alumno"];
    } else if (isset($_POST["carrera_id"])) {
        $carreraId = $_POST["carrera_id"];
    } else {
        header("Location: ../");
    }

    $carreraQuery = "SELECT `nombre_carrera` FROM `carreras` WHERE carrera_id = ".$carreraId;

    $nombreCarrera = mysqli_fetch_array(mysqli_query($mysqli,$carreraQuery))["nombre_carrera"];

    $etiquetasElegidas = [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Evaluación de alumnos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <style>
       body {
           background-color: #2e2b70;
       }
   </style>
</head>

<body>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- Container wrapper -->
      <div class="container">
         <!-- Navbar brand -->
         <a class="navbar-brand" href="../">
            <img src="../assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy" />
         </a>
      </div>
   </nav>

   <section class="vh-100 gradient-custom">

      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-12 col-md-8 col-lg-6 col-xl-5 py-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
               <div class="card-body pb-5 pe-5 ps-5">

                  <div class="mb-md-5 mt-md-4 pb-5">

                     <h2 class="fw-bold mb-2 text-uppercase text-center">
                         Evalúa a
                         <?php if (isset($alumnoId)):?>
                            <?= $nombreAlumno?>
                         <?php else: ?>
                            tu compañero
                         <?php endif?>
                     </h2>
                     <hr class="hr" />

                     <form method="post" action="formulario.php">

                         <?php if (!isset($alumnoId)):?>
                             <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Nombre completo">
                         <?php endif?>
                         <label class="pb-1">Semestre</label>
                        <div class="d-flex flex-row">
                            <select class="w-auto form-control me-1" id="inputSemestre" name="semestre">
                                <option value=1>Ago-Dic</option>
                                <option value=2>Ene-May</option>
                                <option value=3>Verano</option>
                            </select>
                            <select class="w-auto form-control ms-1" id="inputYear" name="year">
                                <option value=1>2022</option>
                                <option value=2>2021</option>
                                <option value=3>2020</option>
                            </select>
                        </div>
                         <hr class="hr" />
                        <div class="form-group">
                            <?php if (isset($alumnoId)): ?>
                                <label for="inputCarrera">Carrera: <?= $nombreCarrera?></label>
                            <?php else: ?>
                                <label for="inputCarrera">Carrera</label>
                                <select class="form-control" id="inputCarrera" name="carrera">
                                    <?php
                                    $carreritasQuery = "SELECT nombre_carrera FROM carreras";
                                    $carreritas = mysqli_query($mysqli, $carreritasQuery);
                                    while ($row = mysqli_fetch_array($carreritas)):?>
                                        <option value="<?= $row["nombre_carrera"]?>"><?=$row[0]?></option>
                                    <?php endwhile?>
                                </select>
                            </div>
                            <?php endif ?>
                        </div>

                        <div class="form-group">
                           <label for="inputEtiquetas">Etiquetas</label>
                           <div class="d-flex flex-row flex-wrap">
                              <?php
                              $etiquetitas = mysqli_query($mysqli, "SELECT * FROM etiquetas");
                              while ($row = mysqli_fetch_array($etiquetitas)) :?>
                                  <button id="etiqueta<?=$row[0]?>" class="m-1 align-content-center text-white rounded-pill border-0 text-bg-warning"><?=$row["nombre_etiqueta"]?></button>
                                <script>
                                    document.getElementById("etiqueta<?=$row[0]?>").onclick(function () {
                                        <?php
                                            $etiquetasElegidas[] = $row[0];
                                            var_dump($etiquetasElegidas);
                                        ?>
                                    })
                                </script>
                              <?php endwhile?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="comentarios">Comentarios sobre el alumno</label>
                           <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                        </div>

                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <label for="inputCalificacion">Calificación</label>
                              <input type="text" class="form-control" id="inputCalificacion" name="calificacion" placeholder="Calificación">
                           </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>

   </section>
   <?php
   $nombre = $_POST["nombre"];
   $semestre = $_POST["semestre"];
   $matricula = $_POST["matricula"];
   $carrera = $_POST["carrera"];
   $etiquetas = $_POST["etiquetas"];
   $comentario = $_POST["comentarios"];
   $calificacion = $_POST["calificacion"];
   //-------------------------------------
   $lis = "Ingenieria de software";
   $lem = "Enseñanza de las matemáticas";
   $lcc = "Ciencias de la computación";
   $lic = "Ingeniería en computación";
   $lm = "Matemáticas";
   //-------------------------------------
   if (strcmp($carrera, $lis) == 0) {
      $id_carrera = 1;
   } elseif (strcmp($carrera, $lem) == 0) {
      $id_carrera = 2;
   } elseif (strcmp($carrera, $lcc) == 0) {
      $id_carrera = 3;
   } elseif (strcmp($carrera, $lic) == 0) {
      $id_carrera = 4;
   } elseif (strcmp($carrera, $lm) == 0) {
      $id_carrera = 5;
   }
   //--------------------------------------
   if (strcmp($etiquetas, "motivado") == 0) {
      $id_etiqueta = 1;
   } elseif (strcmp($etiquetas, "amoroso") == 0) {
      $id_etiqueta = 2;
   } elseif (strcmp($etiquetas, "grosero") == 0) {
      $id_etiqueta = 3;
   } elseif (strcmp($etiquetas, "flojo") == 0) {
      $id_etiqueta = 4;
   } elseif (strcmp($etiquetas, "deshonesto") == 0) {
      $id_etiqueta = 5;
   } elseif (strcmp($etiquetas, "estudioso") == 0) {
      $id_etiqueta = 6;
   } elseif (strcmp($etiquetas, "responsable") == 0) {
      $id_etiqueta = 7;
   } elseif (strcmp($etiquetas, "puntual") == 0) {
      $id_etiqueta = 8;
   }
   $sql = "INSERT INTO alumnos (alumno_id, carrera_id, nombre_alumno) VALUES ($matricula, $id_carrera, '$nombre');
   INSERT INTO comentarios (semestre, comentario, calificacion) VALUES ('$semestre', '$comentario', $calificacion);
   INSERT INTO etiquetas_alumnos (etiqueta_id, alumno_id) VALUES ($id_etiqueta,$matricula);";
   //INSERT INTO info_comentarios(comentario_id, cuenta_id, alumno_id) VALUES ($comentario_id,$cuenta_id,$matricula); //Este es el query que faltaría ya que todavía no se han creado los tipos de cuentas y falta meterle el comentario_id

   $mysqli->multi_query($sql);
   ?>
</body>

</html>