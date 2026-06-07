<?php

// iniciar o reanudar la sesción del usuario actual
session_start();

if (isset($_SESSION['user_id'])){
    //el ususario está logueado
    header("Location: backoffice/");
    exit(); //siempre que haya un redireccionamiento
} else {
    //si no hay SESSION es pq no hay usuario
    header("Location: user/login");
    exit();
}
?>