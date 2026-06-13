<?php

session_start();
include_once '../../mvc/v1/models/usuario.php';
include_once('../../mvc/v1/conexion.php');

$modelo = new Usuario();

echo 'Encender<br>';

var_dump($_POST['id']);

echo 'Respuesta:' . $modelo->powerOFF($_POST['id']);

$_SESSION['ok']['msg'] = 'Se apagó exitosamente.';
echo $_SESSION['ok']['msg'];
header("Location: ../");
exit();
