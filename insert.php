<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabla = $_POST['tabla'];

    switch ($tabla) {
        case 'usuarios':
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
            $stmt->bind_param("ss", $nombre, $email);
            break;

        case 'productos':
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $stmt = $conn->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
            $stmt->bind_param("sd", $nombre, $precio);
            break;

        case 'pedidos':
            $usuario_id = $_POST['usuario_id'];
            $producto_id = $_POST['producto_id'];
            $cantidad = $_POST['cantidad'];
            $stmt = $conn->prepare("INSERT INTO pedidos (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $usuario_id, $producto_id, $cantidad);
            break;

        case 'mensajes':
            $usuario_id = $_POST['usuario_id'];
            $mensaje = $_POST['mensaje'];
            $stmt = $conn->prepare("INSERT INTO mensajes (usuario_id, mensaje) VALUES (?, ?)");
            $stmt->bind_param("is", $usuario_id, $mensaje);
            break;

        default:
            die("Tabla no válida.");
    }

    if ($stmt->execute()) {
        header("Location: index.php");  // Redirige a la página principal después de insertar
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
