document.addEventListener("DOMContentLoaded", function () {
    // extraemos las variables que necesitaremos utilizar
    // logica para el carrusel
    const carrusel = document.querySelector(".carrusel");
    const elementosCarrusel = document.querySelectorAll(".elemento-carrusel");
    const botonAnterior = document.querySelector(".boton-anterior");
    const botonSiguiente = document.querySelector(".boton-siguiente");

    if (!carrusel || elementosCarrusel.length === 0) {
        console.error("No se encontraron elementos en el carrusel.");
        return;
    }

    let indiceActual = 1;
    let anchoElemento, margenElemento;
    let autoPlay, inactividadTimer;

    // Inicializa el carrusel
    function inicializarCarrusel() {
        const primerElemento = elementosCarrusel[0];
        anchoElemento = primerElemento.offsetWidth;
        margenElemento = parseInt(getComputedStyle(primerElemento).marginRight) || 0;

        if (isNaN(anchoElemento) || anchoElemento === 0) {
            console.error("El ancho del elemento no es válido.");
            return;
        }

        actualizarCarrusel(false);
    }

    // Mueve el carrusel al elemento actual
    function actualizarCarrusel(conTransicion = true) {
        if (!carrusel || elementosCarrusel.length === 0) return;

        // ⚡ Recalcula el tamaño de los elementos (IMPORTANTE para evitar errores en resize)
        anchoElemento = elementosCarrusel[0].offsetWidth;
        margenElemento = parseInt(window.getComputedStyle(elementosCarrusel[0]).marginRight) || 0;

        carrusel.style.transition = conTransicion ? "transform 0.5s ease-in-out" : "none";

        // Centra el elemento activo correctamente incluso en pantallas pequeñas
        const desplazamiento =
            -indiceActual * (anchoElemento + margenElemento) +
            (carrusel.parentElement.offsetWidth / 2 - anchoElemento / 2);

        carrusel.style.transform = `translateX(${desplazamiento}px)`;

        //Asegura que solo el elemento actual tenga la clase "activo"
        elementosCarrusel.forEach((elemento, indice) => {
            elemento.classList.toggle("activo", indice === indiceActual);
        });

        // Restablece la transición si se desactivó temporalmente
        if (!conTransicion) {
            setTimeout(() => (carrusel.style.transition = "transform 0.5s ease-in-out"), 50);
        }
    }

    // Navegar en el carrusel
    function irAlAnterior() {
        indiceActual = indiceActual > 0 ? indiceActual - 1 : elementosCarrusel.length - 1;
        actualizarCarrusel();
        resetearAutoPlay();
    }

    function irAlSiguiente() {
        indiceActual = indiceActual < elementosCarrusel.length - 1 ? indiceActual + 1 : 0;
        actualizarCarrusel();
        resetearAutoPlay();
    }

    // Eventos de click en botones
    botonAnterior?.addEventListener("click", irAlAnterior);
    botonSiguiente?.addEventListener("click", irAlSiguiente);

    // Ajustar carrusel en redimensionamiento de pantalla
    let resizeTimeout;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            inicializarCarrusel();
        }, 150);
    });

    // Autoplay cada 3 segundos
    function iniciarAutoPlay() {
        detenerAutoPlay();
        autoPlay = setInterval(irAlSiguiente, 3000);
    }

    function detenerAutoPlay() {
        clearInterval(autoPlay);
    }

    function resetearAutoPlay() {
        detenerAutoPlay();
        iniciarAutoPlay();
    }

    function resetearInactividad() {
        clearTimeout(inactividadTimer);
        inactividadTimer = setTimeout(reiniciarAutoPlay, 5000);
    }

    // Manejo de interacción , este evita autoplay si hay interacción
    ["touchstart", "click"].forEach(evento => {
        carrusel.addEventListener(evento, () => {
            detenerAutoPlay();
            resetearInactividad();
        });
    });

    // Iniciar todo
    inicializarCarrusel();
    iniciarAutoPlay();



    // javascript para el desplazamiento de los tops
    document.querySelectorAll(".top").forEach((enlace) => {
        enlace.addEventListener("click", function (e) {
            e.preventDefault(); // Evita el comportamiento predeterminado
            const targetId = this.getAttribute("href").substring(1); // Obtiene el ID destino
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop, // Calcula la posición
                    behavior: "smooth", // Aplica el efecto suave
                });
            }
        });
    });

    // Logica para opciones del usuario
    const imagenPerfil = document.getElementById("imagenPerfil");
    const menuDesplegable = document.getElementById("menuDesplegable");

    imagenPerfil.addEventListener("click", function (event) {
        // Alternar la visibilidad del menú
        if (menuDesplegable.style.display === "block") {
            menuDesplegable.style.display = "none";
        } else {
            menuDesplegable.style.display = "block";
        }
        event.stopPropagation();
    });

    // Cerrar el menú si se hace clic fuera de el
    document.addEventListener("click", function (event) {
        if (
            !menuDesplegable.contains(event.target) &&
            event.target !== imagenPerfil
        ) {
            menuDesplegable.style.display = "none";
        }
    });
});

    // Logica para Filtrar un establecimiento en el index usuario a travez del nombre de la categoria o del negocios
    document.addEventListener('DOMContentLoaded', () => {
        const inputBusqueda = document.querySelector('#busqueda-input');
        const btnBuscar = document.querySelector('.boton-jecutar');
        const seccionRecomendados = document.querySelector('#resultados');
        const cartas = seccionRecomendados ? seccionRecomendados.querySelectorAll('.carta-establecimiento') : [];
        if (!inputBusqueda || !btnBuscar || !seccionRecomendados) {
            console.error('No se encontró input, botón o sección resultados');
            return;
        }
        let debounceTimeout; // Con esto se retrasa la funcion
    function filtrarCartas(){
        const texto = inputBusqueda.value.toLowerCase().trim();
        let hayVisible = false;
        cartas.forEach(carta => {
            const nombreElem = carta.querySelector('.nombre-descripcion h2');
            const nombreNegocio = nombreElem ? nombreElem.textContent.toLowerCase() : '';
            const categoriasElems = carta.querySelectorAll('.servicios ul li');
            const categorias = Array.from(categoriasElems).map(li => li.textContent.toLowerCase());
            const coincideNombre = nombreNegocio.includes(texto);
            const coincideCategoria = categorias.some(cat => cat.includes(texto));
            if(!texto || coincideNombre || coincideCategoria){
                carta.style.display = '';
                hayVisible = true;
            }else{
                carta.style.display = 'none';
            }
        });
        const mensajeNoResultados = document.querySelector('#mensaje-no-resultados');
        if(!hayVisible){
            mensajeNoResultados.style.display = 'block';
            inputBusqueda.focus();
        }else{
            mensajeNoResultados.style.display = 'none';
        }
        return hayVisible;
    }
    function scrollARecomendados(){
        if(inputBusqueda.value.trim() !== ''){
            const hayResultados = filtrarCartas();
            seccionRecomendados.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
    inputBusqueda.addEventListener('input', () => {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            if(inputBusqueda.value.trim() === ''){
                // Si el input se vacía, vuelve arriba y muestra todo
                filtrarCartas();
                document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
            }else{
                scrollARecomendados();
            }
        }, 500); // Espera 500ms tras dejar de escribir
    });
    btnBuscar.addEventListener('click', e => {
        e.preventDefault();
        filtrarCartas();
        scrollARecomendados();
    });
});

