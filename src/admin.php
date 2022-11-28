<?php
    session_start();

    if (!isset($_SESSION["id"])) header("Location: ../");

    $isAdmin = $_SESSION["type"] == "admin";

    if (!$isAdmin) header("Location: ../");

    $mysqli = new mysqli('localhost', 'root', '', 'funator');
    $usersQuery = "SELECT `cuenta_id`,`email`,`type_account` FROM `cuentas` WHERE `type_account` <> 'admin'";

    $usersResult = mysqli_query($mysqli, $usersQuery);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funator admin page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        * {
            font-family: 'Inter', serif;
        }
        
        body {
            background-color: #8536F5;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body>
    
    <nav class="navbar bg-light">
        <div class="container-fluid">
            Admin page
            <div>
                <a href="logout.php">
                    <button type="button" class="btn btn-link px-3 me-2">
                        Cerrar sesión
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <div class="px-4 pt-4 my-4 text-center container">
        <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Tipo de cuenta</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user = mysqli_fetch_array($usersResult)):?>
                <tr>
                    <td><?= $user[0]?></td>
                    <td><?= $user[1]?></td>
                    <td><?= $user[2]?></td>
                    <td>
                        <?php if($user[2] == "user") {
                            $value =  $text = "editor";
                            $styleButton = "btn-primary";
                        } else {
                            $value = "user";
                            $text = "usuario";
                            $styleButton = "btn-info";
                        }?>
                        <div>
                            <a href="userQuery.php?id=<?=$user[0]?>&type=<?=$value?>&query=update">
                                <button type="submit" class="btn <?=$styleButton?>">
                                    Convertir a <?= $text?>
                                </button>
                            </a>

                            <a href="userQuery.php?id=<?=$user[0]?>&query=delete">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                    Eliminar cuenta
                                </button>
                            </a>
                        </div>
                    </td>
                    </tr>
                <tr>
            <?php endwhile?>
        </tbody>
        </table>
    </div>
</body>
</html>