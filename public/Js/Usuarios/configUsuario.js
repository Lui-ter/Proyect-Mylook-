document.addEventListener('DOMContentLoaded', function () {
    const inputImagen = document.getElementById('fileInput');
    const imagenVisualizacion = document.getElementById('imagenVisualizacion');

    const campos = {
        documento: document.getElementById('documentoUsuario'),
        telefono: document.getElementById('telefonoUsuario'),
        nombre: document.getElementById('nombreUsuario'),
        apellido: document.getElementById('apellidoUsuario'),
        correo: document.getElementById('correoUsuario'),
        condicion: document.getElementById('condicionUsuario'),
    };

    function mostrarImagenInicial() {
        const src = imagenVisualizacion.getAttribute('src');
        if (src && src.trim() !== '') {
            imagenVisualizacion.style.display = 'block';
        } else {
            imagenVisualizacion.style.display = 'none';
        }
    }

    // Mostrar nueva imagen seleccionada
    if (inputImagen && imagenVisualizacion) {
        inputImagen.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagenVisualizacion.src = e.target.result;
                    imagenVisualizacion.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                mostrarImagenInicial();
            }
        });
    }

    // Mostrar la info cargada
    function cargarInformacionInicial() {
        for (const key in campos) {
            const campo = campos[key];
            if (campo && campo.value.trim() !== '') {
                campo.style.borderColor = '#2ecc71';
            }
        }
    }

    // Función para obtener la imagen actua
    function obtenerImagen() {
        if (imagenVisualizacion && imagenVisualizacion.src && imagenVisualizacion.src.trim() !== '') {
            const srcImagen = imagenVisualizacion.src;
            console.log('Imagen actual:', srcImagen);
            return srcImagen;
        } else {
            console.log('No hay imagen para mostrar');
            return null;
        }
    }

    mostrarImagenInicial();
    cargarInformacionInicial();

    const imagenActual = obtenerImagen();

    window.handleValidationConfigUser = function (event) {
    };
});
