<?php
require "./conexion.php";
mysqli_set_charset($conexion, 'utf8');

$tipo_producto = $_POST['tipo_producto'];
$color = $_POST['color'];

// Verificar si el producto ya está registrado
$buscarProducto = "SELECT * FROM producto WHERE tipo_producto = '$tipo_producto' AND color = '$color'";
$resultado = $conexion->query($buscarProducto);
$count = mysqli_num_rows($resultado);

if ($count == 1) {
    $message = "error";  // Producto ya registrado
} else {
    $query = "INSERT INTO producto (
                tipo_producto, materiales_principales, tamaño, peso, color, estilo, precio_venta, costo_produccion, inventario_disponible
              ) VALUES (
                '$_POST[tipo_producto]', 
                '$_POST[materiales_principales]', 
                '$_POST[tamaño]', 
                '$_POST[peso]', 
                '$_POST[color]', 
                '$_POST[estilo]', 
                '$_POST[precio_venta]', 
                '$_POST[costo_produccion]', 
                '$_POST[inventario_disponible]'
              )";

    if (mysqli_query($conexion, $query)) {
        $message = "success";  // Producto registrado exitosamente
    } else {
        $message = "insert_error";  // Error en la inserción
    }
}

mysqli_close($conexion);

// Redirigir con el estado como parámetro
header("Location: ../admin?status=$message");
exit();
?>