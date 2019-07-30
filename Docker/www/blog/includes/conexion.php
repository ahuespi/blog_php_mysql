<?php

$servidor = 'db';
$usuario = 'user';
$password = 'test';
$basededatos = 'blog';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");


session_start();