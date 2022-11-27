<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Evaluación de alumnos</title>
   <!-- JavaScript Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   <!-- CSS Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <style>
      * {
         font-family: 'Inter', serif;
      }

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
         <a class="navbar-brand" href="index.php">
            <img src="../assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy" />
         </a>

         <!-- Toggle button -->
         <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
         </button>

         <!-- Collapsible wrapper -->
         <div class="collapse navbar-collapse" id="navbarButtonsExample">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link" href="index.php">Dashboard</a>
               </li>
            </ul>
            <!-- Left links -->

            <div class="d-flex align-items-center">
               <button type="button" class="btn btn-primary me-3">
                  Registrarse
               </button>
            </div>
         </div>
         <!-- Collapsible wrapper -->
      </div>
      <!-- Container wrapper -->
   </nav>

   <section class="vh-100 gradient-custom">

      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
               <div class="card-body p-5">

                  <div class="mb-md-5 mt-md-4 pb-5">

                     <h2 class="fw-bold mb-2 text-uppercase text-center">Evaluación de alumnos</h2>
                     <hr class="hr" />
                     <p class="text-left">Datos del alumno</p>
                     <form method="post" action="formulario.php">

                        <div class="form-group">

                           <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Nombre completo">
                        </div>

                        <div class="form-row">
                           <div class="form-group col-md-6">
                              <br>
                              <input type="text" class="form-control" id="inputSemestre" name="semestre" placeholder="Semestre">
                           </div>
                           <div class="form-group col-md-6">
                              <br>
                              <input type="text" class="form-control" id="inputMatricula" name="matricula" placeholder="Matricula">
                           </div>

                           <hr class="hr" />
                        </div>
                        <div class="form-group">
                           <label for="inputCarrera">Carrera</label>
                           <select class="form-control" id="inputCarrera" name="carrera">

                              <?php
                              $mysqli = new mysqli('localhost', 'root', '', 'funator');
                              $carreritas = mysqli_query($mysqli, "SELECT * FROM carreras;");
                              while ($row = mysqli_fetch_array($carreritas)) {
                                 echo '<option "value"='  .  $row[0] . '>' . $row[1] . '</option>';
                              }
                              ?>
                           </select>
                        </div>

                        <div class="form-group">
                           <label for="inputEtiquetas">Etiquetas</label>
                           <select class="form-control" id="inputEtiquetas" name="etiquetas">
                              <?php
                              $etiquetitas = mysqli_query($mysqli, "SELECT * FROM etiquetas;");
                              while ($row = mysqli_fetch_array($etiquetitas)) {
                                 echo '<option "value"='  .  $row[0] . '>' . $row[1] . '</option>';
                              }
                              ?>
                           </select>
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
   if (strcmp($carrera, "motivado") == 0) {
      $id_etiqueta = 1;
   } elseif (strcmp($carrera, "amoroso") == 0) {
      $id_etiqueta = 2;
   } elseif (strcmp($carrera, "grosero") == 0) {
      $id_etiqueta = 3;
   } elseif (strcmp($carrera, "flojo") == 0) {
      $id_etiqueta = 4;
   } elseif (strcmp($carrera, "deshonesto") == 0) {
      $id_etiqueta = 5;
   } elseif (strcmp($carrera, "estudioso") == 0) {
      $id_etiqueta = 6;
   } elseif (strcmp($carrera, "responsable") == 0) {
      $id_etiqueta = 7;
   } elseif (strcmp($carrera, "puntual") == 0) {
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