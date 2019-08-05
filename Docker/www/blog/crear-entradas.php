<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1>Crear Entradas</h1>

    <br /><span class="fecha">Añade nuevas entradas al blog</p><br />

        <form action="guardar-entrada.php" method="post">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" />
            <?php echo isset($_SESSION['errores_entradas']) ? mostrarErrores($_SESSION['errores_entradas'], 'titulo') : ''; ?>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion"></textarea>
            <?php echo isset($_SESSION['errores_entradas']) ? mostrarErrores($_SESSION['errores_entradas'], 'descripcion') : ''; ?>

            <label for="categoria">Categoria</label>
            <select name="categoria">

                <?php
                $categorias = conseguirCategoria($db);
                if (!empty($categorias)) :
                    while ($categoria = mysqli_fetch_assoc($categorias)) :    ?>

                    <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
                <?php endwhile;
                endif; ?>

            </select>
            <?php echo isset($_SESSION['errores_entradas']) ? mostrarErrores($_SESSION['errores_entradas'], 'categorias') : ''; ?>
            <input type="submit" value="Guardar">
        </form>
        <?php borrarErrores() ?>
</div>

<?php require_once 'includes/pie.php'; ?>