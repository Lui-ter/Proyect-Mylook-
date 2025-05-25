document.addEventListener("DOMContentLoaded", () => {
  const nombreInput = document.getElementById("nombreCategoria");
  const descripcionInput = document.getElementById("descripcion");
  const imagenInput = document.getElementById("imagen");
  const triggerImagen = document.querySelector(".imagen1");

  const vistaNombre = document.getElementById("vistaNombre");
  const vistaDescripcion = document.getElementById("vistaDescripcion");
  const vistaImagen = document.getElementById("imagenCategoria");
  const mensaje = document.getElementById("sinImagen");

  // Mostrar texto en vista previa
  nombreInput.addEventListener("input", () => {
    vistaNombre.textContent = nombreInput.value.trim();
  });

  descripcionInput.addEventListener("input", () => {
    vistaDescripcion.textContent = descripcionInput.value.trim();
  });

  // Previsualizar imagen
  imagenInput.addEventListener("change", (event) => {
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        vistaImagen.src = e.target.result;
        vistaImagen.style.display = "block";
        if (mensaje) {
          mensaje.style.display = "none";
        }
      };
      reader.readAsDataURL(file);
    } else {
      vistaImagen.src = "";
      vistaImagen.style.display = "none";
      if (mensaje) {
        mensaje.style.display = "block";
      }
    }
  });

  // Hacer clic en <p class="imagen1"> abre el input de imagen oculto
  if (triggerImagen && imagenInput) {
    triggerImagen.addEventListener("click", () => {
      imagenInput.click();
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
    // INPUTS DEL FORMULARIO
    const formElements = {
        nombreCategoria: document.getElementById('nombreCategoria'),
        descripcionCategoria: document.getElementById('descripcion'),
        imagenCategoria: document.getElementById('imagen'),
    };

    // ELEMENTOS DE PREVISUALIZACIÓN
    const previewElements = {
        nombreCategoria: document.getElementById('vistaNombre'),
        descripcionCategoria: document.getElementById('vistaDescripcion'),
        imagenCategoria: document.getElementById('imagenCategoria'),
    };

    // ACTUALIZA LA VISTA PREVIA
    function actualizarVistaPrevia() {
        previewElements.nombreCategoria.textContent = formElements.nombreCategoria.value || 'NOMBRE';
        previewElements.descripcionCategoria.textContent = formElements.descripcionCategoria.value || 'Descripción...';
    }

    // EVENTOS DE ACTUALIZACIÓN EN TIEMPO REAL
    [formElements.nombreCategoria, formElements.descripcionCategoria].forEach(element => {
        if (element) {
            element.addEventListener('input', actualizarVistaPrevia);
        }
    });

    // MOSTRAR IMAGEN AL CARGAR
    function mostrarImagenInicial() {
        const src = previewElements.imagenCategoria.getAttribute('src');
        previewElements.imagenCategoria.style.display = (src && src.trim() !== '') ? 'block' : 'none';
    }

    // CAMBIAR PREVISUALIZACIÓN DE IMAGEN
    formElements.imagenCategoria.addEventListener('change', function () {
        const file = formElements.imagenCategoria.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewElements.imagenCategoria.src = e.target.result;
                previewElements.imagenCategoria.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            mostrarImagenInicial();
        }
    });

    // ACTUALIZAR VISTA AL CARGAR
    actualizarVistaPrevia();
    mostrarImagenInicial();
});
