<?php

//CONEXIÓN A LA BASE DE DATOS
$hostname_db = "localhost";
$database_db = "calculadora_cuotas";
$username_db = "root";
$password_db = "";

$conexion = mysqli_connect($hostname_db, $username_db, $password_db);
mysqli_select_db($conexion, $database_db) or die("Ninguna DB seleccionada");
