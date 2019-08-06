<?php
# CONEXION A DB
if (isset($_POST)) {
    require_once 'includes/conexion.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    # MYSQLI_REAL_ESCAPE_STRING (CUANDO LE PASAS UN STRING con caracteres lo convierte a string)
    # Si intentas meter datos comillas o lo que sea para romper la seguridad de la consulta que estas haciendo, le das seguridad escapando los datos.

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

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

    // VALIDAR CONTRASEÑA
    if (!empty($password) && preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,15}$/', $password)) {
        $password_validado = true;
    } else if (empty($password)) {
        $errores['password'] = 'La contraseña esta vacia';
    } else {
        $password_validado = false;
        $errores['password'] = '* Puede contener letras y números <br/>
            * Debe contener al menos 1 número y 1 letra <br/>
            * Debe contener al menos un caracter @#\-_$%^&+=§!<br/>
            * Debe tener 8-15 caracteres <br/>';
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
