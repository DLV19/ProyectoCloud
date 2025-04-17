
// Inicializar DataTable globalmente
let dataTable;

// Cargar celulares al inicio
$(document).ready(function () {
  $.ajax({
    url: 'obtener_celulares.php',
    dataType: 'json',
    success: function (data) {
      const rows = data.map(celular => `
        <tr>
          <td>${celular.marca}</td>
          <td>${celular.modelo}</td>
          <td>${celular.procesador}</td>
          <td>${celular.almacenamiento}</td>
          <td>${celular.densidad_de_pixeles}</td>
          <td><img src="${celular.imagen}" alt="${celular.modelo}" width="80" loading="lazy" onerror="this.src='fotos/default.jpg'"></td>
          <td>
            <button onclick="editarCelular(${celular.id}, '${celular.marca}', '${celular.modelo}', '${celular.procesador}', '${celular.almacenamiento}', '${celular.densidad_de_pixeles}', '${celular.imagen}')">✏️ Editar</button>
            <button onclick="borrarCelular(${celular.id}, this)">🗑️ Eliminar</button>
          </td>
        </tr>
      `).join('');

      $('#miTabla tbody').html(rows);

      dataTable = $('#miTabla').DataTable({
        jQueryUI: true,
        paging: true,
        searching: true,
        ordering: true,
        pageLength: 5,
        language: {
          lengthMenu: "Mostrar _MENU_ registros",
          info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
          search: "Buscar:",
          paginate: {
            next: "Siguiente",
            previous: "Anterior"
          }
        }
      });
    },
    error: function () {
      Swal.fire("Error", "Error al obtener los datos de la base de datos", "error");
    }
  });
});

// Manejo de formulario para agregar/editar
$("#formAgregar").on("submit", function (e) {
  e.preventDefault();

  const marca = $('input[name="marca"]').val().trim();
  const modelo = $('input[name="modelo"]').val().trim();

  if (!marca || !modelo) {
    Swal.fire("Campo obligatorio", "Marca y Modelo son requeridos", "warning");
    return;
  }

  const formData = new FormData(this);
  const id = $('#formAgregar').data('edit-id');
  const imagenActual = $('#formAgregar').data('imagen-actual');

  if (id) {
    formData.append('id', id);
    formData.append('imagen_actual', imagenActual);
  }

  const url = id ? 'editar.php' : 'agregar.php';

  fetch(url, {
    method: "POST",
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        Swal.fire("Éxito", id ? "Celular editado" : "Celular agregado", "success").then(() => {
          if (!id) {
            const nuevaFila = dataTable.row.add([
              formData.get("marca"),
              formData.get("modelo"),
              formData.get("procesador"),
              formData.get("almacenamiento"),
              formData.get("ppi"),
              `<img src="${data.imagen}" width="80" loading="lazy">`,
              `<button onclick="editarCelular(${data.id}, '${formData.get("marca")}', '${formData.get("modelo")}', '${formData.get("procesador")}', '${formData.get("almacenamiento")}', '${formData.get("ppi")}', '${data.imagen}')">✏️</button>
               <button onclick="borrarCelular(${data.id}, this)">🗑️</button>`
            ]).draw(false).node();
            $(nuevaFila).hide().fadeIn();
          } else {
            location.reload(); // opcional: puedes mejorar esto con edición en vivo
          }
        });
        $('#formAgregar').removeData('edit-id').removeData('imagen-actual')[0].reset();
      } else {
        Swal.fire("Error", data.error || "Error desconocido", "error");
      }
    });
});

// Eliminar con animación y actualización de DataTable
function borrarCelular(id, boton) {
  Swal.fire({
    title: "¿Seguro?",
    text: "Esta acción no se puede deshacer",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar"
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("eliminar.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            const row = dataTable.row($(boton).closest('tr'));
            row.node().style.backgroundColor = '#ffcccc';
            $(row.node()).fadeOut(400, function () {
              row.remove().draw(false);
            });
            Swal.fire("Eliminado", "El celular fue eliminado", "success");
          } else {
            Swal.fire("Error", data.error || "No se pudo eliminar", "error");
          }
        });
    }
  });
}

// Editar: carga los datos al form y resalta fila
function editarCelular(id, marca, modelo, procesador, almacenamiento, ppi, imagen) {
  $('input[name="marca"]').val(marca);
  $('input[name="modelo"]').val(modelo);
  $('input[name="procesador"]').val(procesador);
  $('input[name="almacenamiento"]').val(almacenamiento);
  $('input[name="ppi"]').val(ppi);
  $('#formAgregar').data('edit-id', id);
  $('#formAgregar').data('imagen-actual', imagen);

  const fila = $(`button[onclick*="editarCelular(${id}"]`).closest('tr');
  fila.css('background-color', '#fff59d');
  setTimeout(() => {
    fila.css('background-color', '');
  }, 1000);
}
