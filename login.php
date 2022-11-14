<!DOCTYPE html>
<html>
<head>
    <meta lang="es" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="contenedor">
        <div id="cabecera"><h1>"Evaluación de alumnos"</h1></div>
        <div id="menu">
            <h1>*menu*</h1><br><br>
            <h6>Opcion 1</h6><br><br>
            <h6>Opcion 2</h6><br><br>
            <h6>Opcion 3</h6><br><br>
            <h6>Opcion 4</h6><br><br>
        </div>
        <div id="contenido">
            <form action="">
                <h1 class="title">Iniciar sesión como profesor</h1>
                <label>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" placeholder="Usuario" type="text" id="Usuario">
                </label>
                <label>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Contraseña" type="password" id="Contraseña">
                </label>
        
                <button id="Boton">Ingresar</button>
            </form>
        </div>
        <div id="pie">
            <br>
            <br>
            <br>
            <br>
            <p>© FMAT 2022</p>
        </div>
    </div>
    
    
    <script src="scripts/main.js"></script>
</body>
</html>