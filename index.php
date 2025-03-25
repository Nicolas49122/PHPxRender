<?php
include 'db.php';

// Obtener datos de cada tabla
$usuarios = $conn->query("SELECT * FROM usuarios");
$productos = $conn->query("SELECT * FROM productos");
$pedidos = $conn->query("
    SELECT pedidos.id, usuarios.nombre AS usuario, productos.nombre AS producto, pedidos.cantidad, pedidos.fecha
    FROM pedidos
    JOIN usuarios ON pedidos.usuario_id = usuarios.id
    JOIN productos ON pedidos.producto_id = productos.id
");
$mensajes = $conn->query("
    SELECT mensajes.id, usuarios.nombre AS usuario, mensajes.mensaje, mensajes.fecha
    FROM mensajes
    JOIN usuarios ON mensajes.usuario_id = usuarios.id
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 900px; }
        .card { box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border: none; }
        .btn-primary { background-color: #007bff; border: none; }
        .btn-primary:hover { background-color: #0056b3; }
        table { text-align: center; }
        thead { background-color: #343a40; color: white; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Gestión de Datos</h2>

    <!-- Sección Usuarios -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title text-center">Usuarios</h5>
            <form action="insert.php" method="POST" class="mb-3">
                <input type="hidden" name="tabla" value="usuarios">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Agregar Usuario</button>
            </form>
            <table class="table table-striped">
                <thead><tr><th>ID</th><th>Nombre</th><th>Email</th></tr></thead>
                <tbody>
                    <?php while ($row = $usuarios->fetch_assoc()): ?>
                        <tr><td><?= $row['id'] ?></td><td><?= $row['nombre'] ?></td><td><?= $row['email'] ?></td></tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección Productos -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title text-center">Productos</h5>
            <form action="insert.php" method="POST" class="mb-3">
                <input type="hidden" name="tabla" value="productos">
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Agregar Producto</button>
            </form>
            <table class="table table-striped">
                <thead><tr><th>ID</th><th>Nombre</th><th>Precio</th></tr></thead>
                <tbody>
                    <?php while ($row = $productos->fetch_assoc()): ?>
                        <tr><td><?= $row['id'] ?></td><td><?= $row['nombre'] ?></td><td>$<?= number_format($row['precio'], 2) ?></td></tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección Pedidos -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title text-center">Pedidos</h5>
            <form action="insert.php" method="POST" class="mb-3">
                <input type="hidden" name="tabla" value="pedidos">
                <div class="row g-3">
                    <div class="col-md-4">
                        <select name="usuario_id" class="form-control" required>
                            <option value="" disabled selected>Seleccionar usuario</option>
                            <?php foreach ($usuarios as $u) { echo "<option value='{$u['id']}'>{$u['nombre']}</option>"; } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="producto_id" class="form-control" required>
                            <option value="" disabled selected>Seleccionar producto</option>
                            <?php foreach ($productos as $p) { echo "<option value='{$p['id']}'>{$p['nombre']}</option>"; } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Agregar Pedido</button>
            </form>
            <table class="table table-striped">
                <thead><tr><th>ID</th><th>Usuario</th><th>Producto</th><th>Cantidad</th><th>Fecha</th></tr></thead>
                <tbody>
                    <?php while ($row = $pedidos->fetch_assoc()): ?>
                        <tr><td><?= $row['id'] ?></td><td><?= $row['usuario'] ?></td><td><?= $row['producto'] ?></td><td><?= $row['cantidad'] ?></td><td><?= $row['fecha'] ?></td></tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sección Mensajes -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title text-center">Mensajes</h5>
            <form action="insert.php" method="POST" class="mb-3">
                <input type="hidden" name="tabla" value="mensajes">
                <div class="row g-3">
                    <div class="col-md-4">
                        <select name="usuario_id" class="form-control" required>
                            <option value="" disabled selected>Seleccionar usuario</option>
                            <?php foreach ($usuarios as $u) { echo "<option value='{$u['id']}'>{$u['nombre']}</option>"; } ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="mensaje" class="form-control" placeholder="Escribe un mensaje" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Enviar Mensaje</button>
            </form>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
