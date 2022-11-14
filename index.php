<?php

$isLogIn = isset($_SESSION["id"]);

$carreras = [
    [
        "nombre" => "Ingeniería en Software",
        "imgPath" => "assets/software.webp"
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta lang="es" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funator Califica a tus compañeros</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" type="text/css" href="./styles/ui/cards.css">
    <style>
      * {
        font-family: 'Inter', serif;
      } 
    </style>
</head>
<body>
    <header>
        <h1>Funator</h1>
    </header>
    <div class="container">
        <?php foreach($carreras as $carrera): ?>
            <div class="Card">
                <h1><?= $carrera["nombre"] ?></h1>
                <figure>
                    <img src=<?= $carrera["imgPath"]?>>
                </figure>
                <div class="contenido">
                    <h2>Mejores calificados</h2>
                    <div class="row">
                        <div class="name">
                            <p>JUAN RUEDA</p>
                        </div>
                        <div class="tags">
                            <div class="tag">
                                <h3>#Proactivo</h3>
                            </div>
                            <div class="tag">
                                <h3>#Creativo</h3>
                            </div>
                            <div class="tag">
                                <h3>#Ordenado</h3>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
	</div>
</body>
</html>