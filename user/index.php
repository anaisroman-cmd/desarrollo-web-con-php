<?php
session_start();

if(!isset($_SESSION['user_id'])){
    //si no hay SESSION es pq no hay usuario
    header("Location: ../");
    exit();
}