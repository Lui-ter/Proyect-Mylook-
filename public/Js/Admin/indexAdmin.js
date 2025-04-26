document.addEventListener("DOMContentLoaded", function () {
    // Definicion de todas las secciones usando los IDs
    const secciones = {
        agenda: document.getElementById("agenda"),
        staff: document.getElementById("staff"),
        productos: document.getElementById("productos"),
        categoria: document.getElementById("categoria"),
        notificacion: document.getElementById("notificacion"),
    };

    // Referencias a los botones de navegación
    const botones = document.querySelectorAll(".boton-seccion");

    // Ocultar todas las secciones y mostrar la de agenda por defecto
    ocultarTodasLasSecciones();
    secciones.agenda.style.display = "flex";
    botones[0].classList.add("active");

    // Agregar eventos a los botones de navegación
    botones.forEach((boton) => {
        boton.addEventListener("click", function () {
            const nombreSeccion = this.textContent.toLowerCase().trim();

            botones.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");

            ocultarTodasLasSecciones();
            if (secciones[nombreSeccion]) {
                secciones[nombreSeccion].style.display = "flex"; // por defecto en escritorio
                secciones[nombreSeccion].classList.add("seccion-activa"); // esto activa el CSS para móvil

                if (nombreSeccion === "agenda") {
                    setTimeout(() => {
                        calendar.updateSize();
                    }, 100); // pequeño delay para asegurar que ya está visible
                }
            }
        });
    });

    // logica para mostrar y ocultar secciones
    function ocultarTodasLasSecciones() {
        Object.values(secciones).forEach((seccion) => {
            if (seccion) {
                seccion.style.display = "none";
                seccion.classList.remove("seccion-activa"); // 👈 quitamos la clase
            }
        });
    }
    // logica para actualizar el tamaño de la agenda
    window.addEventListener("resize", () => {
        const seccionagendaVisible = secciones.agenda.style.display !== "none";
        if (seccionagendaVisible) {
            setTimeout(() => {
                calendar.updateSize();
            }, 100);
        }
    });

    // *Lógica para abrir la sección de notificación*
    const elementosBandeja = document.querySelectorAll(".elemento-bandeja");
    const contenedorNotificacion = document.getElementById("notificacion");
    const bandejaEntrada = document.querySelector(".contenedor-bandeja");

    elementosBandeja.forEach((elemento) => {
        elemento.addEventListener("click", () => {
            ocultarTodasLasSecciones();
            contenedorNotificacion.style.display = "grid"; // Muestra la notificación
        });
    });
});

// funciones para cerrar y abrir el modal
function cerrarModal() {
    document.getElementById("detalleCitaModal").style.display = "none";
}

window.onclick = function (event) {
    const modal = document.getElementById("detalleCitaModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
