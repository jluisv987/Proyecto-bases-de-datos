<?php
//este archivo conecta la base de datos con la pagina
//conecta a la base de datos
$db_host = 'localhost';
$db_name = 'libros_bd';
$db_user = 'root';
$db_pass = '';

$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);

//error de conexion
if(mysqli_connect_errno()){
    echo 'Hay un problema al conectarse con la base de datos'.mysqlil_connect_error();
    die();
}
 ?>
