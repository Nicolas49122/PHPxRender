<?php
$database_url = getenv("DATABASE_URL");
$url_parts = parse_url($database_url);

$host = $url_parts["host"];
$user = $url_parts["user"];
$pass = $url_parts["pass"];
$dbname = ltrim($url_parts["path"], "/");

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
