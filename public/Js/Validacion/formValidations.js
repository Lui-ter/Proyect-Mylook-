/* JAVASCRIPT ENCARGADO DE VALIDAR LOS INPUTS EN TODOS LOS FORMULARIOS RELACIONADOS AL CRUD */
/* ---------------------------------------------------------------------------------------- */

/* FORMULARIO DE INSERCIÓN DE CATEGORIA */

function handleValidationCategory(event) {
    event.preventDefault();

    const nombreCategoria = document.getElementById("nombreCategoria").value.trim();
    const descripcionCategoria = document.getElementById("descripcion").value.trim();
    const imagenCategoria = document.getElementById("imagen").files[0];

    if (!nombreCategoria || !descripcionCategoria || !imagenCategoria) {
        alert("¡Faltan campos por llenar!");
    } else {
        if (!caracteresNombre.test(nombreCategoria)) {
            alert("¡El nombre de la categoria solo puede contener letras!");

            return false;
        } else if (!caracteresDescripcion.test(descripcionCategoria)) {
            alert(
                "¡La descripción de la categoria solo puede contener caracteres alfanumericos!"
            );

            return false;
        } else if (!tiposImgPermitidos.includes(imagenCategoria.type)) {
            alert("Solo se permiten archivos de imagen (JPEG, PNG, JPG, GIF).");
            imagenCategoria.value = "";
            return false;
        } else {
            event.target.submit();
            return true;
        }
    }
}

/* FORMULARIO DE INSERCIÓN DE TIPO DE SERVICIO */

function handleValidationServiceType(event) {
    event.preventDefault();

    const nombreServicios = document.getElementById("nombreServicios").value.trim();

    if (!nombreServicios) {
        alert("¡El nombre no puede estar vacio!");
    } else {
        if (!caracteresNombre.test(nombreServicios)) {
            alert(
                "¡El nombre del tipo de servicio solo puede contener letras!"
            );
            return false;
        } else {
            event.target.submit();
            return true;
        }
    }
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
        alert("¡Faltan campos por llenar!");
    } else {
        if (!caracteresPermitidos1.test(nombre)) {
            alert("¡El nombre del producto solamente puede contener letras!");
            return false;
        } else if (!!caracteresPermitidos2.test(desc)) {
            alert(
                "¡La descripción del producto solamente puede contener caracteres alfanumericos!"
            );
            return false;
        } else if (!tiposImgPermitidos.includes(imagen)) {
            alert("Solo se permiten archivos de imagen (JPEG, PNG, JPG, GIF).");
            return false;
        } else {
            event.target.submit();
            return true;
        }
    }
}

/* FORMULARIO DE INSERCIÓN DE SERVICIOS */

function handleValidationService(event) {
    event.preventDefault();

    const nombre = document.getElementById("nombreServicio").value;
    const desc = document.getElementById("descripcionServicio").value;
    const imagen = document.getElementById("imagenServicio").files[0];

    const caracteresPermitidos1 = /^[a-zA-Z]+$/;
    const caracteresPermitidos2 = /^[a-zA-Z0-9]+$/;
    const tiposImgPermitidos = ["image/jpeg", "image/png"];

    if (!nombre || !desc || !imagen) {
        alert("¡Faltan campos por llenar!");
    } else {
        if (!caracteresPermitidos1.test(nombre)) {
            alert("¡El nombre del servicio solamente puede contener letras!");
            return false;
        } else if (caracteresPermitidos2.test(desc)) {
            alert(
                "¡La descripción del servicio solo puede contener texto, no caracteres alfanuméricos!"
            );
            return false;
        } else if (!tiposImgPermitidos.includes(imagen.type)) {
            alert("Solo se permiten archivos de imagen (JPEG, PNG).");
            return false;
        } else {
            event.target.submit();
            return true;
        }
    }
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
            alert("¡Faltan campos por llenar en el negocio!");
            console.log(nitNegocio, nombreNegocio, contrasenaNegocio);
        } else {
            if (!caracteresNit.test(nitNegocio)) {
                alert("¡El nit del negocio solo debe contener numeros!");
                return false;
            } else if (!caracteresPermitidos2.test(nombreNegocio)) {
                alert(
                    "¡El negocio solo puede contener caracteres alfanumericos!"
                );
                return false;
            } else if (!contrasenaValida.test(contrasenaNegocio)) {
                alert(
                    "La contraseña del usuario debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número"
                );
                return false;
            } else {
                event.target.submit();
                return true;
            }
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
            showError("¡La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número!");
            return;
        }
    }

    event.target.submit();
}

/* FORMULARIO DE INICIO DE SESIÓN */
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
