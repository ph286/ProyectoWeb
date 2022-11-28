<?php
    session_start();

    $isLogIn = isset($_SESSION["id"]);

    $location = "Location: ";

    if ($isLogIn && $_SESSION["type"] != "user") {
        if ($_SESSION["type"] == "admin") $location .= "src/admin.php";
        if ($_SESSION["type"] == "editor") $location .= "src/editor.php";
    } else {
        $location .= "funator.php";
    }

    header($location);