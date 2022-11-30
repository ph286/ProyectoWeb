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

    $carrerasQuery = "SELECT * FROM `carreras`";
    $carrerasResultado = mysqli_query($mysqli,$carrerasQuery);
    $infoCarreras = [];

    while ($carrera = mysqli_fetch_array($carrerasResultado)) {
        $infoCarreras[] = array(
            $carrera[0],
            $carrera[1]
        );

        if ($carreraId == $carrera[0]){
            $nombreCarrera = $carrera[1];
        }
    }

    $etiquetasQuery = "SELECT * FROM etiquetas";
    $etiquetasResultado = mysqli_query($mysqli, $etiquetasQuery);

    $infoEtiquetas = [];

    while ($etiqueta = mysqli_fetch_array($etiquetasResultado)) {
        $infoEtiquetas[] = array(
            $etiqueta[0],
            $etiqueta[1],
            false
        );
    }

    $materiasQuery = "SELECT * FROM materias";
    $materiasResultado = mysqli_query($mysqli, $materiasQuery);

    $infoMaterias = [];
    while ($materia = mysqli_fetch_array($materiasResultado)) {
        $infoMaterias[] = array(
                $materia[0],
            $materia[1]
        );
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>

        let infoEtiquetas = [];

        <?php foreach ($infoEtiquetas as $etiqueta) :?>
            infoEtiquetas[<?=$etiqueta[0]?>] = [
                "<?=$etiqueta[1]?>",
                false
            ]
        <?php endforeach?>

        function selectEtiqueta(index) {
            let isSelected = infoEtiquetas[index][1]
            infoEtiquetas[index][1] = !isSelected
            let id = "etiqueta" + index;

            let button = document.getElementById(id)

            if (isSelected) {
                button.classList.remove("text-bg-success")
                button.classList.add("text-bg-warning")
                button.classList.remove("text-white")
                button.classList.add("text-dark")
            } else {
                button.classList.remove("text-bg-warning")
                button.classList.add("text-bg-success")
                button.classList.remove("text-dark")
                button.classList.add("text-white")
            }
        }
    </script>
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
                   <h2 class="fw-bold pt-3 mb-2 text-uppercase text-center">
                         Evalúa a
                         <?php if (isset($alumnoId)):?>
                            <?= $nombreAlumno?>
                         <?php else: ?>
                            tu compañero
                         <?php endif?>
                     </h2>
                   <hr class="hr" />
                   <?php if (!isset($alumnoId)):?>
                       <div>
                           <label class="pb-2" for="inputNombre">Nombre del alumno</label>
                           <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Nombre completo">
                           <div class="invalid-feedback">Los nombres no pueden estar vacíos y solo se admiten letras</div>
                       </div>
                   <?php endif?>

                   <div class="form-group pt-3">
                       <?php if (isset($alumnoId)): ?>
                           <label class="pb-2" for="inputCarrera">Carrera: <?= $nombreCarrera?></label>
                       <?php else: ?>
                           <label class="pb-2" for="inputCarrera">Carrera</label>
                           <select class="form-control" id="inputCarrera" name="carrera">
                               <?php foreach ($infoCarreras as $row):?>
                                   <option value="<?= $row[0]?>"
                                       <?php if($row[1] == $nombreCarrera):?>
                                           selected
                                       <?php endif?>
                                   ><?=$row[1]?></option>
                               <?php endforeach?>
                           </select>
                       <?php endif ?>
                   </div>

                   <div class="form-group pt-3">
                       <label class="pb-2" for="inputMateria">Materia</label>
                       <select class="form-control" id="inputMateria" name="materia">
                           <?php foreach ($infoMaterias as $row):?>
                               <option value="<?= $materia[0]?>"><?=$row[1]?></option>
                           <?php endforeach?>
                       </select>
                   </div>

                   <label class="pt-3 pb-2" for="inputSemestre">Semestre</label>
                   <div class="d-flex flex-row">
                       <select class="w-auto form-control me-1" id="inputSemestre" name="semestre">
                           <option value="Ago-Dic">Ago-Dic</option>
                           <option value="Ene-May">Ene-May</option>
                           <option value="Verano">Verano</option>
                       </select>
                       <label for="inputYear"></label>
                       <select class="w-auto form-control ms-1" id="inputYear" name="year">
                           <option value=2022>2022</option>
                           <option value=2021>2021</option>
                           <option value=2020>2020</option>
                       </select>
                   </div>

                   <div class="form-group pt-3">
                       <label class="pb-2" for="inputEtiquetas">Etiquetas</label>
                       <div class="d-flex flex-row flex-wrap">
                           <?php foreach ($infoEtiquetas as $etiqueta) :?>
                               <button id="etiqueta<?=$etiqueta[0]?>" onclick="selectEtiqueta(<?=$etiqueta[0]?>)" class="m-1 rounded-pill pt-1 px-3 pb-1 text-dark border-0 text-bg-warning"><?=$etiqueta[1]?></button>
                           <?php endforeach?>
                       </div>
                   </div>

                   <div class="form-group pt-3">
                       <label class="pb-2" for="comentarios">Comentarios sobre el alumno</label>
                       <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                       <div class="invalid-feedback">Debes hacer un comentario</div>
                   </div>

                   <div class="form-row">
                       <div class="form-group col-md-6 pt-3">
                           <label class="pb-2" for="inputCalificacion">Calificación</label>
                           <input type="number" inputmode="numeric" pattern="\d*" class="form-control" id="inputCalificacion" min="0" max="100" name="calificacion" placeholder="Calificación">
                           <div class="invalid-feedback">Ingresa un valor entre 0 y 100</div>
                       </div>
                   </div>

                   <br>
                   <button id="sendButton" name="sendButton" type="submit" class="btn btn-primary">Enviar</button>
               </div>
            </div>
         </div>
      </div>
   </section>
   <script>

       document.getElementById("sendButton").addEventListener("click", () => {
           let correctNombre = validateNombre()
           let correctComentario = validateComentario()
           let correctCalificacion = validateCalificacion()

           if (correctNombre && correctComentario && correctCalificacion) {
               crearNuevoComentario()
           }
       })

       function validateNombre() {
           <?php if(!isset($alumnoId)) :?>
           let nombreInput = document.getElementById("inputNombre")
           let nombre = nombreInput.value.trim()

           const pattern = new RegExp(/^[A-Za-z\s]+$/g)

           let isValidName = nombre !== "" && pattern.test(nombre)

           if (isValidName) {
               nombreInput.value = nombre
               nombreInput.classList.remove("is-invalid")
           } else {
               nombreInput.classList.add("is-invalid")
           }

           return isValidName
           <?php else:?>
           return true
           <?php endif?>
       }

       function validateComentario() {
           let comentarioInput = document.getElementById("comentarios")
           let comentario = comentarioInput.value.trim()

           let isEmpty = comentario === ""

           if (isEmpty) {
               comentarioInput.classList.add("is-invalid")
           } else {
               comentarioInput.value = comentario
               comentarioInput.classList.remove("is-invalid")
           }

           return !isEmpty
       }

       function validateCalificacion() {
           let inputCalificacion = document.getElementById("inputCalificacion")
           let calificacion = parseInt(inputCalificacion.value)

           let isLower0 = calificacion < 0
           let isHigher100 = calificacion > 100
           let isInvalid = isNaN(calificacion) || isLower0 || isHigher100

           if (isInvalid) {
               inputCalificacion.classList.add("is-invalid")
           } else {
               inputCalificacion.classList.remove("is-invalid")
               inputCalificacion.value = calificacion.toString()
           }

           return !isInvalid
       }

       let nombre
       let carreraID
       let materiaID
       let semestre
       let year
       let etiquetasID
       let comentario
       let calificacion

       function crearNuevoComentario(){

           leerDatos()

           let datos = {
               <?php if (isset($_POST["alumno_id"])): ?>
               "alumno_id": <?=$alumnoId?>,
               <?php endif?>
               "nombre": nombre,
               "semestre": semestre + " " + year,
               "carreraID": carreraID,
               "etiquetas" : etiquetasID,
               "comentario" : comentario,
               "calificacion": calificacion,
               "materiaID": materiaID
           }

           $.ajax({
               data: datos,
               url: './nuevoComentario.php',
               type: 'post',
               success:  function (response) {
                   console.log(response);
               },
               error: function (error) {
                   console.log(error);
               }
           });
       }

       function leerDatos() {
           leerNombre()
           leerCarrera()
           leerMateria()
           leerSemestre()
           leerEtiquetas()
           leerComentario()
           leerCalificacion()
       }

       function leerNombre(){
           <?php if (isset($_POST["alumno_id"])): ?>
           nombre = "<?=$nombreAlumno?>"
           <?php else:?>
           nombre = document.getElementById("inputNombre").value
           <?php endif?>
       }

       function leerCarrera(){
           <?php if(isset($_POST["carrera_id"])):?>
           carreraID = document.getElementById("inputCarrera").value
           <?php else: ?>
           carreraID = <?=$carreraId?>
           <?php endif?>
       }

       function leerSemestre() {
           let selectSemestre = document.getElementById("inputSemestre")
           let semestreItem = selectSemestre.options[selectSemestre.selectedIndex]

           semestre = semestreItem.value

           let selectYear = document.getElementById("inputYear")
           let yearItem = selectYear.options[selectYear.selectedIndex]

           year = yearItem.value
       }

       function leerMateria() {
           let selectMateria = document.getElementById("inputMateria")
           let materiaItem = selectMateria.options[selectMateria.selectedIndex]
           materiaID = materiaItem.value
       }

       function leerEtiquetas() {
           etiquetasID = []

           infoEtiquetas.forEach(etiqueta => {
               if (etiqueta[1]) {
                   etiquetasID.push(infoEtiquetas.indexOf(etiqueta))
               }
           })
       }

       function leerComentario() {
           comentario = document.getElementById("comentarios").value
       }

       function leerCalificacion() {
           calificacion = document.getElementById("inputCalificacion").value
       }
   </script>
</body>

</html>