<?php
require_once 'config.php';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Error de conexión: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $procesador = $_POST['procesador'];
    $almacenamiento = $_POST['almacenamiento'];
    $ppi = $_POST['ppi'];

    // Obtener imagen existente
    $imagenFinal = $_POST['imagen_actual'];

    if (!empty($_FILES['imagen']['name'])) {
        $nombreCarpeta = preg_replace('/[^a-zA-Z0-9_-]/', '_', $modelo);
        $rutaCarpeta = 'celulares/' . $nombreCarpeta;
        if (!file_exists($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaImagen = $rutaCarpeta . '/' . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            $imagenFinal = $rutaImagen;
        }
    }

    $stmt = $conn->prepare("UPDATE celulares SET marca=?, modelo=?, procesador=?, almacenamiento=?, densidad_de_pixeles=?, imagen=? WHERE id=?");
    $stmt->bind_param("ssssssi", $marca, $modelo, $procesador, $almacenamiento, $ppi, $imagenFinal, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al editar: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
}

$conn->close();
?>
