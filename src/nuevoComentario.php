<?php

    session_start();

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
    }

    $createComentario = "INSERT INTO comentarios (semestre, comentario, calificacion) VALUES ('$semestre', '$comentario', '$calificacion')";

    mysqli_query($mysqli, $createComentario);
    $fechaDeCreacion = date_create('now', new DateTimeZone('America/Merida'));
    $comentarioIDQuery = "SELECT comentario_id FROM comentarios WHERE fecha_creacion > '".date_format($fechaDeCreacion, "Y-m-d H:i:S")."'";
    $comentarioId = mysqli_fetch_row(mysqli_query($mysqli,$comentarioIDQuery))[0];

    $createInfoComentario = "INSERT INTO info_comentarios (comentario_id, cuenta_id, alumno_id, materia_id) VALUES ('$comentarioId', '$cuentaId', '$alumnoID', '$materiaId')";
    mysqli_query($mysqli, $createInfoComentario);

    if (isset($_POST["etiquetas"])) {
        foreach ($_POST["etiquetas"] as $etiqueta) {
            $createEtiquetasComentario = "INSERT INTO etiquetas_comentarios (etiqueta_id, comentario_id) VALUES ('$etiqueta', '$comentarioId')";
            $insertEtiquetasAlumno = "INSERT INTO etiquetas_alumnos (etiqueta_id, alumno_id) VALUES ('$etiqueta', '$alumnoID')";

            mysqli_query($mysqli, $createEtiquetasComentario);
            mysqli_query($mysqli, $insertEtiquetasAlumno);
        }
    }