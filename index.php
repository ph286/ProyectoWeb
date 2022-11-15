<?php

$isLogIn = isset($_SESSION["id"]);

$carreras = [
    [
        "nombre" => "Ingeniería en Software",
        "imgPath" => "assets/software.png"
    ],
    [
        "nombre" => "Enseñanza de las matemáticas",
        "imgPath" => "assets/enseñanzaMates.png"
    ],
    [
        "nombre" => "Actuaría",
        "imgPath" => "assets/actuaria.svg"
    ],
    [
        "nombre" => "Ciencias de la computación",
        "imgPath" => "assets/cienciascomputo.svg"
    ],
    [
        "nombre" => "Ingeniería de en computación",
        "imgPath" => "assets/ingecomputo.png"
    ],
    [
        "nombre" => "Matemáticas",
        "imgPath" => "assets/mate.png"
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" type="text/css" href="./styles/ui/cards.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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
                <img src="../ProyectoWeb/assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy" />
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
                    <button type="button" class="btn btn-link px-3 me-2">
                        Iniciar sesión
                    </button>
                    <button type="button" class="btn btn-primary me-3">
                        Registrarse
                    </button>
                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>

    <div class="cardGroup">
        <div class="container">
            <div class="row row-cols-2 row-cols-md-5 g-4">
                <?php foreach ($carreras as $carrera) : ?>
                    <div class="Card">
                        <br>
                        <h5 class="card-title"><?= $carrera["nombre"] ?></h5>
                        <br>
                        <figure>
                            <img src=<?= $carrera["imgPath"] ?>>
                        </figure>
                        <div class="contenido">
                            <h6 class="card-subtitle mb-2 text-muted">Mejores calificados</h6>
                            <div class="row">
                                <div class="name">
                                    <p>JUAN RUEDA</p>
                                </div>
                                <div class="tags">
                                    <span class="badge rounded-pill bg-warning text-dark">#Proactivo</span>
                                    <span class="badge rounded-pill bg-warning text-dark">#Creativo</span>
                                    <span class="badge rounded-pill bg-warning text-dark">#Ordenado</span>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>