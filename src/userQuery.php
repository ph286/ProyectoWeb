<?php
    session_start();

    if (!isset($_SESSION["type"])) header("Location: ../");

    if ($_SESSION["type"] != "admin") header("Location: ../");

    if ( isset($_GET["query"]) && isset($_GET["id"])) {

        $mysqli = new mysqli('localhost', 'root', '', 'funator');

        if ($_GET["query"] == "update" && isset($_GET["type"])) {
            $updateQuery = "UPDATE `cuentas` SET `type_account`= '".$_GET["type"]."' WHERE `cuenta_id` = ".$_GET["id"];
            mysqli_query($mysqli, $updateQuery);
        } else if ($_GET["query"] == "delete") {
            $deleteQuery = "DELETE FROM `cuentas` WHERE `cuenta_id` = ".$_GET["id"];
            mysqli_query($mysqli, $deleteQuery);
        }
    }

    header("Location: admin.php");