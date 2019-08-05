<?php

$servidor = 'db';
$usuario = 'user';
$password = 'test';
$basededatos = 'blog';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");

if (!isset($_SESSION)) {
    session_start();
}