document.addEventListener("DOMContentLoaded", function() {
    // Obtenemos las variables que necesitaremos usar 
    const botonBuscar = document.getElementById("botonBuscar");
    const opcionesBusqueda = document.getElementById("opcionesBusqueda");
    const botonCategorias = document.getElementById("botonCategorias");
    const submenuCategorias = document.getElementById("submenuCategorias");

    // Mostrar/ocultar opciones de búsqueda
    botonBuscar.addEventListener("click", function() {
        opcionesBusqueda.style.display =
            opcionesBusqueda.style.display === "grid" ? "none" : "grid";
    });

    // Mostrar menú de categorías al hacer clic en el botón
    botonCategorias.addEventListener("click", function() {
        submenuCategorias.classList.toggle("activo");
    });

    // Mantener abierto el submenú al pasar el mouse
    botonCategorias.addEventListener("mouseenter", function() {
        submenuCategorias.style.display = "grid";
    });

    submenuCategorias.addEventListener("mouseenter", function() {
        submenuCategorias.style.display = "grid";
    });

    // Ocultar el submenú solo cuando el mouse salga completamente
    submenuCategorias.addEventListener("mouseleave", function() {
        submenuCategorias.style.display = "none";
    });

    botonCategorias.addEventListener("mouseleave", function() {
        setTimeout(() => {
            if (!submenuCategorias.matches(":hover")) {
                submenuCategorias.style.display = "none";
            }
        }, 200);
    });

    // Ocultar menús al hacer clic fuera de ellos
    document.addEventListener("click", function(event) {
        if (!botonBuscar.contains(event.target) && !opcionesBusqueda.contains(event.target)) {
            opcionesBusqueda.style.display = "none";
        }

        if (!botonCategorias.contains(event.target) && !submenuCategorias.contains(event.target)) {
            submenuCategorias.style.display = "none";
        }
    });
});