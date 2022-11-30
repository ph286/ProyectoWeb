<?php

    session_start();

    $isLogIn = isset($_SESSION["id"]);

    if ($isLogIn && $_SESSION["type"] != "user") {
        header("Location: ./");
    }

    $mysqli = new mysqli('localhost', 'root', '', 'funator');
    $carrerasQuery = "SELECT `nombre_carrera` FROM `carreras`";

    $result = mysqli_query($mysqli, $carrerasQuery);

    $carreras = [
        ["imgPath" => "assets/software.png"],
        ["imgPath" => "assets/enseñanzaMates.png"],
        ["imgPath" => "assets/actuaria.svg"],
        ["imgPath" => "assets/cienciascomputo.svg"],
        ["imgPath" => "assets/ingecomputo.png"],
        ["imgPath" => "assets/mate.png"]
    ];

    foreach ($carreras as $indice => $carrera) {
        $carrera["nombre"] = mysqli_fetch_array($result)[0];
        $carreras[$indice] = $carrera;
    }

    $bestStudentsQuery = "SELECT a.alumno_id, a.nombre_alumno, a.carrera_id FROM alumnos a WHERE a.promedio = (SELECT MAX(promedio) FROM alumnos b WHERE a.carrera_id = b.carrera_id) ORDER BY a.carrera_id";
    $bestStudentsResult = mysqli_query($mysqli, $bestStudentsQuery);
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
            background-color: #8536F5;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="funator.php">
                <img src="../ProyectoWeb/assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy" />
            </a>

            <?php if(!$isLogIn) : ?>
            <div class="d-flex align-items-center">
                <a href="./src/login.php">
                    <button type="button" class="btn btn-link px-3 me-2">
                        Iniciar sesión
                    </button>
                </a>
                <a href="./src/sign_in.php">
                    <button type="button" class="btn btn-primary me-3">
                        Registrarse
                    </button>
                </a>
            </div>
            <?php else: ?>
                <a href="src/logout.php">
                    <button type="button" class="btn btn-link px-3 me-2">
                        Cerrar sesión
                    </button>
                </a>
            <?php endif ?>
        </div>
        <!-- Container wrapper -->
    </nav>

    <br><br>
    <div class="cardGroup">
        <div class="container">
            <div class="row row-cols-2 row-cols-md-5 g-4">
                <?php foreach ($carreras as $carrera) : ?>
                    <?php
                        try {
                            $student = mysqli_fetch_array($bestStudentsResult);
                            $studentLabelsQuery = "SELECT nombre_etiqueta FROM etiquetas JOIN etiquetas_alumnos ON etiquetas.etiqueta_id = etiquetas_alumnos.etiqueta_id WHERE etiquetas_alumnos.alumno_id = " . $student["alumno_id"];

                            $studentLabelsResult = mysqli_query($mysqli, $studentLabelsQuery);
                        } catch (mysqli_sql_exception $e) {}
                    ?>
                    <div class="Card">
                        <a class="text-decoration-none" href="src/carrera.php?carrera=<?=$carrera["nombre"]?>">
                            <br>
                            <h5 class="card-title text-dark"><?= $carrera["nombre"] ?></h5>
                            <br>
                            <figure>
                                <img src="<?= $carrera["imgPath"] ?>" alt="<?= $carrera["nombre"] ?>">
                            </figure>
                            <div class="contenido">
                                <h6 class="card-subtitle mb-2 text-muted">Mejor calificado</h6>
                                <div class="row">
                                    <div class="name">
                                        <p class="text-dark"><?=$student["nombre_alumno"]?></p>
                                    </div>
                                    <div class="tags">
                                        <?php try {?>
                                        <?php while($label = mysqli_fetch_array($studentLabelsResult)):?>
                                            <span class="badge rounded-pill bg-warning text-dark"><?=$label["nombre_etiqueta"]?></span>
                                        <?php endwhile?>
                                        <?php } catch(mysqli_sql_exception $e){}?>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>