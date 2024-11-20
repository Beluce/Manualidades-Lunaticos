<?php
require "conexion.php";
mysqli_set_charset($conexion, 'utf8');

$idProducto = $_POST['id_producto'];

// Consultar los detalles del producto
$consulta = "SELECT * FROM producto WHERE id_producto = '$idProducto'";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si se encontró el producto
if (mysqli_num_rows($resultado) > 0) {
    $producto = mysqli_fetch_assoc($resultado);
    echo "<div>
            <h3>Detalles del Producto a Eliminar</h3>
            <p><strong>ID:</strong> " . $producto['id_producto'] . "</p>
            <p><strong>Tipo:</strong> " . $producto['tipo_producto'] . "</p>
            <p><strong>Materiales:</strong> " . $producto['materiales_principales'] . "</p>
            <p><strong>Precio:</strong> $" . $producto['precio_venta'] . "</p>
            <p><strong>Inventario:</strong> " . $producto['inventario_disponible'] . "</p>
            <p><strong>Color:</strong> " . $producto['color'] . "</p>
            <form method='POST' action='eliminar_producto.php'>
                <input type='hidden' name='id_producto' value='" . $producto['id_producto'] . "'>
                <button type='submit'>Confirmar eliminación</button>
            </form>
          </div>";
} else {
    echo "<div>No se encontró ningún producto con el ID $idProducto.</div>";
}

mysqli_close($conexion);
?>