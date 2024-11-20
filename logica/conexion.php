<?php
$host_db = "localhost";
$user_name = "root";
$user_pass = "password del usuario";
$db_name = "lunaticos_db";

$conexion = new mysqli($host_db, $user_name, $user_pass, $db_name);

if ($conexion->connect_error) {
  echo "<h1>
                No se pudo establecer la conexión con la base de datos.
              </h1>";
  die();
}
?>