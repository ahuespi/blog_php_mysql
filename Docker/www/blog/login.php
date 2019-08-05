<?php

// INICIAR LA SESION Y LA CONEXION A LA DB

require_once 'includes/conexion.php';

if (isset($_POST)) {
    if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
    }

    // recoger datos del formulario
    # Limpiar los espacios de adelante y de atras
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        $verify = password_verify($password, $usuario['password']);

        if ($verify) {
            // sesion para guardar los datos del usuario logeado
            $_SESSION['usuario'] = $usuario;
        } else {
            $_SESSION['error_login'] = 'Login Incorrecto!';
        }
    } else {
        $_SESSION['error_login'] = 'Login Incorrecto!';
    }
}

header('Location: index.php');
