<?php
# CONEXION A DB
if (isset($_POST)) {
    require_once 'includes/conexion.php';
    session_start();
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;

    $errores = array();

    // VALIDAR NOMBRE
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    // VALIDAR APELLIDO
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = 'El apellidos no es valido';
    }

    // VALIDAR EMAIL
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = 'El email no es valido';
    }
    // VALIDAR CONTRASEÑA
    if (!empty($password) && preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores['password'] = '* Puede contener letras y números <br/>
            * Debe contener al menos 1 número y 1 letra <br/>
            * Puede contener cualquiera de estos caracteres !@#$% <br/>
            * Debe tener 8-12 caracteres <br/>
        ';
    }
    // VALIDO QUE NO HAYA ERRORES PARA NO TENER INFORMACION INNECESARIA EN LA BASE DE DATOS
    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;
        # CIFRAR LA PASSWORD
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        $sql = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if ($guardar) {
            $_SESSION['completado'] = 'El registro se ha completado con exito';
        } else {
            $_SESSION['errores']['general'] = 'Fallo al guardar el usuario!';
        }

        // INSERTAR USUARIO
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php');
