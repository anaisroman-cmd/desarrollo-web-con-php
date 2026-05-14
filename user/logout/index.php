<?php

session_start();

//matar la sesion
$_SESSION = array();

session_destroy();

echo 'Largo: ' . count($_SESSION);

if (count($_SESSION)==0){
    header("Location: ../../"); //va a la raíz
    exit();
}