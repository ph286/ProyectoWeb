<?php

    session_start();

    $isLogIn = isset($_SESSION["id"]);

    if (!isset($_GET["carrera"])) header("Location: ../");

    $carrera = $_GET["carrera"];

    $mysqli = new mysqli('localhost', 'root', '', 'funator');
    $carreraIdQuery = "SELECT `carrera_id` FROM `carreras` WHERE `nombre_carrera` = '".$_GET["carrera"]."'";

    $result = mysqli_query($mysqli, $carreraIdQuery);

    $carrera_id = mysqli_fetch_row($result)[0];

    $alumnosQuery = "SELECT `alumno_id`,`nombre_alumno`,`promedio` FROM `alumnos` WHERE `carrera_id` = '$carrera_id'";
    $result = mysqli_query($mysqli, $alumnosQuery);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../styles/cardAlum.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Funator <?=$carrera?></title>
    <style>
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="../">
            <img src="../assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy" />
        </a>
    </div>
    <!-- Container wrapper -->
</nav>
    <div class="d-flex">
        <h2 class="flex-grow-1 px-lg-5 my-4"><?=$carrera?></h2>
        <?php if($isLogIn) : ?>
        <form action="formulario.php" method="post">
            <button name="carrera_id" value="<?=$carrera_id?>"< type="submit" class="btn btn-primary px-3 me-2 my-4" style="background-color: #2e2b70">
                Comentar otro alumno
            </button>
        </form>
        <?php endif ?>
    </div>
<?php while ($alumno = mysqli_fetch_array($result)): ?>
    <?php
        $countComentariosQuery = "SELECT count(`alumno_id`) FROM `info_comentarios` WHERE `alumno_id` = ".$alumno[0];
        $numeroComentarios = mysqli_fetch_array(mysqli_query($mysqli, $countComentariosQuery))[0];
    ?>
<div class="container">
        <div class="Card" style="background-color: #2F6ED4">
            <a class="text-decoration-none" href="alumno.php?alumno=<?=$alumno[0]?>">
            <div class="left">
                <h4 class="text-black">PROMEDIO</h4>
                <h1 class="text-black"><?= $alumno[2] ?></h1>
            </div>
            <div class="center">
                <p class="text-black">No. de comentarios</p>
                <h5 class="text-black"><?= $numeroComentarios ?></h5>
            </div>
            <div class="right">
                <h3 class="text-black"><?= strtoupper($alumno[1]) ?></h3>
                <h3><span class="text-white badge rounded-pill text-bg-warning">Proactivo</span></h3>
            </div>
            </a>
        </div>

</div>
<?php endwhile ?>
</body>
</html>