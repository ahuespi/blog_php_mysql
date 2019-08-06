<?php
# CONEXION A DB
if (isset($_POST)) {
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

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
        $searchEmail = "SELECT * from usuarios WHERE email='$email'";
        $data = mysqli_query($db, $searchEmail);
        $row = mysqli_num_rows($data);
        if ($row == 1) {
            $email_validado = false;
            $errores['email'] = 'El email ya existe';
        } else {
            $email_validado = true;
        }
    } else {
        $email_validado = false;
        $errores['email'] = 'El email no es valido';
    }

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;

        // Comprobar que el email ya existe

        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        if ($isset_user['id'] == $usuario['id'] || empty($isset_user)) {
            $usuario = $_SESSION['usuario'];
            $sql = "UPDATE usuarios SET " .
                "nombre = '$nombre', " .
                "apellidos = '$apellidos', " .
                "email = '$email' " .
                "WHERE id = " . $usuario['id'];

            $guardar = mysqli_query($db, $sql);


            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = 'Actualizado correctamente!';
            } else {
                $_SESSION['errores']['general'] = 'Fallo al actualizar el usuario!';
            }
        } else {
            $_SESSION['errores']['general'] = 'El usuario ya existe!';
        }


        // INSERTAR USUARIO
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('Location: mis-datos.php');
