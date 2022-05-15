<?php
    require '../session.php';
    if(!isset($_SESSION["username"])){
        header("Location:../login.php");
    }

    if($_SESSION["type"] != 1) {
        // include '../logout.php';
        http_response_code(404);
        die();
    }
?>