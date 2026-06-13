<?php
session_start();
include_once('../../mvc/v1/models/usuario.php');

// Debugging (comentar en producción)
// echo '<pre>';
// var_dump($_POST);
// echo '</pre><hr>';

$modelo = new Usuario();

// 1. Inicializar siempre el arreglo 'items' para evitar errores undefined
$_SESSION['errores'] = [
    'mantenedor' => 'usuarios',
    'items'      => []
];

// 2. Limpieza básica y validación
$email            = trim($_POST['email'] ?? '');
$name             = trim($_POST['name'] ?? '');
$lastname         = trim($_POST['lastname'] ?? '');
$password         = $_POST['password'] ?? '';
$password_confirm = $_POST['password2'] ?? ''; 
$rol              = trim($_POST['rol'] ?? '');

if ($email === "") {
    $_SESSION['errores']['items']['email'] = 'Debe ingresar un email';
}
if ($name === "") {
    $_SESSION['errores']['items']['name'] = 'Debe ingresar un nombre';
}
if ($lastname === "") {
    $_SESSION['errores']['items']['lastname'] = 'Debe ingresar un apellido';
}
if ($password === "" || $password !== $password_confirm) {
    $_SESSION['errores']['items']['password'] = 'Las contraseñas no coinciden o están vacías';
}

// Debugging de sesión (comentar en producción)
// echo '<pre>'; var_dump($_SESSION); echo '</pre><hr>';

// 3. Evaluar si hay errores ANTES de llenar el modelo
if (count($_SESSION['errores']['items']) > 0) {
    // echo 'Errores encontrados: ' . count($_SESSION['errores']['items']);
    header("Location: ../");
    
    // CRÍTICO: Detener la ejecución del script aquí
    exit();
}

// 4. Si llegamos aquí, no hay errores. Preparamos el modelo
// echo 'no hay errores...<br>';
$modelo->setNombre($name);
$modelo->setApellido($lastname);
$modelo->setUsername($email); 
$modelo->setPassword($password);
$modelo->setRol($rol);

// 5. Encriptar la contraseña antes de pasarla al modelo 
// (Descomenta estas líneas si necesitas encriptarla)
// $hash = password_hash($password, PASSWORD_DEFAULT);
// $modelo->setPassword($hash);

// 6. Inserción en la base de datos
include_once('../../mvc/v1/conexion.php'); 

if ($modelo->addNew($modelo)) {
    // Éxito: Limpiar los errores de la sesión ya que todo salió bien
    unset($_SESSION['errores']);
    $_SESSION['ok']['msg'] = 'Se creó exitosamente.';
    // echo $_SESSION['ok']['msg'];
    header("Location: ../");
    exit();
} else {
    // echo 'Ocurrió un error al intentar guardar en la base de datos';
    $_SESSION['errores']['items']['general'] = 'Ocurrió un error al intentar guardar en la base de datos';
    header("Location: ../");
    exit();
}
?>