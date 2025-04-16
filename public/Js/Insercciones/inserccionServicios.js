document.addEventListener('DOMContentLoaded', function () {
  // Obtención de los elementos del formulario
  const nombreInput = document.getElementById('nombreServicio');
  const precioInput = document.getElementById('precioServicio');
  const descripcionInput = document.getElementById('descripcionServicio');
  const duracionInput = document.getElementById('duracionServicio');
  const imagenInput = document.getElementById('imagenServicio');

  // Seleccionamos los elementos de la tarjeta de previsualización
  const nombrePrevisualizacion = document.getElementById('nombrePrevisualizacion');
  const precioPrevisualizacion = document.getElementById('precioPrevisualizacion');
  const duracionPrevisualizacion = document.getElementById('duracionPrevisualizacion');
  const descripcionPrevisualizacion = document.getElementById('descripcionPrevisualizacion');
  const imagenPrevisualizacion = document.getElementById('imagenPrevisualizacion');

  // Función para actualizar los valores en la tarjeta de previsualización
  function actualizarPrevisualizacion() {
    nombrePrevisualizacion.textContent = nombreInput.value || 'Nombre del servicio';
    duracionPrevisualizacion.textContent = (duracionInput.value || '0') + ' Minutos';
    precioPrevisualizacion.textContent ='$ ' + (precioInput.value || '0')  + ' COP';
    descripcionPrevisualizacion.textContent =(descripcionInput.value || 'Descripción del servicio');
  }

  // Función para actualizar la imagen de previsualización
  function actualizarImagenPrevisualizacion(event) {
    const archivo = event.target.files[0];  // Obtener el archivo seleccionado

    if (archivo) {
      const lector = new FileReader();  // Usamos FileReader para leer el archivo de la imagen
      lector.onload = function (e) {
        imagenPrevisualizacion.src = e.target.result;  // Asignamos la imagen cargada al atributo src
      };
      lector.readAsDataURL(archivo);  // Leemos el archivo como URL de datos
    }
  }

  // Escuchar cambios en los campos de texto
  nombreInput.addEventListener('input', actualizarPrevisualizacion);
  precioInput.addEventListener('input', actualizarPrevisualizacion);
  descripcionInput.addEventListener('input', actualizarPrevisualizacion);
  duracionInput.addEventListener('input', actualizarPrevisualizacion);

  // Escuchar el cambio en el campo de entrada de imagen
  imagenInput.addEventListener('input', actualizarImagenPrevisualizacion);
});
