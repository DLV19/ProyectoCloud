<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

require_once 'config.php'; // conexión a Railway
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Celulares</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>

  <h1>Gestión de Celulares</h1>

  <form id="formAgregar" enctype="multipart/form-data">
    <input type="text" name="marca" placeholder="Marca" required>
    <input type="text" name="modelo" placeholder="Modelo" required>
    <input type="text" name="procesador" placeholder="Procesador" required>
    <input type="text" name="almacenamiento" placeholder="Almacenamiento" required>
    <input type="text" name="ppi" placeholder="Densidad de píxeles" required>
    <input type="file" name="imagen" accept="image/*" required>
    <button type="submit">Guardar</button>
    <a href="logout.php" class="btn-cerrar">Cerrar sesión</a>
  </form>
  
  <table id="miTabla" class="display">
    <thead>
      <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Procesador</th>
        <th>Almacenamiento</th>
        <th>Densidad</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="logica.js"></script>

</body>
</html>
