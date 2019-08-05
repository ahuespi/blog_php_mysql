<aside id="sidebar">

    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']   ?></h3>
            <!-- Botones-->
            <a href="crear-entradas.php" class="boton boton-verde">Crear Entradas</a>
            <a href="crear-categoria.php" class="boton boton-azul">Crear Categoria</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis Datos</a>
            <a href="logout.php" class="boton boton-rojo">Cerrar sesión</a>

        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])) : ?>
        <div id="login" class="bloque">
            <h3>Log In</h3>

            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login'] ?>
                </div>
            <?php endif; ?>


            <form action="login.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" />
                <label for="password">Password</label>
                <input type="password" name="password" />
                <input type="submit" value="Entrar" />
            </form>
        </div>
        <div id="register" class="bloque">
            <h3>Sign In</h3>

            <?php if (isset($_SESSION['completado'])) : ?>

                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>

            <?php elseif (isset($_SESSION['errores']['general'])) : ?>

                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>

            <?php endif; ?>

            <form action="registro.php" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>

                <label for="email">Email</label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Password</label>
                <input type="password" name="password" />
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit" name="submit" value="Registrar" />
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>