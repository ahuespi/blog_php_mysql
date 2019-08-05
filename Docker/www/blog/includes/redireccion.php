<?php
/*
 Inicias la sesion, si no existe una sesion de usuario, lo redirige al index, y no le permite acceder a crear categoria
*/
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
}
