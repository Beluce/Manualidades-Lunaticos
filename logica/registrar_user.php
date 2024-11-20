<?php
require "conexion.php";
mysqli_set_charset($conexion, 'utf8');

if (isset($_POST['usuario'], $_POST['correo'], $_POST['contrasena'])) {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $buscarUsuario = "SELECT * FROM administrador WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($buscarUsuario);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $message = "error";
    } else {
        $query = "INSERT INTO administrador (nombre_usuario, email, password) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sss", $usuario, $correo, $contrasena);

        if ($stmt->execute()) {
            $message = "success";
        } else {
            $message = "insert_error";
        }
    }

    $stmt->close();
    $conexion->close();

    header("Location: ../mostrar_login.php?status=$message");
    exit();
} else {
    header("Location: ../mostrar_login.php?status=missing_fields");
    exit();
}
