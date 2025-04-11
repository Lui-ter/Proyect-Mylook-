document.addEventListener('DOMContentLoaded', function () {
    const idInput = document.getElementById('Id');
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const contrasenaInput = document.getElementById('contrasena');
    const telefonoInput = document.getElementById('telefono');
    const correoInput = document.getElementById('correo');
    const direccionInput = document.getElementById('direccion');
    const rolInput = document.getElementById('tipoRol');
    const imagenInput = document.getElementById('imagenServicio');

    const nombrePrevisualizacion = document.getElementById('nombrePrevisualizacion');
    const apellidoPrevisualizacion = document.getElementById('apellidoPrevisualizacion');
    const telefonoPrevisualizacion = document.getElementById('telefonoPrevisualizacion');
    const correoPrevisualizacion = document.getElementById('correoPrevisualizacion');
    const direccionPrevisualizacion = document.getElementById('direccionPrevisualizacion');
    const rolPrevisualizacion = document.getElementById('rolPrevisualizacion');
    const idPrevisualizacion = document.getElementById('idPrevisualizacion');
    const imagenPrevisualizacion = document.getElementById('imagenPrevisualizacion');

    function actualizarPrevisualizacion() {
        nombrePrevisualizacion.textContent = nombreInput.value || '-';
        apellidoPrevisualizacion.textContent = apellidoInput.value || '-';
        telefonoPrevisualizacion.textContent = telefonoInput.value || '-';
        correoPrevisualizacion.textContent = correoInput.value || '-';
        direccionPrevisualizacion.textContent = direccionInput.value || '-';
        rolPrevisualizacion.textContent = rolInput.options[rolInput.selectedIndex].text || '-';
        idPrevisualizacion.textContent = idInput.value || '-';
    }

    function actualizarImagenPrevisualizacion(event) {
        const archivo = event.target.files[0];
        if (archivo) {
            const lector = new FileReader();
            lector.onload = function (e) {
                imagenPrevisualizacion.src = e.target.result;
            };
            lector.readAsDataURL(archivo);
        }
    }

    idInput.addEventListener('input', actualizarPrevisualizacion);
    nombreInput.addEventListener('input', actualizarPrevisualizacion);
    apellidoInput.addEventListener('input', actualizarPrevisualizacion);
    telefonoInput.addEventListener('input', actualizarPrevisualizacion);
    correoInput.addEventListener('input', actualizarPrevisualizacion);
    direccionInput.addEventListener('input', actualizarPrevisualizacion);
    rolInput.addEventListener('change', actualizarPrevisualizacion);
    imagenInput.addEventListener('change', actualizarImagenPrevisualizacion);

    actualizarPrevisualizacion();

    const togglePassword = document.getElementById('togglePassword');
    togglePassword.addEventListener('click', function () {
        if (contrasenaInput.type === 'password') {
            contrasenaInput.type = 'text';
            togglePassword.innerHTML = '<i class="fa-solid fa-eye" style="color: #A68160;"></i>';
        } else {
            contrasenaInput.type = 'password';
            togglePassword.innerHTML = '<i class="fa-solid fa-eye-slash" style="color: #A68160;"></i>';
        }
    });
});