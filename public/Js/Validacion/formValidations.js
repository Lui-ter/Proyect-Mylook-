/* FUNCIÓN PARA MANEJO DE MENSAJES DE ERROR */
function showError(message) {
    const errorDiv = document.getElementById("errorMessage");
    if (!errorDiv) return;

    errorDiv.textContent = message;
    errorDiv.style.display = "block";

    setTimeout(() => {
        errorDiv.style.display = "none";
    }, 3000);
}

/* Expresiones regulares para validar caracteres */
const regexNombre = /^[a-zA-Z\s]+$/;  // Solo letras y espacios
const regexDescripcion = /^[a-zA-Z0-9\s.,!?-]+$/; // Letras, números y algunos caracteres especiales
const regexNumerico = /^[0-9]+$/;  // Solo números
const regexPassword = /^(?=.[a-z])(?=.[A-Z])(?=.*\d).{8,}$/;    // Contraseñas seguras
const regexNit = /^[0-9-]{10,}$/; 
const tiposImgPermitidos = ["image/jpeg", "image/png", "image/jpg"];

/* FORMULARIO DE INSERCIÓN DE CATEGORIA */
function handleValidationCategory(event) {
    event.preventDefault();

    const nombreCategoria = document.getElementById("nombreCategoria").value.trim();
    const descripcionCategoria = document.getElementById("descripcion").value.trim();
    const imagenCategoria = document.getElementById("imagen").files[0];

    if (!nombreCategoria || !descripcionCategoria || !imagenCategoria) {
        showError("¡Faltan campos por llenar!");
        return;
    }

    if (!regexNombre.test(nombreCategoria)) {
        showError("¡El nombre de la categoría solo puede contener letras y espacios!");
        return;
    }

    if (!regexDescripcion.test(descripcionCategoria)) {
        showError("¡La descripción solo puede contener letras, números y signos básicos!");
        return;
    }

    if (!tiposImgPermitidos.includes(imagenCategoria.type)) {
        showError("Solo se permiten archivos de imagen (JPEG, PNG, JPG).");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE INSERCIÓN DE TIPO DE SERVICIO */
function handleValidationServiceType(event) {
    event.preventDefault();

    const nombreServicios = document.getElementById("nombreServicios").value.trim();

    if (!nombreServicios) {
        showError("¡El nombre no puede estar vacío!");
        return;
    }

    if (!regexNombre.test(nombreServicios)) {
        showError("¡El nombre del servicio solo puede contener letras y espacios!");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE INSERCIÓN DE PRODUCTOS */
function handleValidationProduct(event) {
    event.preventDefault();

    const nombre = document.getElementById("nombre").value.trim();
    const marca = document.getElementById("marca").value.trim();
    const imagen = document.getElementById("imagen").files[0];
    const desc = document.getElementById("desc").value.trim();
    const cantidad = document.getElementById("cantidad").value.trim();
    const precio = document.getElementById("valor").value.trim();

    if (!nombre || !marca || !imagen || !desc || !cantidad || !precio) {
        showError("¡Faltan campos por llenar!");
        return;
    }

    if (!regexNombre.test(nombre) || !regexNombre.test(marca)) {
        showError("¡El nombre y la marca solo pueden contener letras y espacios!");
        return;
    }

    if (!regexDescripcion.test(desc)) {
        showError("¡La descripción solo puede contener letras, números y signos básicos!");
        return;
    }

    if (!regexNumerico.test(cantidad) || !regexNumerico.test(precio)) {
        showError("¡La cantidad y el precio deben ser valores numéricos!");
        return;
    }

    if (!tiposImgPermitidos.includes(imagen.type)) {
        showError("Solo se permiten archivos de imagen (JPEG, PNG, JPG).");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE REGISTRO */
function handleValidationRegister(event) {
    event.preventDefault();

    const tipo_usuario = document.getElementById("tipo_usuario").value;

    if (tipo_usuario == "1") {
        const nitNegocio = document.getElementById("1").value.trim();
        const nombreNegocio = document.getElementById("2").value.trim();
        const contrasenaNegocio = document.getElementById("3").value.trim();

        if (!nitNegocio || !nombreNegocio || !contrasenaNegocio) {
            showError("¡Faltan campos por llenar en el negocio!");
            return;
        }

        if (!regexNit.test(nitNegocio)) {
            showError("¡El NIT debe tener al menos 10 caracteres y solo puede contener números y guion (-)!");
            return;
        }

        if (!regexNombre.test(nombreNegocio)) {
            showError("¡El nombre del negocio solo puede contener letras y espacios!");
            return;
        }

        if (!regexPassword.test(contrasenaNegocio)) {
            showError("¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!");
            return;
        }
    } else {
        const documentoUsuario = document.getElementById("4").value.trim();
        const nombreUsuario = document.getElementById("5").value.trim();
        const passwordUsuario = document.getElementById("7").value.trim();

        if (!documentoUsuario || !nombreUsuario || !passwordUsuario) {
            showError("¡Faltan campos por llenar en el usuario!");
            return;
        }

        if (!regexNombre.test(nombreUsuario)) {
            showError("¡El nombre del usuario solo puede contener letras y espacios!");
            return;
        }

        if (!regexPassword.test(passwordUsuario)) {
            showError("¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!");
            return;
        }
    }

    event.target.submit();
}

/* FORMULARIO DE INICIO DE SESIÓN */
function handleValidationLogin(event) {
    event.preventDefault();

    const tipo_usuario = document.querySelector(".tipo_usuario").value;

    if (tipo_usuario == "1") {
        const documentoUsuario = document.querySelector("input[name='documentoUsuario']").value.trim();
        const passwordUsuario = document.querySelector("input[name='passwordUsuario']").value.trim();

        if (!documentoUsuario || !passwordUsuario) {
            showError("¡Faltan campos por llenar en el usuario!");
            return;
        }
    } else if (tipo_usuario == "2") {
        const nitNegocio = document.querySelector("input[name='nitNegocio']").value.trim();
        const contrasenaNegocio = document.querySelector("input[name='contrasenaNegocio']").value.trim();

        if (!nitNegocio || !contrasenaNegocio) {
            showError("¡Faltan campos por llenar en el negocio!");
            return;
        }
    } else {
        showError("¡Seleccione un tipo de usuario!");
        return;
    }

    event.target.submit();
}