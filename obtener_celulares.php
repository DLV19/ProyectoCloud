<?php
require_once 'config.php';

// conexión usando el puerto también
$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Conexión fallida: ' . $conn->connect_error]));
}

$result = $conn->query("SELECT * FROM celulares ORDER BY id DESC");

$celulares = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $celulares[] = $row;
    }
    echo json_encode($celulares);
} else {
    echo json_encode(['success' => false, 'error' => 'Error en consulta: ' . $conn->error]);
}

$conn->close();
?>
