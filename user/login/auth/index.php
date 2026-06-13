<?php

session_start();

if (isset($_SESSION['user_id'])){
    //el ususario ya está logueado
    header("Location: ../../../dashboard/");
    exit(); //siempre que haya un redireccionamiento
}
    
$formUsername = $_POST['username'];
$formPassword = $_POST['password'];
    
$user = 'proyecto@web.cl';
$pass = 'holamundo';

if ($user === $formUsername && $pass === $formPassword){
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Profe :)';

    $_SESSION['error'] = ['login' => ''];
    $_SESSION['errores'] = ['items' => []];

    header("Location: ../../../backoffice/");
    exit();
}

$_SESSION['error'] = ['login' => 'Usuario o contraseña incorrectos'];

header("Location: ../");
