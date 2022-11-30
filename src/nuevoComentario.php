<?php

    session_start();

    if (!isset($_SESSION["id"]) || $_SESSION["type"] != "user") header("Location: ../");

    $cuentaId = $_SESSION["id"];

    $nombre = $_POST["nombre"];
    $semestre = $_POST["semestre"];
    $carreraID = $_POST["carreraID"];
    $comentario = $_POST["comentario"];
    $calificacion = $_POST["calificacion"];
    $materiaId = $_POST["materiaID"];

    $mysqli = new mysqli('localhost', 'root', '', 'funator');

    if (!isset($_POST["alumno_id"])) {
        $createUserQuery = "INSERT INTO alumnos (carrera_id, nombre_alumno, promedio) VALUES ('$carreraID', '$nombre', ".$calificacion.")";
        mysqli_query($mysqli, $createUserQuery);

        $userIdQuery = "SELECT alumno_id FROM alumnos WHERE carrera_id = '$carreraID' AND nombre_alumno = '$nombre'";
        $alumnoID = mysqli_fetch_row(mysqli_query($mysqli, $userIdQuery))[0];
    } else {
        $alumnoID = $_POST["alumno_id"];

        $calificacionesQuery = "SELECT comentarios.calificacion FROM info_comentarios INNER JOIN comentarios ON info_comentarios.comentario_id = comentarios.comentario_id WHERE info_comentarios.alumno_id = '$alumnoID'";
        $calificacionesResult = mysqli_query($mysqli, $calificacionesQuery);

        $promedio = $calificacion;
        $cantidad = 1;
        while ($resultado = mysqli_fetch_array($calificacionesResult)) {
            $promedio += $resultado[0];
            $cantidad++;
        }

        $promedio /= $cantidad;

        $updatePromedioQuery = "UPDATE alumnos SET promedio = '$promedio' WHERE alumno_id = '$alumnoID'";
        mysqli_query($mysqli, $updatePromedioQuery);
    }

    $comentarioId = date_create()->getTimestamp();
    $createComentario = "INSERT INTO comentarios (comentario_id, semestre, comentario, calificacion) VALUES ('$comentarioId','$semestre', '$comentario', '$calificacion')";
    mysqli_query($mysqli, $createComentario);

    $createInfoComentario = "INSERT INTO info_comentarios (comentario_id, cuenta_id, alumno_id, materia_id) VALUES ('$comentarioId', '$cuentaId', '$alumnoID', '$materiaId')";
    mysqli_query($mysqli, $createInfoComentario);

    if (isset($_POST["etiquetas"])) {
        foreach ($_POST["etiquetas"] as $etiqueta) {
            $createEtiquetasComentario = "INSERT INTO etiquetas_comentarios (etiqueta_id, comentario_id) VALUES ('$etiqueta', '$comentarioId')";
            $insertEtiquetasAlumno = "INSERT INTO etiquetas_alumnos (etiqueta_id, alumno_id) VALUES ('$etiqueta', '$alumnoID')";

            mysqli_query($mysqli, $createEtiquetasComentario);
            try {
                mysqli_query($mysqli, $insertEtiquetasAlumno);
            } catch (mysqli_sql_exception $exception){}
        }
    }

    echo $alumnoID;