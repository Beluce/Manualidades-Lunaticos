<?php
require "conexion.php";

$id_admin = $_POST['id_admin'];

// Verificar si el ID está presente
if (isset($id_admin) && is_numeric($id_admin)) {
    // Consulta para eliminar el administrador por ID
    $consulta_sql = "DELETE FROM administrador WHERE id_admin = ?";
    
    if ($stmt = $conexion->prepare($consulta_sql)) {
        $stmt->bind_param("i", $id_admin);
        
        if ($stmt->execute()) {
            // Redirigir con status de éxito
            header("Location: ../admin?status=delete_success");
        } else {
            // Redirigir con status de error en la eliminación
            header("Location: ../admin?status=delete_error");
        }

        $stmt->close();
    } else {
        // Redirigir con status de error general
        header("Location: ../admin?status=delete_error");
    }
} else {
    // Redirigir con status de error general si no se recibe el ID
    header("Location: ../admin?status=delete_error");
}

$conexion->close();
exit();
?>
