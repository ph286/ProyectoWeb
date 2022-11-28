<?php

    session_start();

    if (isset($_SESSION['id'])){
        header("Location: ../");
    }

    $error = 0;
    $email = "";
    $password = "";

    $isTryingToLogIn = isset($_POST['email']) && isset($_POST['password']);

    if ($isTryingToLogIn) {

        $mysqli = new mysqli('localhost', 'root', '', 'funator');

        $email = $_POST['email'];
        $password = $_POST['password'];

        $getIdQuery = "SELECT * FROM `cuentas` WHERE `email` = '$email' AND `password` = '$password'";

        try {
            $queryResult = mysqli_query($mysqli, $getIdQuery);
            $user = mysqli_fetch_row($queryResult);

            if (isset($user[0])) {
                $_SESSION['id'] = $user[0];
                $_SESSION['email'] = $email;
                $_SESSION['type'] = $user[3];
                header("Location: ../");
            } else {
                $error = 1;
            }

        } catch (mysqli_sql_exception $e) {
            $error = $e->getCode();
        }
    }
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Funator - Inicio de sesión</title>
  <!-- JavaScript Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
            <a href="sign_in.php">
                <button type="button" class="btn btn-primary me-3">
                    Registrarse
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

                <h2 class="fw-bold mb-2 text-uppercase">Inicia sesión</h2>

                <form action="login.php" method="post">
                  <div class="form-outline form-white mb-4">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control form-control-lg
                        <?php if($error != 0): ?>
                            is-invalid"
                        <?php endif?>
                             value="<?= $email?>"
                      />
                  </div>

                  <div class="form-outline form-white mb-4">
                      <label class="form-label" for="password" value="contraseña">Contraseña</label>
                      <input type="password" id="password" name="password" class="form-control form-control-lg
                        <?php if($error != 0): ?>
                            is-invalid"
                        <?php endif?>
                        value="<?= $password?>"
                      />
                      <?php if($error != 0): ?>
                          <div class="invalid-feedback">
                              Correo y/o contraseña invalidos
                          </div>
                      <?php endif?>
                  </div>
                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Iniciar sesión</button>
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