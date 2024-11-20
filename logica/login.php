<?php
require 'conexion.php';
session_start();

// Recibir los datos del formulario
$usuario = $_POST['user'];
$clave = $_POST['password'];

// Verificar si las credenciales son correctas
$q = "SELECT COUNT(*) as contar FROM administrador WHERE nombre_usuario = '$usuario' AND password = '$clave'";

$consulta = mysqli_query($conexion, $q);

$array = mysqli_fetch_array($consulta);

// Si las credenciales son correctas, iniciar sesión
if ($array['contar'] > 0) {
    $_SESSION['username'] = $usuario; // Guardar el usuario en la sesión
    header("location: ../admin"); // Redirigir a la página principal
} else {
    // Si las credenciales no son correctas, redirigir a la página de error
    header("location: ../indexError.php"); // Página de error de login
}
?>
