<?php
    if (!isset($_GET["carrera"])) header("Location: ../");

    $carrera = $_GET["carrera"];
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
    <title>Funator <?=$carrera?></title>
</head>
<body>
<div class="container">
    <div class="Card">
        <div class="left">
            <h4>CALIDAD GENERAL</h4>
            <h1>8.5</h1>
        </div>
        <div class="center">
            <p>LO RECOMIENDAN</p>
            <h5>100%</h5>
            <p>NIVEL DE DIFICULTAD</p>
            <h5>3.0</h5>
        </div>
        <div class="right">
            <h3>ETIQUETAS PARA ESTE ALUMNO</h3>
            <p>Descubre como otros describen a este alumno</p>
            <div class="tag">
                <h3>#Proactivo</h3>
            </div>
            <div class="tag">
                <h3>#Creativo</h3>
            </div>
            <div class="tag">
                <h3>#Ordenado</h3>
            </div>
            <div class="tag">
                <h3>#Perseverante</h3>
            </div>
            <div class="tag">
                <h3>#Responsable</h3>
            </div>
        </div>

    </div>

</div>

</div>
</div>
</body>
</html>
