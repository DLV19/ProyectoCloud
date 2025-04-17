<?php
include 'config.php'; // Conexión a Railway

// Datos del usuario a registrar
$email = "dany@example.com";
$password = "123456";

// Insertar el nuevo usuario
$stmt = $conn->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "✅ Usuario creado correctamente.";
} else {
    echo "❌ Error al crear el usuario: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
