<?php
$host = "localhost";
$user = "root";  // Cambia esto si usas otro usuario
$pass = "";      // Si tienes contraseña, agrégala aquí
$dbname = "registro";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
