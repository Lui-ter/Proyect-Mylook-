document.addEventListener('DOMContentLoaded', function() {
    // Referencias a las secciones
    const sectionDefault = document.querySelector('.sectionDefault');
    const crudStaff = document.querySelector('.crudStaff');
    const crudProductos = document.querySelector('.crudProductos');
    const crudCategoria = document.querySelector('.crudCategoria');
    const crudInicio = document.querySelector('.crudInicio');
    
    // Referencias a los botones
    const btns = document.querySelectorAll('.btnCrud');
    
    // Mostrar sección default al inicio
    showSection('default');
    
    // Añadir event listeners a los botones
    btns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover clase activa de todos los botones
            btns.forEach(b => b.classList.remove('btnActive'));
            
            // Añadir clase activa al botón clickeado
            this.classList.add('btnActive');
            
            // Obtener y mostrar la sección correspondiente
            const section = this.textContent.toLowerCase();
            showSection(section);
        });
    });
    
    // Función para mostrar secciones
    function showSection(section) {
        // Ocultar todas las secciones
        hideAllSections();
        
        // Mostrar la sección correspondiente
        switch(section) {
            case 'staff':
                crudStaff.style.display = 'block';
                break;
            case 'productos':
                crudProductos.style.display = 'block';
                break;
            case 'servicios':
                crudCategoria.style.display = 'block';
                break;
            case 'inicio':
                crudInicio.style.display = 'block';
                break;
            case 'administradores':
                // Si tienes una sección de administradores
                break;
            case 'default':
                sectionDefault.style.display = 'block';
                break;
        }
    }
    
    // Función para ocultar todas las secciones
    function hideAllSections() {
        sectionDefault.style.display = 'none';
        crudStaff.style.display = 'none';
        crudProductos.style.display = 'none';
        crudCategoria.style.display = 'none';
        crudInicio.style.display = 'none';
    }

    // Código del input file que ya tenías
    const fileInput = document.getElementById('fileInput');
    const previewImage = document.getElementById('previewImage');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.style.backgroundImage = `url('${e.target.result}')`;
            };
            
            reader.readAsDataURL(file);
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Referencias a todas las secciones
    const sections = {
        'administradores': document.querySelector('.sectionAdministrador'),
        'staff': document.querySelector('.crudStaff'),
        'productos': document.querySelector('.crudProductos'),
        'servicios': document.querySelector('.crudCategoria'),
        'inicio': document.querySelector('.crudInicio'),
        'default': document.querySelector('.sectionDefault')
    };

    // Referencias a los botones
    const buttons = document.querySelectorAll('.btnCrud');

    // Mostrar sección default al inicio y desactivar todos los botones
    hideAllSections();
    sections.default.style.display = 'block';

    // Agregar event listeners a los botones
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const sectionName = this.textContent.toLowerCase();
            
            // Desactivar todos los botones primero
            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            // Activar el botón actual
            this.classList.add('active');

            // Ocultar todas las secciones
            hideAllSections();

            // Mostrar la sección correspondiente
            if (sections[sectionName]) {
                sections[sectionName].style.display = 'block';
            }
        });
    });

    function hideAllSections() {
        Object.values(sections).forEach(section => {
            if (section) section.style.display = 'none';
        });
    }

    // Mantener el código del input file
    const fileInput = document.getElementById('fileInput');
    const previewImage = document.getElementById('previewImage');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.style.backgroundImage = `url('${e.target.result}')`;
            };
            reader.readAsDataURL(file);
        }
    });
});



/* LOGICA DEL PANEL DEL ADMIN DE INICIO DE SESION DE LOS ADMINISTRADORES */
const pista = document.getElementById('pistaCarrusel');
const tarjetas = document.querySelectorAll('.tarjetaUsuario');
const tarjetaWidth = tarjetas[0].offsetWidth + 20; // Ancho + margen
let posicion = 0;
let animationPaused = false;

// Clonar las tarjetas iniciales para crear el efecto infinito
function inicializarCarrusel() {
    // Clonar todas las tarjetas originales
    const tarjetasOriginales = Array.from(tarjetas);
    tarjetasOriginales.forEach(tarjeta => {
        const clon = tarjeta.cloneNode(true);
        pista.appendChild(clon);
    });

    // Configurar eventos de hover para todas las tarjetas (originales y clonadas)
    document.querySelectorAll('.tarjetaUsuario').forEach(tarjeta => {
        tarjeta.addEventListener('mouseenter', () => {
            animationPaused = true;
        });
        
        tarjeta.addEventListener('mouseleave', () => {
            animationPaused = false;
        });
    });
}

function moverCarrusel() {
    if (animationPaused) {
        requestAnimationFrame(moverCarrusel);
        return;
    }

    posicion -= 0.5; // Velocidad del movimiento
    const totalWidth = -tarjetaWidth * (tarjetas.length);
    
    // Cuando llegamos al final del primer conjunto, reseteamos la posición
    if (posicion <= totalWidth) {
        posicion = 0;
    }
    
    pista.style.transform = `translateX(${posicion}px)`;
    requestAnimationFrame(moverCarrusel);
}

// Inicializar el carrusel
inicializarCarrusel();
moverCarrusel();