<?php

    if (isset($_POST["nombre"]) && isset($_POST["carreraID"])) {
        $name = $_POST["nombre"];
        $carreraID = $_POST["carreraID"];
        $searchQuery = "SELECT alumno_id FROM alumnos WHERE nombre_alumno = '$name' AND carrera_id = '$carreraID'";

        $mysqli = new mysqli('localhost', 'root', '', 'funator');

        $exist = mysqli_query($mysqli, $searchQuery)->num_rows > 0;

        if ($exist) {
            echo "false";
        } else {
            echo "true";
        }
    } else {
        header("Location: ../");
    }
