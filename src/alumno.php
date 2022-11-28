<?php

    session_start();

    $isLogIn = isset($_SESSION["id"]);

    if (!isset($_GET["alumno"])) header("Location: ../");

    $alumnoId = $_GET["alumno"];

    $mysqli = new mysqli('localhost', 'root', '', 'funator');

    $alumnoQuery = "SELECT * FROM `alumnos` WHERE `alumno_id` = '$alumnoId'";
    $alumnoData = mysqli_fetch_array(mysqli_query($mysqli,$alumnoQuery));

    $comentariosQuery = "SELECT `comentario_id`,`materia_id` FROM `info_comentarios` WHERE `alumno_id` = '$alumnoId'";
    $todosComentarios = mysqli_query($mysqli, $comentariosQuery);
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../styles/card_comentario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Funator</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../">
            <img src="../assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy" />
        </a>
    </div>
</nav>
<?php while ($comentario = mysqli_fetch_array($todosComentarios)): ?>
    <?php

        $comentarioQuery = "SELECT * FROM comentarios INNER JOIN info_comentarios ON comentarios.comentario_id = info_comentarios.comentario_id INNER JOIN materias ON materias.materia_id = info_comentarios.materia_id WHERE comentarios.comentario_id = ".$comentario[0];
        $resultadoComentario = mysqli_query($mysqli, $comentarioQuery);

        $comentarioArray = mysqli_fetch_array($resultadoComentario);

        $etiquetasQuery = "SELECT * FROM etiquetas INNER JOIN etiquetas_comentarios ON etiquetas.etiqueta_id = etiquetas_comentarios.etiqueta_id WHERE etiquetas_comentarios.comentario_id = ".$comentario[0];
        $resultadoEtiquetas = mysqli_query($mysqli,$etiquetasQuery);
    ?>
<div class="container">
    <div class="Card" style="background-color: #36B2F5">
        <div class="UPL">
            <p>Publicado el <?=date("d-M-Y",strtotime($comentarioArray["fecha_creacion"]))?></p>
            <p>Semestre: <?=$comentarioArray["semestre"]?></p>
        </div>
        <div class="UPR">
            <p>Calificación: <?=$comentarioArray["calificacion"]?></p>
            <p>Materia: <?=$comentarioArray["nombre_materia"]?></p>
        </div>
        <div class="tags">
            <?php while ($etiqueta = mysqli_fetch_array($resultadoEtiquetas)): ?>
            <div class="float-start px-2">
                <h3><span class="text-white badge rounded-pill text-bg-warning"><?=$etiqueta["nombre_etiqueta"]?></span></h3>
            </div>
            <?php endwhile?>
        </div>
        <div class="comment">
            <h5>Comentario</h5>
            <p><?=$comentarioArray["comentario"]?></p>
        </div>
    </div>


</div>
<?php endwhile?>

</body>
</html>
