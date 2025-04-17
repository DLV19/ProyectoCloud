<?php

require_once 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? 0;

$stmt = $conn->prepare("DELETE FROM celulares WHERE id = ?");
$stmt->bind_param("i", $id);

$response = [];

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Error al eliminar celular: " . $stmt->error;
}

echo json_encode($response);
$stmt->close();
$conn->close();
?>


$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Error de conexión: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? null;

if ($id) {
    // Opcional: eliminar imagen del servidor
    $stmtImg = $conn->prepare("SELECT imagen FROM celulares WHERE id = ?");
    $stmtImg->bind_param("i", $id);
    $stmtImg->execute();
    $result = $stmtImg->get_result();
    if ($row = $result->fetch_assoc()) {
        $ruta = $row['imagen'];
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
    $stmtImg->close();

    // Eliminar de la base de datos
    $stmt = $conn->prepare("DELETE FROM celulares WHERE id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();

    echo json_encode(['success' => $success]);
} else {
    echo json_encode(['success' => false, 'error' => 'ID no recibido']);
}

$conn->close();
?>
