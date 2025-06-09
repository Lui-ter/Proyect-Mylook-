/* Expresiones regulares para validar caracteres */
const regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+(?:\s[a-zA-ZáéíóúÁÉÍÓÚñÑ]+)*$/;
const regexDescripcion = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s.,!#?()-¿¡:;]+$/; // Letras, números y signos básicos
const regexNumerico = /^\d{10,}$/; // solo numeros
const regexCantidad = /^\d+$/;
const regexValor = /^\d+(\.\d{1,2})?$/; // Para valores con decimales opcionales (150, 199.99)
const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/; // Contraseñas seguras
const regexNit = /^[0-9-]{10,}$/; // Solo números y guion (-), mínimo 10 dígitos
const tiposImgPermitidos = /image\/(jpeg|png|jpg)/i; // Tipos de imagen permitidos (JPEG, PNG, JPG)
const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Correo electrónico
const regexDocumentoUsuario = /^[0-9]{8,}$/; // Solo números, mínimo 10 dígitos

/* FORMULARIO DE INSERCIÓN DE CATEGORIA */
function handleValidationCategory(event) {
    event.preventDefault();

    const nombreCategoria = document
        .getElementById("nombreCategoria")
        ?.value.trim();
    const descripcionCategoria = document
        .getElementById("descripcion")
        ?.value.trim();
    const imagenCategoria = document.getElementById("imagen")?.files[0];
    const editProduct = document.querySelector(
        'input[name="editProduct"]'
    )?.value;

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const form = document.querySelector(".formulario");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !nombreCategoria ||
        !descripcionCategoria ||
        (!imagenCategoria && !editProduct)
    ) {
        showError("¡Faltan campos por llenar!");
        return;
    }

    if (!regexNombre.test(nombreCategoria)) {
        showError(
            "¡El nombre de la categoría solo puede contener letras y espacios!"
        );
        return;
    }

    if (!regexDescripcion.test(descripcionCategoria)) {
        showError(
            "¡La descripción solo puede contener letras, números y signos básicos!"
        );
        return;
    }

    if (imagenCategoria && !tiposImgPermitidos.test(imagenCategoria.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE INSERCIÓN DE SERVICIO */
function handleValidationService(event) {
    event.preventDefault();

    const nombreServicios = document
        .getElementById("nombreServicio")
        ?.value.trim();
    const precioServicios = document
        .getElementById("precioServicio")
        ?.value.trim();
    const duracionServicios = document
        .getElementById("duracionServicio")
        ?.value.trim();
    const descripcionServicios = document
        .getElementById("descripcionServicio")
        ?.value.trim();

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const form = document.querySelector(".contenedor-formularios");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);

        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);

        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !nombreServicios ||
        !descripcionServicios ||
        !precioServicios ||
        !duracionServicios
    ) {
        showError("¡Faltan campos por llenar!");
        return;
    }

    if (!regexNombre.test(nombreServicios)) {
        showError(
            "¡El nombre del servicio solo puede contener letras y espacios!"
        );
        return;
    }

    if (!regexDescripcion.test(descripcionServicios)) {
        showError(
            "¡La descripción solo puede contener letras, números y signos básicos!"
        );
        return;
    }

    if (
        !regexValor.test(precioServicios) ||
        !regexCantidad.test(duracionServicios)
    ) {
        showError("¡El precio y la duración deben ser valores numéricos!");
        return;
    }

    event.target.submit();
}

/* FORMULARIO DE INSERCIÓN DE PRODUCTOS */
function handleValidationProduct(event) {
    event.preventDefault();

    const nombre = document.getElementById("nombreProducto")?.value.trim();
    const marca = document.getElementById("marcaProducto")?.value.trim();
    const imagen = document.getElementById("insercion-imagen")?.files[0];
    const desc = document.getElementById("descripcionProducto")?.value.trim();
    const cantidad = document.getElementById("cantidadProducto")?.value.trim();
    const precio = document.getElementById("valorProducto")?.value.trim();
    const editProduct = document.querySelector(
        'input[name="editProduct"]'
    )?.value;

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const form = document.querySelector(".formulario-productos");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    // Validación general
    if (
        !nombre ||
        !marca ||
        !desc ||
        !cantidad ||
        !precio ||
        (!imagen && !editProduct)
    ) {
        showError("¡Faltan campos por llenar!");
        return;
    }

    if (!regexNombre.test(nombre) || !regexNombre.test(marca)) {
        showError(
            "¡El nombre y la marca solo pueden contener letras y espacios!"
        );
        return;
    }

    if (!regexDescripcion.test(desc)) {
        showError(
            "¡La descripción solo puede contener letras, números y signos básicos!"
        );
        return;
    }

    if (!regexCantidad.test(cantidad) || !regexValor.test(precio)) {
        showError("¡La cantidad y el precio deben ser valores numéricos!");
        return;
    }

    if (imagen && !tiposImgPermitidos.test(imagen.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }

    event.target.submit();
}

// FORMULARIO DE REGISTRO
function handleValidationRegister(event) {
    event.preventDefault();

    const tipo_usuario = document.getElementById("tipo_usuario").value;
    const form = document.querySelector(".registerForm");

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);

        // Mostrar y luego desaparecer a los 3 segundos
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);

        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (tipo_usuario === "1") {
        // NEGOCIO
        const nitNegocio = document.getElementById("1").value.trim();
        const nombreNegocio = document.getElementById("2").value.trim();
        const contrasenaNegocio = document.getElementById("3").value.trim();

        if (!nitNegocio || !nombreNegocio || !contrasenaNegocio) {
            showError("¡Faltan campos por llenar en el negocio!");
            return;
        }

        if (!regexNit.test(nitNegocio)) {
            showError(
                "¡El NIT debe tener al menos 10 caracteres y solo puede contener números y guion (-)!"
            );
            return;
        }

        if (!regexNombre.test(nombreNegocio)) {
            showError(
                "¡El nombre del negocio solo puede contener letras y espacios!"
            );
            return;
        }

        if (!regexPassword.test(contrasenaNegocio)) {
            showError(
                "¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!"
            );
            return;
        }
    } else {
        // USUARIO
        const documentoUsuario = document.getElementById("4").value.trim();
        const nombreUsuario = document.getElementById("5").value.trim();
        const passwordUsuario = document.getElementById("7").value.trim();

        if (!documentoUsuario || !nombreUsuario || !passwordUsuario) {
            showError("¡Faltan campos por llenar en el usuario!");
            return;
        }

        if (!regexDocumentoUsuario.test(documentoUsuario)) {
            showError(
                "¡El documento del usuario debe contener al menos 8 números!"
            );
            return;
        }

        if (!regexNombre.test(nombreUsuario)) {
            showError(
                "¡El nombre de usuario solo puede contener letras y espacios!"
            );
            return;
        }

        if (!regexPassword.test(passwordUsuario)) {
            showError(
                "¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!"
            );
            return;
        }
    }

    event.target.submit();
}

// FORMULARIO DE LOGIN
function handleValidationLogin(event) {
    event.preventDefault();

    const tipo_usuario = document.querySelector(
        ".loginForm .tipo_usuario"
    ).value;
    const form = document.querySelector(".loginForm");

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);

        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);

        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (tipo_usuario === "2") {
        // NEGOCIO
        const nitNegocio = document.getElementById("10").value.trim();
        const contrasenaNegocio = document.getElementById("11").value.trim();

        if (!nitNegocio || !contrasenaNegocio) {
            showError("¡Faltan campos por llenar en el negocio!");
            return;
        }
    } else {
        // USUARIO
        const documentoUsuario = document.getElementById("8").value.trim();
        const passwordUsuario = document.getElementById("9").value.trim();

        if (!documentoUsuario || !passwordUsuario) {
            showError("¡Faltan campos por llenar en el usuario!");
            return;
        }
    }

    event.target.submit();
}

/* FORMULARIO DE CONFIGURACION DE USUARIO */
function handleValidationConfigUser(event) {
    event.preventDefault();

    const documentoUsuario = document
        .getElementById("documentoUsuario")
        ?.value.trim();
    const nombreUsuario = document
        .getElementById("nombreUsuario")
        ?.value.trim();
    const apellidoUsuario = document
        .getElementById("apellidoUsuario")
        ?.value.trim();
    const telefonoUsuario = document
        .getElementById("telefonoUsuario")
        ?.value.trim();
    const correoUsuario = document
        .getElementById("correoUsuario")
        ?.value.trim();
    const condicionUsuario = document
        .getElementById("condicionUsuario")
        ?.value.trim();
    const imagenUsuario = document.getElementById("fileInput")?.files[0];

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.querySelector(".formConfig");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);

        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);

        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !documentoUsuario ||
        !nombreUsuario ||
        !apellidoUsuario ||
        !telefonoUsuario ||
        !correoUsuario ||
        !imagenUsuario
    ) {
        showError("¡Todos los campos son obligatorios!");
        return;
    }

    if (!regexDocumentoUsuario.test(documentoUsuario)) {
        showError("¡El documento debe contener solo números!");
        return;
    }

    if (
        !regexNombre.test(nombreUsuario) ||
        !regexNombre.test(apellidoUsuario)
    ) {
        showError("¡El nombre y el apellido solo pueden contener letras!");
        return;
    }

    if (!regexNumerico.test(telefonoUsuario) || telefonoUsuario.length < 7) {
        showError(
            "¡El teléfono debe contener solo números y tener al menos 7 dígitos!"
        );
        return;
    }

    if (!regexCorreo.test(correoUsuario)) {
        showError("¡El correo electrónico no tiene un formato válido!");
        return;
    }
    if (condicionUsuario === "0") {
        showError("¡Debes seleccionar una condición válida para el usuario!");
        return;
    }
    if (!regexDescripcion.test(condicionUsuario)) {
        showError(
            "¡La condición solo puede contener letras, números y signos básicos!"
        );
        return;
    }
    if (!tiposImgPermitidos.test(imagenUsuario.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }
    if (!imagenUsuario) {
        showError("¡Debes subir una imagen del usuario!");
        return;
    }

    event.target.submit();
}

function handleValidationUser(event) {
    event.preventDefault();

    const documentoUsuario = document.getElementById("idUser")?.value.trim();
    const nombreUsuario = document.getElementById("nombreUser")?.value.trim();
    const apellidoUsuario = document
        .getElementById("apellidoUser")
        ?.value.trim();
    const telefonoUsuario = document
        .getElementById("telefonoUser")
        ?.value.trim();
    const correoUsuario = document.getElementById("correoUser")?.value.trim();
    const condicionUsuario = document
        .getElementById("condicionUser")
        ?.value.trim();
    const imagenUsuario = document.getElementById("fileInput")?.files[0];

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.getElementById("form1");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);

        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);

        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !documentoUsuario ||
        !nombreUsuario ||
        !apellidoUsuario ||
        !telefonoUsuario ||
        !correoUsuario
    ) {
        showError("¡Todos los campos son obligatorios!");
        return;
    }

    if (!regexDocumentoUsuario.test(documentoUsuario)) {
        showError("¡El documento debe contener solo números!");
        return;
    }

    if (
        !regexNombre.test(nombreUsuario) ||
        !regexNombre.test(apellidoUsuario)
    ) {
        showError("¡El nombre y el apellido solo pueden contener letras!");
        return;
    }

    if (!regexCorreo.test(correoUsuario)) {
        showError("¡El correo electrónico no tiene un formato válido!");
        return;
    }

    if (!regexNumerico.test(telefonoUsuario)) {
        showError(
            "¡El teléfono debe contener solo números y tener al menos 10 dígitos!"
        );
        return;
    }
    // Si el campo es opcional, solo valida si tiene valor
    if (condicionUsuario && !regexDescripcion.test(condicionUsuario)) {
        showError(
            "¡La condición solo puede contener letras, números y signos básicos!"
        );
        return;
    }
    if (imagenUsuario && !tiposImgPermitidos.test(imagenUsuario.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
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
    const imagenStaff = document.getElementById("imagenServicio")?.files[0];
    const editStaff = document.querySelector('input[name="editStaff"]')?.value;

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const form = document.querySelector(".contenedorForm");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !documentoStaff ||
        !nombreStaff ||
        !apellidoStaff ||
        !telefonoStaff ||
        !correoStaff ||
        rolStaff === "0"
    ) {
        showError("¡Todos los campos son obligatorios!");
        return;
    }

    if (!editStaff) {
        if (!contrasenaStaff || !imagenStaff) {
            showError(
                "¡La imagen y la contraseña son obligatorias al registrar!"
            );
            return;
        }
    }

    if (!regexDocumentoUsuario.test(documentoStaff)) {
        showError("¡El documento debe contener mínimo 10 números!");
        return;
    }

    if (!regexNombre.test(nombreStaff) || !regexNombre.test(apellidoStaff)) {
        showError("¡El nombre y el apellido solo pueden contener letras!");
        return;
    }

    if (!editStaff && !regexPassword.test(contrasenaStaff)) {
        showError(
            "¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!"
        );
        return;
    }

    if (!regexCorreo.test(correoStaff)) {
        showError("¡El correo electrónico no tiene un formato válido!");
        return;
    }

    if (!regexNumerico.test(telefonoStaff) || telefonoStaff.length < 7) {
        showError(
            "¡El teléfono debe contener solo números y tener al menos 7 dígitos!"
        );
        return;
    }

    if (imagenStaff && !tiposImgPermitidos.test(imagenStaff.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }

    event.target.submit();
}

/* VALIDACIONES FORMULARIO ADMIN */
function handleValidationAdmin(event) {
    event.preventDefault();

    const documentoAdmin = document.getElementById("idAdmin")?.value.trim();
    const nombreAdmin = document.getElementById("nombreAdmin")?.value.trim();
    const apellidoAdmin = document
        .getElementById("apellidoAdmin")
        ?.value.trim();
    const telefonoAdmin = document
        .getElementById("telefonoAdmin")
        ?.value.trim();
    const correoAdmin = document.getElementById("correoAdmin")?.value.trim();
    const contrasenaAdmin = document
        .getElementById("contrasenaAdmin")
        ?.value.trim();
    const imagenAdmin = document.getElementById("fileInput")?.files[0];

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const form = document.getElementById("form1");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !documentoAdmin ||
        !nombreAdmin ||
        !apellidoAdmin ||
        !telefonoAdmin ||
        !correoAdmin ||
        !contrasenaAdmin ||
        !imagenAdmin
    ) {
        showError("¡Todos los campos son obligatorios!");
        return;
    }
    if (!regexDocumentoUsuario.test(documentoAdmin)) {
        showError("¡El documento debe contener mínimo 10 números!");
        return;
    }
    if (!regexNombre.test(nombreAdmin) || !regexNombre.test(apellidoAdmin)) {
        showError("¡El nombre y el apellido solo pueden contener letras!");
        return;
    }
    if (!regexCorreo.test(correoAdmin)) {
        showError("¡El correo electrónico no tiene un formato válido!");
        return;
    }
    if (!regexNumerico.test(telefonoAdmin)) {
        showError(
            "¡El teléfono debe contener solo números y tener al menos 10 dígitos!"
        );
        return;
    }
    if (imagenAdmin && !tiposImgPermitidos.test(imagenAdmin.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }
    if (!regexPassword.test(contrasenaAdmin)) {
        showError(
            "¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!"
        );
        return;
    }
    event.target.submit();
}

/* VALIDACIONES FORMULARIO DE EDITAR ADMIN */
function handleValidationUpdateAdmin(event) {
    event.preventDefault();

    const documentoAdmin = document.getElementById("idAdmin")?.value.trim();
    const nombreAdmin = document.getElementById("nombreAdmin")?.value.trim();
    const apellidoAdmin = document
        .getElementById("apellidoAdmin")
        ?.value.trim();
    const telefonoAdmin = document
        .getElementById("telefonoAdmin")
        ?.value.trim();
    const correoAdmin = document.getElementById("correoAdmin")?.value.trim();
    const imagenAdmin = document.getElementById("fileInput")?.files[0];

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    const form = document.getElementById("form1");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (
        !documentoAdmin ||
        !nombreAdmin ||
        !apellidoAdmin ||
        !telefonoAdmin ||
        !correoAdmin
    ) {
        showError("¡Todos los campos son obligatorios!");
        return;
    }
    if (!regexDocumentoUsuario.test(documentoAdmin)) {
        showError("¡El documento debe contener mínimo 10 números!");
        return;
    }
    if (!regexNombre.test(nombreAdmin) || !regexNombre.test(apellidoAdmin)) {
        showError("¡El nombre y el apellido solo pueden contener letras!");
        return;
    }
    if (!regexNumerico.test(telefonoAdmin)) {
        showError(
            "¡El teléfono debe contener solo números y tener al menos 10 dígitos!"
        );
        return;
    }
    if (!regexCorreo.test(correoAdmin)) {
        showError("¡El correo electrónico no tiene un formato válido!");
        return;
    }
    if (imagenAdmin && !tiposImgPermitidos.test(imagenAdmin.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }
    event.target.submit();
}

/* VALIDACIONES FORMULARIO NEGOCIO Al EDITARLO DESDE EL PERFIL DEL ADMINISTRADOR */
function handleValidationNegocio(event) {
    event.preventDefault();

    const imagenPerfil = document.getElementById("inputLogo")?.files[0];
    const imagenPortada = document.getElementById("inputImagenFondo")?.files[0];
    const descripcionNegocio = document
        .getElementById("inputDescrip")
        ?.value.trim();

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.getElementById("form2");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (imagenPerfil && !tiposImgPermitidos.test(imagenPerfil.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }
    if (imagenPortada && !tiposImgPermitidos.test(imagenPortada.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }
    if (!regexDescripcion.test(descripcionNegocio)) {
        showError(
            "¡La descripción solo puede contener letras, números y signos básicos!"
        );
        return;
    }
    event.target.submit();
}

/* VALIDACIONES FORMULARIO ACTUALIZACION NEGOCIO POR PRIMERA VEZ AL COMPLETAR EL REGISTRO */
function handleValidationUpdateNegocioOne(event) {
    event.preventDefault();

    const imagenPerfil = document.getElementById("inputLogo")?.files[0];
    const imagenPortada = document.getElementById("inputImagenFondo")?.files[0];
    const descripcionNegocio = document
        .getElementById("inputDescrip")
        ?.value.trim();

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.getElementById("form2");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (!descripcionNegocio) {
        showError("¡La descripcion es obligatoria!");
        return;
    }
    if (!imagenPerfil) {
        showError("¡La imagen de perfil es obligatoria!");
        return;
    }
    if (!imagenPortada) {
        showError("¡La imagen de portada es obligatoria!");
        return;
    }

    if (imagenPerfil && !tiposImgPermitidos.test(imagenPerfil.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }

    if (imagenPortada && !tiposImgPermitidos.test(imagenPortada.type)) {
        showError("¡Solo se permiten archivos de imagen (JPEG, PNG, JPG)!");
        return;
    }

    if (!regexDescripcion.test(descripcionNegocio)) {
        showError(
            "¡La descripción solo puede contener letras, números y signos básicos!"
        );
        return;
    }

    event.target.submit();
}

/* VALIDACIONES FORMULARIO ESTABLECIMIENTO */
function handleValidationEstablecimiento(event) {
    const documentoEstablecimiento = document
        .getElementById("idEstablc")
        ?.value.trim();
    const nombreEstablecimiento = document
        .getElementById("nombreEst")
        ?.value.trim();
    const direccionEstablecimiento = document
        .getElementById("direccionEstablecimiento")
        ?.value.trim();
    const telefonoEstablecimiento = document
        .getElementById("telefonoEstablecimiento")
        ?.value.trim();
    const descripcionEstablecimiento = document
        .getElementById("inputDescripcion")
        ?.value.trim();
    const correoEstablecimiento = document
        .getElementById("correoEstablecimiento")
        ?.value.trim();

    // Remueve alertas previas
    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // Contenedor para mostrar errores
    const form = document.getElementById("form3");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.textContent = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    // Validación de campos vacíos
    if (
        !documentoEstablecimiento ||
        !nombreEstablecimiento ||
        !direccionEstablecimiento ||
        !telefonoEstablecimiento ||
        !descripcionEstablecimiento ||
        !correoEstablecimiento
    ) {
        event.preventDefault();
        showError("¡Todos los campos son obligatorios!");
        return;
    }

    // Validaciones con expresiones regulares (usa las que declaraste)
    if (!regexNit.test(documentoEstablecimiento)) {
        event.preventDefault();
        showError(
            "¡El documento debe contener mínimo 10 números y puede incluir guiones!"
        );
        return;
    }
    if (!regexNombre.test(nombreEstablecimiento)) {
        event.preventDefault();
        showError("¡El nombre solo puede contener letras y espacios!");
        return;
    }
    if (!regexDescripcion.test(direccionEstablecimiento)) {
        event.preventDefault();
        showError(
            "¡La dirección solo puede contener letras, números y signos básicos!"
        );
        return;
    }
    if (!regexNumerico.test(telefonoEstablecimiento)) {
        event.preventDefault();
        showError(
            "¡El teléfono debe contener solo números y tener al menos 10 dígitos!"
        );
        return;
    }
    if (!regexDescripcion.test(descripcionEstablecimiento)) {
        event.preventDefault();
        showError(
            "¡La descripción solo puede contener letras, números y signos básicos!"
        );
        return;
    }
    if (!regexCorreo.test(correoEstablecimiento)) {
        event.preventDefault();
        showError("¡El correo electrónico no tiene un formato válido!");
        return;
    }

    // Si llega aquí, todo está bien y el formulario se envía normalmente
}

function handleValidationValoracion(event) {
    event.preventDefault();

    const calificacion = document.getElementById("calificacion")?.value.trim();
    const comentario = document.getElementById("comentario")?.value.trim();

    const alertContainer = document.getElementById("alertContainer");
    if (alertContainer) {
        alertContainer.remove();
    }

    // CONTENEDOR MANEJO DE ERRORES
    const form = document.getElementById("formValoracion");
    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (!calificacion || !comentario) {
        showError("¡Todos los campos son obligatorios!");
        return;
    }
    if (!regexValor.test(calificacion)) {
        showError("¡La calificación debe ser un número entre 1 y 5!");
        return;
    }
    if (!regexDescripcion.test(comentario)) {
        showError(
            "¡El comentario solo puede contener letras, números y signos básicos!"
        );
        return;
    }
    event.target.submit();
}
function handleValidationCita(event) {
    event.preventDefault();

    const fecha = document.getElementById("fecha")?.value;
    const hora = document.getElementById("hora")?.value;
    const staff = document.getElementById("idStaff")?.value;

    const categoriaSelect = document.getElementById("categoria");
    const servicioSelect = document.getElementById("servicio");

    const categoriaValida =
        categoriaSelect && categoriaSelect.selectedIndex > 0;
    const servicioValido = servicioSelect && servicioSelect.selectedIndex > 0;

    const cantidad = document.getElementById("cantidadProducto")?.value;

    const productoSelect = document.getElementById("producto");
    const productoSeleccionado =
        productoSelect.options[productoSelect.selectedIndex];
    const productoValido =
        productoSeleccionado && !productoSeleccionado.disabled;

    const form = document.getElementById("citaForm");
    const existingAlert = document.getElementById("alertContainer");
    if (existingAlert) existingAlert.remove();

    const alertDiv = document.createElement("div");
    alertDiv.id = "alertContainer";
    alertDiv.classList.add("validacion-error");

    function showError(message) {
        alertDiv.innerHTML = message;
        form.prepend(alertDiv);
        setTimeout(() => {
            alertDiv.style.opacity = "0";
        }, 3000);
        setTimeout(() => {
            alertDiv.remove();
        }, 3500);
    }

    if (!fecha || !hora || !staff || !categoriaValida || !servicioValido) {
        showError(
            "¡Debe seleccionar fecha, hora, staff, categoría y servicio!"
        );
        return;
    }

    if (productoValido) {
        if (!cantidad || isNaN(cantidad) || parseInt(cantidad) <= 0) {
            showError("¡Debe ingresar una cantidad válida para el producto!");
            return;
        }

        const maxStock = parseInt(
            productoSeleccionado.getAttribute("data-stock")
        );
        if (parseInt(cantidad) > maxStock) {
            showError("¡La cantidad seleccionada excede el stock disponible!");
            return;
        }
    }

    event.target.submit();
}
