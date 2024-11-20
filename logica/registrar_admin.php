<?php
require "conexion.php";

$usuario = $_POST['nombre_usuario'];
$correo = $_POST['email'];
$contrasena = $_POST['password'];

$consulta_sql = "INSERT INTO administrador (nombre_usuario, email, password) VALUES (?, ?, ?)";

if ($stmt = $conexion->prepare($consulta_sql)) {
    $stmt->bind_param("sss", $usuario, $correo, $contrasena);
    
    if ($stmt->execute()) {
        header("Location: ../admin?status=success");
    } else {
        header("Location: ../admin?status=insert_error");
    }

    $stmt->close();
} else {
    header("Location: ../admin.php?status=error");
}

$conexion->close();
exit();
?>
