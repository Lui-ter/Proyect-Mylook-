document.addEventListener('DOMContentLoaded', function () {
    /* INPUTS DEL FORMULARIO */
    const formElements = {
        nombreProd: document.getElementById('nombreProducto'),
        idEstablecimiento: document.getElementById('idEstablecimiento'),
        marcaProd: document.getElementById('marcaProducto'),
        cantidadProd: document.getElementById('cantidadProducto'),
        valorProd: document.getElementById('valorProducto'),
        imgProd: document.getElementById('insercion-imagen'),
        descProducto: document.getElementById('descripcionProducto'),
    };

    /* ELEMENTOS QUE SE VAN A MOSTRAR */
    const previewElements = {
        nombreProd: document.getElementById('previewNombre'),
        descProducto: document.getElementById('previewDescripcion'),
        imgPreview: document.getElementById('imagenVisualizacion'),
        marcaProd: document.querySelector('.componentes-titulos .elementos:nth-of-type(1)'),
        cantidadProd: document.querySelector('.componentes-titulos .elementos:nth-of-type(2)'),
        valorProd: document.querySelector('.componentes-titulos .elementos:nth-of-type(3)')
    };

    /* ACTUALIZA LA VISTA */
    function actualizarVistaPrevia() {
        previewElements.nombreProd.textContent = formElements.nombreProd.value || 'NOMBRE';
        previewElements.descProducto.textContent = formElements.descProducto.value || 'Descripción...';
        previewElements.marcaProd.textContent = formElements.marcaProd.value || ' ';
        previewElements.cantidadProd.textContent = formElements.cantidadProd.value || ' ';
        previewElements.valorProd.textContent = formElements.valorProd.value || ' ';
    }

    /* ACTUALIZAR TEXTO Y DESCRIPCIÓN */
    [formElements.nombreProd, formElements.descProducto, formElements.marcaProd, formElements.cantidadProd, formElements.valorProd].forEach(element => {
        if (element) {
            element.addEventListener('input', actualizarVistaPrevia);
        }
    });

    /* ACTUALIZAR VISTA DE LA IMAGEN */
    function mostrarImagenInicial() {
    const src = previewElements.imgPreview.getAttribute('src');
    if (src && src.trim() !== '') {
        previewElements.imgPreview.style.display = 'block';
    } else {
        previewElements.imgPreview.style.display = 'none';
    }
}

    formElements.imgProd.addEventListener('change', function () {
        const file = formElements.imgProd.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewElements.imgPreview.src = e.target.result;
                previewElements.imgPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            mostrarImagenInicial();
        }
    });


    /* ACTUALIZAR LA VISTA AL CARGAR LA PÁGINA */
    actualizarVistaPrevia();
    mostrarImagenInicial();

});