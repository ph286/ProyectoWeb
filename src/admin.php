<?php
    session_start();

    if (!isset($_SESSION["id"])) header("Location: ../");

    $isAdmin = $_SESSION["type"] == "admin";

    if (!$isAdmin) header("Location: ../");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funator admin page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">Funator</a>
            
            <div>
                Admin page
            </div>
        </div>
    </nav>

    <div class="px-4 pt-5 my-5 text-center container">
        <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Estatus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            </tr>
        </tbody>
        </table>
    </div>
</body>
</html>