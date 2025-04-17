<?php
$host = "switchback.proxy.rlwy.net";  // Host de Railway
$port = 53954;                         // Puerto personalizado que viste en Variables o Settings
$user = "root";                        // Usuario por defecto en Railway
$password = "dHwdUkJhktSnGFavafMAjSSXPnRKePZE"; // 🔐 Copia la de MYSQL_ROOT_PASSWORD
$dbname = "railway";                  // Nombre de la base que también es "railway"

// Conexión con puerto incluido
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Verificación de conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: para UTF-8
$conn->set_charset("utf8mb4");
?>
