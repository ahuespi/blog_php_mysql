<?php require_once 'includes/header.php'; ?>

<?php require_once 'includes/lateral.php'; ?>
<div id="principal">
    <h1>Ultimas Entradas</h1>
    <?php
    $entradas = conseguirUltimasEntradas($db);
    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) : ?>
            <article class="entrada">
                <a href="http://">
                    <h2><?= $entrada['titulo'] ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . " | " . $entrada['fecha'] ?> </span>
                    <p><?= substr($entrada['descripcion'], 0, 180)."..." ?></p>
                </a>
            </article>
        <?php
        endwhile;
    endif;
    ?>

    <div id="ver-todas"><a href="">Ver todas las entradas</a></div>
    <div class="clearfix"></div>
</div>

<?php require_once 'includes/pie.php'; ?>