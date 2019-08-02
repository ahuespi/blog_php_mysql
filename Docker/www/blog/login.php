<?php 

// INICIAR LA SESION Y LA CONEXION A LA DB

require_once 'includes/conexion.php';



// recoger datos del formulario

if(isset($_POST)){
    # Limpiar los espacios de adelante y de atras
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            // sesion para guardar los datos del usuario logeado
            $_SESSION['usuario'] = $usuario;
        }
    } else {
        // mensaje de error
    }

    // comprobar la contraseña

}


//coprobar que el email y password cohinciden y si cohinciden logear


// crear una sesion con el fallo