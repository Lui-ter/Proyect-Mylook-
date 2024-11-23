
/* ---------------------------------------------------------------------- */


document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencias a las secciones
    const crudDefault = document.querySelector('.sectionDefaultCrud'); // Sección por defecto
    const crudProductos = document.querySelector('.crudProductos'); // Sección de productos
    const crudStaff = document.querySelector('.crudMiembrostaff'); // Sección de staff
    const crudServicios = document.querySelector('.crudServicios'); // Sección de servicios
    const crudPresentacion = document.querySelector('.sectionPresentations'); // Presentación del negocio
    const crudInicio = document.querySelector('.sectionInicio'); // Inicio con imagen del negocio
    const menuItems = document.querySelectorAll('.navOptions'); // Botones del menú de navegación

    // Función para ocultar todas las secciones
    function hideAllSections() {
        // Ocultar todas las secciones si existen
        if (crudDefault) crudDefault.style.display = 'none';
        if (crudProductos) crudProductos.style.display = 'none';
        if (crudStaff) crudStaff.style.display = 'none';
        if (crudServicios) crudServicios.style.display = 'none';
        if (crudPresentacion) crudPresentacion.style.display = 'none';
        if (crudInicio) crudInicio.style.display = 'none';
    }

    // Función para mostrar una sección específica
    function showSection(section) {
        hideAllSections(); // Ocultar todas las demás secciones
        if (section) section.style.display = 'block'; // Mostrar solo la sección especificada
    }

    // Mostrar la sección por defecto al cargar la página
    if (crudDefault) {
        showSection(crudDefault); // Mostrar `sectionDefaultCrud` al inicio
    }

    // Añadir listeners a los botones del menú de navegación
    menuItems.forEach(button => {
        button.addEventListener('click', (e) => {
            const sectionId = e.target.id; // Obtener el id del botón clickeado

            // Mostrar la sección correspondiente según el botón presionado
            switch (sectionId) {
                case 'servicios':
                    showSection(crudServicios);
                    break;
                case 'productos':
                    showSection(crudProductos);
                    break;
                case 'staff':
                    showSection(crudStaff);
                    break;
                case 'inicio':
                    showSection(crudPresentacion); // Mostrar la presentación (inicio)
                    break;
                default:
                    showSection(crudDefault); // En caso de un botón desconocido, mostrar la sección por defecto
                    break;
            }
        });
    });
});

// Obtener elementos
const btnEditimagen = document.getElementById('editarImagen');
const inputFile = document.getElementById('inputFile');
const imgToEdit = document.getElementById('imgToEdit');

// Asignar evento al botón para que actúe como input file
btnEditimagen.addEventListener('click', () => {
    inputFile.click(); // Simular clic en el input file
});

// Asignar evento al input file para cambiar la imagen
inputFile.addEventListener('change', (event) => {
    const file = event.target.files[0]; // Obtener el archivo seleccionado
    if (file) {
        const reader = new FileReader();

        // Leer la imagen como URL y asignarla al src de la imagen
        reader.onload = (e) => {
            imgToEdit.src = e.target.result; // Cambiar la imagen mostrada
        };

        reader.readAsDataURL(file); // Leer el archivo como una URL
    }
});
// Referencias a las secciones
const sectionDefault = document.querySelector('.sectionDefaultCrud'); // Sección predeterminada
const viewProductos = document.querySelector('.viewProductos'); // Vista Productos
const viewCategorias = document.querySelector('.viewCategorias'); // Vista Categorías
const viewTipservicios = document.querySelector('.viewTipservicios'); // Vista Tipo Servicios
const viewServicios = document.querySelector('.viewServicios'); // Vista Servicios

// Botones de navegación "Ver todos"
const btnViewProductos = document.getElementById('viewAllproductos'); // Botón "Ver todos" de Productos
const btnViewCategorias = document.getElementById('viewAllcategorias'); // Botón "Ver todos" de Categorías
const btnViewTipServicios = document.getElementById('viewAlltipservicios'); // Botón "Ver todos" de Tipo Servicios
const btnViewServicios = document.getElementById('viewAllservicios'); // Botón "Ver todos" de Servicios

// Botones "Volver"
const btnVolverProductos = document.querySelector('.viewProductos .volver'); // Botón "Volver" en Productos
const btnVolverCategorias = document.querySelector('.viewCategorias .volver'); // Botón "Volver" en Categorías
const btnVolverTipServicios = document.querySelector('.viewTipservicios .volver'); // Botón "Volver" en Tipo Servicios
const btnVolverServicios = document.querySelector('.viewServicios .volver'); // Botón "Volver" en Servicios

// Función para ocultar todas las secciones
function hideAllSections() {
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
}

// Mostrar sección específica
function showSection(section) {
    hideAllSections(); // Ocultar todo
    section.style.display = 'block'; // Mostrar la sección deseada
}

// Botones "Ver todos"
btnViewProductos.addEventListener('click', (e) => {
    e.preventDefault();
    showSection(viewProductos); // Mostrar vista Productos
});

btnViewCategorias.addEventListener('click', (e) => {
    e.preventDefault();
    showSection(viewCategorias); // Mostrar vista Categorías
});

btnViewTipServicios.addEventListener('click', (e) => {
    e.preventDefault();
    showSection(viewTipservicios); // Mostrar vista Tipos de Servicios
});

btnViewServicios.addEventListener('click', (e) => {
    e.preventDefault();
    showSection(viewServicios); // Mostrar vista Servicios
});

// Botones "Volver"
btnVolverProductos.addEventListener('click', () => {
    showSection(sectionDefault); // Volver a la sección default
});

btnVolverCategorias.addEventListener('click', () => {
    showSection(sectionDefault); // Volver a la sección default
});

btnVolverTipServicios.addEventListener('click', () => {
    showSection(sectionDefault); // Volver a la sección default
});

btnVolverServicios.addEventListener('click', () => {
    showSection(sectionDefault); // Volver a la sección default
});
