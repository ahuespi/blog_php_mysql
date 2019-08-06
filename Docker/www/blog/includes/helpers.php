<?php

// FUNCIONES REUTILIZABLES

function mostrarErrores($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = '<div class="alerta alerta-error">' . $errores[$campo] . '</div>';
    }

    return $alerta;
}

function borrarErrores()
{
    $borrado = false;

    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['errores_entradas'])) {
        $_SESSION['errores_entradas'] = null;
        $borrado = true;
    }
    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = true;
    }

    return $borrado;
}

function conseguirCategoria($conexion)
{
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = [];
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }

    return $resultado;
}

function conseguirUltimasEntradas($conexion)
{
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e " . "INNER JOIN categorias c ON e.categoria_id = c.id " . "ORDER BY e.id DESC LIMIT 4";

    $entradas = mysqli_query($conexion, $sql);


    $resultado = [];

    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }

    return $resultado;
}
