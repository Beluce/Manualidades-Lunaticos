<?php
session_start();
if (isset($_SESSION['username'])) {
    $usuario = $_SESSION['username'];
} else {
    header("location: ../index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="../media/favicon/hacker.png" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Geo:ital@0;1&family=Handjet:wght@100..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Birthstone&family=Geo:ital@0;1&family=Handjet:wght@100..900&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <style>
        .fixed-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
            max-width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: "Kanit", sans-serif;
            background-color: #f0f8ff;
            /* Un color pastel suave, azul claro */
            color: #333;
            /* Texto oscuro para buen contraste */
        }

        /* Fondo para secciones principales */
        .container,
        .row,
        .col {
            background-color: #fff;
            /* Blanco para las secciones internas */
            border-radius: 10px;
            /* Bordes redondeados */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra ligera */
        }



        /* Fondo de las tablas */
        .table {
            background-color: #fafafa;
            /* Color muy claro para las tablas */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Sombra ligera */
        }

        /* Estilo para los botones */
        button,
        .btn {
            background-color: #ffb3b3;
            /* Color pastel suave */
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
        }

        button:hover,
        .btn:hover {
            background-color: #ff9999;
            /* Cambio de color en hover */
        }

        /* Fondos suaves para secciones específicas */
        section {
            background-color: #f9f9f9;
            /* Fondo claro */
            padding: 40px;
            margin: 20px 0;
            border-radius: 10px;
        }

        /* Fondos para cuadros de texto */
        input[type="text"],
        input[type="password"],
        textarea {
            background-color: #f8f9fa;
            /* Gris claro para los inputs */
            border: 1px solid #ddd;
            /* Borde suave */
            padding: 10px;
            border-radius: 5px;
        }

        /* Para asegurarse de que el contenido ocupe toda la pantalla sin demasiados márgenes */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
    </style>

</head>


<?php
if (isset($_GET['status']) && in_array($_GET['status'], ['success', 'error', 'insert_error', 'delete_success', 'delete_error'])): ?>
    <div class="alert 
            <?php echo ($_GET['status'] == 'success' || $_GET['status'] == 'delete_success') ? 'alert-success' : 'alert-danger'; ?> 
            alert-dismissible fade show fixed-notification" role="alert">
        <?php
        // Mensajes específicos para cada estado
        switch ($_GET['status']) {
            case 'success':
                echo "<strong>Éxito:</strong> Dato registrado correctamente.";
                break;
            case 'error':
                echo "<strong>Error:</strong> El dato ya está registrado.";
                break;
            case 'insert_error':
                echo "<strong>Error:</strong> Hubo un problema al registrar el dato";
                break;
            case 'delete_success':
                echo "<strong>Éxito:</strong> Registro eliminado correctamente.";
                break;
            case 'delete_error':
                echo "<strong>Error:</strong> Hubo un problema al eliminar el registro.";
                break;
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<!-- Aquí continúa el resto del contenido de tu página -->


<div class="container mt-5">
    <!-- Mensaje de Bienvenida -->
    <div class="alert alert-primary text-center d-flex justify-content-between align-items-center" role="alert">
        <h1 class="mb-0">Bienvenido, <?php echo $usuario; ?>!</h1>
        <!-- Botón de Cerrar Sesión -->
        <a href="../logica/logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Administración de Registros</h2>
        <button id="toggleTableBtn" class="btn btn-outline-primary" onclick="toggleTable()">
            <span class="material-icons">arrow_forward</span>
        </button>
    </div>

    <!-- Tabla de Productos -->
    <div id="tablaProductos" class="table-responsive">
        <h3>Productos</h3>
        <?php
        require "../logica/conexion.php";
        mysqli_set_charset($conexion, 'utf8');
        $consulta_sql = "SELECT * FROM producto";
        $resultado = $conexion->query($consulta_sql);
        $count = mysqli_num_rows($resultado);

        if ($count > 0) {
            echo "<table class='table table-striped table-bordered table-hover table-sm rounded'>
                    <thead class='bg-info text-white'>
                        <tr>
                            <th>ID Producto</th>
                            <th>Tipo de Producto</th>
                            <th>Materiales Principales</th>
                            <th>Precio de Venta</th>
                            <th>Inventario Disponible</th>
                            <th>Color</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row['id_producto'] . "</td>";
                echo "<td>" . $row['tipo_producto'] . "</td>";
                echo "<td>" . $row['materiales_principales'] . "</td>";
                echo "<td>" . $row['precio_venta'] . "</td>";
                echo "<td>" . $row['inventario_disponible'] . "</td>";
                echo "<td>" . $row['color'] . "</td>";
                echo "<td>" . $row['fecha_creacion'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<h5 class='text-danger'>Sin ningún registro de productos</h5>";
        }

        mysqli_close($conexion);
        ?>

        <div class="d-flex justify-content-end gap-2 mt-3 mb-5">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar
                Registro</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal">Eliminar
                Registro</button>
        </div>
    </div>

    <!-- Tabla de Administradores -->
    <div id="tablaAdministradores" class="table-responsive d-none">
        <h3>Administradores</h3>
        <?php
        require "../logica/conexion.php";
        mysqli_set_charset($conexion, 'utf8');
        $consulta_sql_admin = "SELECT * FROM administrador";
        $resultado_admin = $conexion->query($consulta_sql_admin);
        $count_admin = mysqli_num_rows($resultado_admin);

        if ($count_admin > 0) {
            echo "<table class='table table-striped table-bordered table-hover table-sm rounded'>
                    <thead class='bg-info text-white'>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Password</th>
                            <th>Correo</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row_admin = mysqli_fetch_assoc($resultado_admin)) {
                echo "<tr>";
                echo "<td>" . $row_admin['id_admin'] . "</td>";
                echo "<td>" . $row_admin['nombre_usuario'] . "</td>";
                echo "<td>" . $row_admin['password'] . "</td>";
                echo "<td>" . $row_admin['email'] . "</td>";
                echo "<td>" . $row_admin['fecha_registro'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<h5 class='text-danger'>Sin ningún registro de administradores</h5>";
        }

        mysqli_close($conexion);
        ?>
        <div class="d-flex justify-content-end gap-2 mt-3 mb-5">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAdminModal">Agregar
                Registro</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAdminModal">Eliminar
                Registro</button>
        </div>
    </div>
</div>

<!-- Modales para Agregar y Eliminar Productos y Administradores -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../logica/registrar_product.php" method="post" class="container mt-4">
                    <h3 class="mb-4">Registrar Producto</h3>
                    <div class="mb-3">
                        <label for="tipo_producto" class="form-label">Tipo de Producto:</label>
                        <input type="text" class="form-control" name="tipo_producto" id="tipo_producto" required
                            maxlength="100" placeholder="Ej. Jabón, Vela">
                    </div>
                    <div class="mb-3">
                        <label for="materiales_principales" class="form-label">Materiales Principales:</label>
                        <input type="text" class="form-control" name="materiales_principales"
                            id="materiales_principales" required maxlength="255" placeholder="Ej. Cera, Aceite">
                    </div>
                    <div class="mb-3">
                        <label for="tamaño" class="form-label">Tamaño:</label>
                        <input type="text" class="form-control" name="tamaño" id="tamaño" required maxlength="50"
                            placeholder="Ej. Pequeño, Mediano, Grande">
                    </div>
                    <div class="mb-3">
                        <label for="peso" class="form-label">Peso (en gramos):</label>
                        <input type="number" class="form-control" name="peso" id="peso" required
                            placeholder="Peso en gramos">
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" class="form-control" name="color" id="color" required maxlength="50"
                            placeholder="Ej. Azul, Rojo">
                    </div>
                    <div class="mb-3">
                        <label for="estilo" class="form-label">Estilo:</label>
                        <input type="text" class="form-control" name="estilo" id="estilo" required maxlength="50"
                            placeholder="Ej. Rústico, Moderno">
                    </div>
                    <div class="mb-3">
                        <label for="precio_venta" class="form-label">Precio de Venta:</label>
                        <input type="number" class="form-control" name="precio_venta" id="precio_venta" required
                            step="0.01" placeholder="Precio de venta en MXN">
                    </div>
                    <div class="mb-3">
                        <label for="costo_produccion" class="form-label">Costo de Producción:</label>
                        <input type="number" class="form-control" name="costo_produccion" id="costo_produccion" required
                            step="0.01" placeholder="Costo de producción en MXN">
                    </div>
                    <div class="mb-3">
                        <label for="inventario_disponible" class="form-label">Inventario Disponible:</label>
                        <input type="number" class="form-control" name="inventario_disponible"
                            id="inventario_disponible" required placeholder="Cantidad en inventario">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Registrar</button>
                </form>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../logica/delete_product.php">
                    <label for="id_producto">ID del Producto:</label>
                    <input type="number" name="id_producto" placeholder="ID del Producto" required />
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdminModalLabel">Agregar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../logica/registrar_admin.php">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" required maxlength="50">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deleteAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAdminModalLabel">Eliminar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../logica/delete_admin.php">
                    <label for="id_admin">ID del Administrador:</label>
                    <input type="number" name="id_admin" placeholder="ID del Administrador" required />
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleTable() {
        const productos = document.getElementById('tablaProductos');
        const administradores = document.getElementById('tablaAdministradores');
        const toggleBtn = document.getElementById('toggleTableBtn');

        if (productos.classList.contains('d-none')) {
            productos.classList.remove('d-none');
            administradores.classList.add('d-none');
            toggleBtn.innerHTML = '<span class="material-icons">arrow_forward</span>';
        } else {
            productos.classList.add('d-none');
            administradores.classList.remove('d-none');
            toggleBtn.innerHTML = '<span class="material-icons">arrow_back</span>';
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>