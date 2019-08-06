<?php require_once 'conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <!-- CABECERA -->
    <header id="cabecera">
        <div id="logo">
            <a href="index.php">
                <h1>.</h1>
            </a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <!-- MYSQLI_FETCH_ASSOC, SACA UN ARRAY ASOCIATIVO -->
                <?php
                $categorias = conseguirCategoria($db);
                if (!empty($categorias)) :
                    while ($categoria = mysqli_fetch_assoc($categorias)) :
                        ?>
                        <li><a href="categoria.php?id=<?= $categoria['id']; ?>"><?= $categoria['nombre'] ?></a></li>
                    <?php
                    endwhile;
                endif;  ?>
                <li><a href="index.php">Sobre Mi</a></li>
                <li><a href="index.php">Contacto</a></li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>

    <div id="contenedor">