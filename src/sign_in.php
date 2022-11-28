<?php

    session_start();

    if (isset($_SESSION['id'])){
        header("Location: ../");
    }

    $errorCode = 0;

    $email = "";
    $password = "";

    $isTryingToSignIn = isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']);

    if ($isTryingToSignIn) {

        $isSamePassword = $_POST['password'] == $_POST['password2'];

        if ($isSamePassword) {
            $mysqli = new mysqli('localhost', 'root', '', 'funator');
            $email = $_POST['email'];
            $password = $_POST['password'];
            $insert_query = "INSERT INTO `cuentas`(`email`, `password`) VALUES ('$email','$password')";

            try {
                mysqli_query($mysqli, $insert_query);

                $getUser = "SELECT * FROM `cuentas` WHERE `email` = '$email'";
                $result = mysqli_query($mysqli, $getUser);

                $user = mysqli_fetch_row($result);

                $_SESSION['id'] = $user[0];
                $_SESSION['email'] = $email;
                $_SESSION['type'] = $user[3];

                header("Location: ../");

            } catch (mysqli_sql_exception $e) {
                $errorCode = $e->getCode();
            }
        } else {
            $errorCode = 1;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
    }

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Funator - Crear una cuenta</title>
    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="../styles/ui/login.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div>
            <a class="navbar-brand" href="../funator.php">
                <img src="../assets/Funator.png" class="me-2" height="50" alt="Funator Logo" loading="lazy"/>
            </a>
        </div>

        <div>
            <a href="login.php">
                <button type="button" class="btn btn-link px-3 me-2">
                    Iniciar sesión
                </button>
            </a>
        </div>
    </div>
</nav>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Crea una cuenta</h2>

                            <form action="sign_in.php" method="post">
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="email">Email</label>
                                        <?php if($errorCode == 1062): ?>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg is-invalid"/>
                                        <div class="invalid-feedback">
                                            Esta correo ya esta registrado
                                        </div>
                                        <?php else: ?>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php echo $email?>"/>
                                        <?php endif?>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="password">Contraseña</label>
                                    <input type="password" id="password" name="password"
                                           class="form-control form-control-lg" value="<?php echo $password?>"/>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="password2">Confirma tu constraseña</label>
                                    <?php if($errorCode == 1): ?>
                                        <input type="password" id="password2" name="password2" class="form-control form-control-lg is-invalid"/>
                                        <div class="invalid-feedback">
                                            Las contraseñas no coinciden
                                        </div>
                                    <?php else: ?>
                                        <input type="password" id="password2" name="password2" class="form-control form-control-lg"/>
                                    <?php endif?>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Crear cuenta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>