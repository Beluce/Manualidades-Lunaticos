<?php
require "conexion.php";
mysqli_set_charset($conexion, 'utf8');

// Obtener el ID del producto a eliminar
$id_producto = $_POST['id_producto'];

// Consulta para eliminar el producto
$consulta = "DELETE FROM producto WHERE id_producto = '$id_producto'";

// Ejecutar la consulta y verificar si fue exitosa
if (mysqli_query($conexion, $consulta)) {
    $message = "delete_success";  // Eliminación exitosa
} else {
    $message = "delete_error";  // Error al eliminar
}

mysqli_close($conexion);

// Redirigir con el estado de la operación
header("Location: ../admin?status=$message");
exit();
