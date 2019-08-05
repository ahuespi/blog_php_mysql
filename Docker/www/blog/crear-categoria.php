<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <h1>Crear Categoria</h1>

    <br/><span class="fecha">Añade nuevas categorias al blog spanara que los usuarios puedan usarlas al crear sus entradas</p><br/>
    
    <form action="guardar-categoria.php" method="post">
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre" />
        <input type="submit" value="Guardar">
    </form>
</div>

<?php require_once 'includes/pie.php'; ?>