/* JAVASCRIPT ENCARGADO DE VALIDAR LOS INPUTS EN TODOS LOS FORMULARIOS RELACIONADOS AL CRUD */
/* ---------------------------------------------------------------------------------------- */

/* FORMULARIO DE INSERCIÓN DE CATEGORIA */

function handleValidationCategory(event){

    event.preventDefault();

    const nombreCategoria = document.getElementById('nombreCategoria').value;
    const descripcionCategoria = document.getElementById('descripcion').value;
    const imagenCategoria = document.getElementById('imagen').files[0];

    const caracteresNombre = /^[a-zA-Z]+$/;
    const caracteresDescripcion = /^[a-zA-Z0-9\s]+$/;
    const tiposImgPermitidos = ["image/jpeg", "image/png", "image/jpg"];

    if (!nombreCategoria || !descripcionCategoria || !imagenCategoria) {
        alert('¡Faltan campos por llenar!');
    }else{
        if (!caracteresNombre.test(nombreCategoria)) {
            alert('¡El nombre de la categoria solo puede contener letras!');
   
            return false;
        }else if(!caracteresDescripcion.test(descripcionCategoria)){
            alert('¡La descripción de la categoria solo puede contener caracteres alfanumericos!');
          
            return false;
        }else if(!tiposImgPermitidos.includes(imagenCategoria.type)){
            alert('Solo se permiten archivos de imagen (JPEG, PNG, JPG, GIF).');
            imagenCategoria.value = "";
            return false;
        }else{
            event.target.submit();
            return true;
        }
    }

}

/* FORMULARIO DE INSERCIÓN DE TIPO DE SERVICIO */

function handleValidationServiceType(event){

    event.preventDefault();

    const nombreServicios = document.getElementById('nombreServicios').value;

    const caracteresNombre = /^[a-zA-Z]+$/;

    if (!nombreServicios) {
        
        alert('¡El nombre no puede estar vacio!');
    }else{
        if (!caracteresNombre.test(nombreServicios)) {
            alert('¡El nombre del tipo de servicio solo puede contener letras!');
            return false;
        }else{
            event.target.submit();
            return true;
        }
    }

}

/* FORMULARIO DE INSERCIÓN DE PRODUCTOS */

function handleValidationProduct(event){

    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const marca = document.getElementById('marca').value;
    const imagen = document.getElementById('imagen').files[0];
    const desc = document.getElementById('desc').value;
    const cantidad = document.getElementById('cantidad').value;
    const precio = document.getElementById('valor').value;

    const caracteresPermitidos1 = /^[a-zA-Z]+$/;
    const caracteresPermitidos2 = /^[a-zA-Z0-9]+$/;
    const tiposImgPermitidos = ["image/jpeg", "image/png", "image/jpg"];

    if (!nombre || !marca || !imagen || !desc || !cantidad || !precio) {
        alert('¡Faltan campos por llenar!');
    }else{
        if (!caracteresPermitidos1.test(nombre)) {
            alert('¡El nombre del producto solamente puede contener letras!');
            return false;
        }else if(!!caracteresPermitidos2.test(desc)){
            alert('¡La descripción del producto solamente puede contener caracteres alfanumericos!');
            return false;
        }else if(!tiposImgPermitidos.includes(imagen)){
            alert('Solo se permiten archivos de imagen (JPEG, PNG, JPG, GIF).');
            return false;
        }else{
            event.target.submit();
            return true;
        }
    }

}

/* FORMULARIO DE INSERCIÓN DE SERVICIOS */

function handleValidationService(event){

    event.preventDefault();

    const nombre = document.getElementById('nombreServicio').value;
    const desc = document.getElementById('descripcionServicio').value;
    const imagen = document.getElementById('imagenServicio').files[0];

    const caracteresPermitidos1 = /^[a-zA-Z]+$/;
    const caracteresPermitidos2 = /^[a-zA-Z0-9]+$/;
    const tiposImgPermitidos = ["image/jpeg", "image/png"];

    if (!nombre || !desc || !imagen) {
        alert('¡Faltan campos por llenar!');
    } else {
        if (!caracteresPermitidos1.test(nombre)) {
            alert('¡El nombre del servicio solamente puede contener letras!');
            return false;
        } else if (caracteresPermitidos2.test(desc)) {
            alert('¡La descripción del servicio solo puede contener texto, no caracteres alfanuméricos!');
            return false;
        } else if (!tiposImgPermitidos.includes(imagen.type)) {
            alert('Solo se permiten archivos de imagen (JPEG, PNG).');
            return false;
        } else {
            event.target.submit();
            return true;
        }
    }

}