<html>

<head>
  <meta charset="UTF-8">
  <title>Inicio de sesion</title>
  <!-- JavaScript Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link href="../styles/ui/login.css" rel="stylesheet">
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
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Evaluación de alumnos</h2>
                <p class="text-white-50 mb-5">Iniciar sesión como profesor</p>

                <form action="index.php" method="post">
                  <div class="form-outline form-white mb-4">
                    <input type="text" id="user" name="user" class="form-control form-control-lg" />
                    <label class="form-label" for="user">Usuario</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="password" name="pass" class="form-control form-control-lg" />
                    <label class="form-label" for="password" value="contraseña">Contraseña</label>
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
  <?php
  // put your code here
  ?>
</body>

</html>