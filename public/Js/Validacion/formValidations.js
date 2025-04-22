/* FUNCIÓN PARA MANEJO DE MENSAJES DE ERROR */
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
const regexDescripcion = /^[a-zA-Z0-9\s.,!?-]+$/; // Letras, números y algunos caracteres especiales
const regexNumerico = /^[0-9]+$/;  // Solo números
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;    // Contraseñas seguras
const regexNit = /^[0-9-]{10,}$/;
const tiposImgPermitidos = ["image/jpeg", "image/png", "image/jpg"];

/* FORMULARIO DE INSERCIÓN DE CATEGORIA */
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
        showError("¡El nombre de la categoría solo puede contener letras y espacios!");
        return;
    }

    if (!regexDescripcion.test(descripcionCategoria)) {
        showError("¡La descripción solo puede contener letras, números y signos básicos!");
        return;
    }

    if (!tiposImgPermitidos.includes(imagenCategoria.type)) {
        showError("Solo se permiten archivos de imagen (JPEG, PNG, JPG).");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE INSERCIÓN DE TIPO DE SERVICIO */
function handleValidationServiceType(event) {
    event.preventDefault();

    const nombreServicios = document.getElementById("nombreServicios").value.trim();

    if (!nombreServicios) {
        showError("¡El nombre no puede estar vacío!");
        return;
    }

    if (!regexNombre.test(nombreServicios)) {
        showError("¡El nombre del servicio solo puede contener letras y espacios!");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE INSERCIÓN DE PRODUCTOS */
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
        showError("¡La descripción solo puede contener letras, números y signos básicos!");
        return;
    }

    if (!regexNumerico.test(cantidad) || !regexNumerico.test(precio)) {
        showError("¡La cantidad y el precio deben ser valores numéricos!");
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
            showError("¡El NIT debe tener al menos 10 caracteres y solo puede contener números y guion (-)!");
            return;
        }

        if (!regexNombre.test(nombreNegocio)) {
            showError("¡El nombre del negocio solo puede contener letras y espacios!");
            return;
        }

        if (!regexPassword.test(contrasenaNegocio)) {
            showError("¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!");
            return;
        }
        event.target.submit();
        return true;
    } else {
        const documentoUsuario = document.getElementById("4").value.trim();
        const nombreUsuario = document.getElementById("5").value.trim();
        const passwordUsuario = document.getElementById("7").value.trim();

        if (!documentoUsuario || !nombreUsuario || !passwordUsuario) {
            alert("¡Faltan campos por llenar en el usuario!");
            return false;
        } else {
            if (!regexNumerico.test(documentoUsuario)) {
                alert("¡El documento del usuario solo debe contener números!");
                return false;
            } else if (!regexNombre.test(nombreUsuario)) {
                alert(
                    "¡El nombre de usuario solo puede contener caracteres alfanuméricos!"
                );
                return false;
            } else if (!regexPassword.test(passwordUsuario)) {
                alert(
                    "La contraseña del usuario debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número"
                );
                return false;
            } else {
                event.target.submit();
                return true;
            }
        }
    }
}

/* FUNCIÓN PARA VALIDAR FORMULARIO DE CONFIGURACION DE USUARIO */
function handleValidationConfigUser(event) {
    event.preventDefault();

    const documentoUsuario = document.getElementById("documentoUsuario")?.value.trim();
    const nombreUsuario = document.getElementById("nombreUsuario")?.value.trim();
    const apellidoUsuario = document.getElementById("apellidoUsuario")?.value.trim();
    const telefonoUsuario = document.getElementById("telefonoUsuario")?.value.trim();
    const correoUsuario = document.getElementById("correoUsuario")?.value.trim();

    const regexNumerico = /^[0-9]+$/;
    const regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.querySelector(".formConfig");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.style.cssText = "background-color: #ffcccc; color: #d60000; padding: 10px; margin: 10px 0; border-radius: 5px; text-align: center; font-weight: bold;";

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
    }

    if (!documentoUsuario || !nombreUsuario || !apellidoUsuario || !telefonoUsuario || !correoUsuario) {
        showError("Todos los campos son obligatorios.");
        return;
    }

    if (!regexNumerico.test(documentoUsuario)) {
        showError("El documento debe contener solo números.");
        return;
    }

    if (!regexNombre.test(nombreUsuario) || !regexNombre.test(apellidoUsuario)) {
        showError("El nombre y el apellido solo pueden contener letras.");
        return;
    }

    if (!regexNumerico.test(telefonoUsuario) || telefonoUsuario.length < 7) {
        showError("El teléfono debe contener solo números y tener al menos 7 dígitos.");
        return;
    }

    if (!regexCorreo.test(correoUsuario)) {
        showError("El correo electrónico no tiene un formato válido.");
        return;
    }

    event.target.submit();

}

/* VALIDACIONES FORMULARIO STAFF */
function handleValidationStaff(event) {
    event.preventDefault();

    const documentoStaff = document.getElementById("Id")?.value.trim();
    const nombreStaff = document.getElementById("nombre")?.value.trim();
    const apellidoStaff = document.getElementById("apellido")?.value.trim();
    const telefonoStaff = document.getElementById("telefono")?.value.trim();
    const correoStaff = document.getElementById("correo")?.value.trim();
    const contrasenaStaff = document.getElementById("contrasena")?.value.trim();
    const rolStaff = document.getElementById("tipoRol")?.value.trim();
    const imagenStaff = document.getElementById("imagenServicio")?.files[0]();

    const regexNumerico = /^[0-9]+$/;
    const regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;   
    const tiposImgPermitidos = ["image/jpeg", "image/png", "image/jpg"];



    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.querySelector(".contenedorForm");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.style.cssText = "background-color: #ffcccc; color: #d60000; padding: 10px; margin: 10px 0; border-radius: 5px; text-align: center; font-weight: bold;";

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
    }

    if (!documentoStaff || !nombreStaff || !apellidoStaff || !telefonoStaff || !correoStaff || !contrasenaStaff || !rolStaff || !imagenStaff) {
        showError("!Todos los campos son obligatorios.¡");
        return;
    }

    if (!regexNumerico.test(documentoStaff)) {
        showError("!El documento debe contener solo números.¡");
        return;
    }

    if (!regexNombre.test(nombreStaff) || !regexNombre.test(apellidoStaff)) {
        showError("!El nombre y el apellido solo pueden contener letras.¡");
        return;
    }

    if (!regexNumerico.test(telefonoStaff) || telefonoStaff.length < 7) {
        showError(!"El teléfono debe contener solo números y tener al menos 7 dígitos.¡");
        return;
    }

    if (!regexCorreo.test(correoStaff)) {
        showError("!El correo electrónico no tiene un formato válido.¡");
        return;
    }

    if (!regexNombre.test(rolStaff)) {
        showError("EL staff debe tener algun tipo de rol.");
        return;
    }

    if (!tiposImgPermitidos.test(imagenStaff)) {
        showError("Solo se permiten archivos de imagen (JPEG, PNG, JPG).");
        return;
    }

    if (!regexPassword.test(contrasenaStaff)) {
        showError("La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!.");
        return;
    }

    event.target.submit();

}

function handleValidationLogin(event) {
    event.preventDefault();

    const tipo_usuario = document.getElementById("tipo_usuario").value;

    if (tipo_usuario == "2") {
        const nitNegocio = document.getElementById("10").value.trim();
        const contrasenaNegocio = document.getElementById("11").value.trim();

        if (!nitNegocio || !contrasenaNegocio) {
            showError("¡Faltan campos por llenar en el negocio!");
            return;
        }

        if (!regexNit.test(nitNegocio)) {
            showError("¡El NIT debe tener al menos 10 caracteres y solo puede contener números y guion (-)!");
            return;
        }

        if (!regexPassword.test(contrasenaNegocio)) {
            showError("¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!");
            return;
        }
        event.target.submit();
        return true;
    } else {
        const documentoUsuario = document.getElementById("8").value.trim();
        const passwordUsuario = document.getElementById("9").value.trim();

        if (!documentoUsuario || !passwordUsuario) {
            alert("¡Faltan campos por llenar en el usuario!");
            return false;
        } else {
            if (!regexNumerico.test(documentoUsuario)) {
                alert("¡El documento del usuario solo debe contener números!");
                return false;
            } else if (!regexPassword.test(passwordUsuario)) {
                alert(
                    "La contraseña del usuario debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número"
                );
                return false;
            } else {
                event.target.submit();
                return true;
            }
        }
    }
}

/* VALIDACIONES FORMULARIO STAFF */
function handleValidationAdmin(event) {
    event.preventDefault();

    const documentoAdmin = document.getElementById("idAdmin")?.value.trim();
    const nombreAdmin = document.getElementById("nombreAdmin")?.value.trim();
    const apellidoAdmin = document.getElementById("apellidoAdmin")?.value.trim();
    const telefonoAdmin = document.getElementById("telefonoAdmin")?.value.trim();
    const correoAdmin = document.getElementById("correoAdmin")?.value.trim();
    const contrasenaAdmin = document.getElementById("contrasenaAdmin")?.value.trim();
    const imagenAdmin = document.getElementById("fileInput")?.files[0]();

    const regexNumerico = /^[0-9]+$/;
    const regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;   
    const tiposImgPermitidos = ["image/jpeg", "image/png", "image/jpg"];



    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.querySelector(".contenedorForm");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.style.cssText = "background-color: #ffcccc; color: #d60000; padding: 10px; margin: 10px 0; border-radius: 5px; text-align: center; font-weight: bold;";

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
    }

    if (!documentoAdmin || !nombreAdmin || !apellidoAdmin || !telefonoStaff || !correoAdmin || !contrenaAdmin || !imagenAdmin) {
        showError("!Todos los campos son obligatorios.¡");
        return;
    }

    if (!regexNumerico.test(documentoAdmin)) {
        showError("!El documento debe contener solo números.¡");
        return;
    }

    if (!regexNombre.test(nombreAdmin) || !regexNombre.test(apellidoAdmin)) {
        showError("!El nombre y el apellido solo pueden contener letras.¡");
        return;
    }

    if (!regexNumerico.test(telefonoAdmin) || telefonoAdmin.length < 7) {
        showError(!"El teléfono debe contener solo números y tener al menos 7 dígitos.¡");
        return;
    }

    if (!regexCorreo.test(correoAdmin)) {
        showError("!El correo electrónico no tiene un formato válido.¡");
        return;
    }

    if (!tiposImgPermitidos.test(imagenAdmin)) {
        showError("Solo se permiten archivos de imagen (JPEG, PNG, JPG).");
        return;
    }

    if (!regexPassword.test(contrasenaAdmin)) {
        showError("La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!.");
        return;
    }

    event.target.submit();

}