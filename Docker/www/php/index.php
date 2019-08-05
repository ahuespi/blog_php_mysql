<?php

# Una sesion es el periodo de tiempo en el que el usuario esta logeado 

    # Almacenar y persistir datos del usuario mientras que navega en un sitio web hasta que cierra sesion o cierra el navegador.

    # Ventajas: Pueden almacenar grandes cantidades de informacion y se almacenan en el servidor web y es invisible al cliente

# INICIAR LA SESION

session_start();

// Variable local
$variable_normal = 'Hola';

// Variable de sesion
$_SESSION['variable_persistente'] = 'Hola 2';

echo $variable_normal."<br />";
echo $_SESSION['variable_persistente']."<br />";