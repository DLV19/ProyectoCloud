
<?php
include "config.php";

header('Content-Type: application/json');

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$procesador = $_POST['procesador'];
$almacenamiento = $_POST['almacenamiento'];
$densidad = $_POST['ppi'];

// Verificamos si se subió una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $directorio = 'fotos/';
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $nombreImagen = basename($_FILES['imagen']['name']);
    $rutaImagen = $directorio . uniqid() . "_" . $nombreImagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
} else {
    $rutaImagen = 'fotos/default.jpg';
}

$stmt = $conn->prepare("INSERT INTO celulares (marca, modelo, procesador, almacenamiento, densidad_de_pixeles, imagen) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $marca, $modelo, $procesador, $almacenamiento, $densidad, $rutaImagen);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'id' => $conn->insert_id,
        'imagen' => $rutaImagen
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Error al guardar el celular: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
