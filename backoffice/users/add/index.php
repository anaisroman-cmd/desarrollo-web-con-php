<?php
// Mantenemos esto para que los errores no se oculten
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../mvc/v1/conexion.php'); 
include_once('../../mvc/v1/models/usuario.php');

$modelo = new Usuario();

// Limpieza de datos
$email            = trim($_POST['email'] ?? '');
$name             = trim($_POST['name'] ?? '');
$lastname         = trim($_POST['lastname'] ?? '');
$password         = $_POST['password'] ?? '';
$rol              = trim($_POST['rol'] ?? 3);

// Asignamos al modelo
$modelo->setNombre($name);
$modelo->setApellido($lastname);
$modelo->setUsername($email); 
$modelo->setPassword($password);
$modelo->setRol($rol);

// Intentamos guardar en la BD
if ($modelo->addNew($modelo)) {
    // Si funciona, te devuelve a la tabla
    header("Location: ../");
    exit();
} else {
    // Si falla y llega aquí, algo muy raro pasó
    die("El método addNew devolvió falso, pero no lanzó error de BD.");
}
?>