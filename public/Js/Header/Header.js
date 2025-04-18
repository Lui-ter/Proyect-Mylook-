const contenedorPerfil = document.getElementById('perfil');
const menuPerfil = document.getElementById('menu-perfil');

// Mostrar/ocultar menú de perfil con animación
// Se agrega un evento de clic al contenedor del perfil que alterna la visibilidad del menú de perfil
contenedorPerfil.addEventListener('click', () => {
  if (menuPerfil.classList.contains('oculto')) {
    menuPerfil.classList.remove('oculto', 'animar-salir');
    menuPerfil.classList.add('animar-entrar');

  } else {
    // Si el menú de perfil no está oculto, se quita la clase de animación de entrada y se agrega la de salida
    menuPerfil.classList.remove('animar-entrar');
    menuPerfil.classList.add('animar-salir');

    menuPerfil.addEventListener('animationend', function ocultar() {
      menuPerfil.classList.add('oculto');
      menuPerfil.removeEventListener('animationend', ocultar);
    });
  }
});

// Se seleccionan los elementos del DOM necesarios para la funcionalidad de búsqueda y categorías
const btnBuscar = document.querySelector('.lupa');
const menuBusqueda = document.querySelector('.menu-busqueda');
const btnCategorias = document.querySelector('.ejecutar-categorias');
const contenedorBotones = document.querySelector('.contenedor-botones-categorias');

// Mostrar/ocultar cuadro de búsqueda con animación
btnBuscar.addEventListener('click', () => {
  if (menuBusqueda.classList.contains('oculto')) {
    menuBusqueda.classList.remove('oculto', 'animar-salir');
    menuBusqueda.classList.add('animar-entrar');
  } else {
    menuBusqueda.classList.remove('animar-entrar');
    menuBusqueda.classList.add('animar-salir');

    // Se agrega un evento de finalización de animación al menú de búsqueda
    menuBusqueda.addEventListener('animationend', function ocultar() {
      menuBusqueda.classList.add('oculto');
      menuBusqueda.removeEventListener('animationend', ocultar);
    });
  }
});

// Mostrar/ocultar botones de categorías con animación
btnCategorias.addEventListener('click', () => {
  if (contenedorBotones.classList.contains('oculto')) {
    contenedorBotones.classList.remove('oculto', 'animar-salir');
    contenedorBotones.classList.add('animar-entrar');
  } else {
    contenedorBotones.classList.remove('animar-entrar');
    contenedorBotones.classList.add('animar-salir');

    contenedorBotones.addEventListener('animationend', function ocultar() {
      contenedorBotones.classList.add('oculto');
      contenedorBotones.removeEventListener('animationend', ocultar);
    });
  }
});

// Cerrar menús al hacer clic fuera
document.addEventListener('click', (event) => {
  // Perfil
  if (
    !contenedorPerfil.contains(event.target) &&
    !menuPerfil.contains(event.target) &&
    !menuPerfil.classList.contains('oculto')
  ) {
    menuPerfil.classList.remove('animar-entrar');
    menuPerfil.classList.add('animar-salir');
    menuPerfil.addEventListener('animationend', function ocultar() {
      menuPerfil.classList.add('oculto');
      menuPerfil.removeEventListener('animationend', ocultar);
    });
  }

  // Búsqueda
  if (
    !btnBuscar.contains(event.target) &&
    !menuBusqueda.contains(event.target) &&
    !menuBusqueda.classList.contains('oculto')
  ) {
    menuBusqueda.classList.remove('animar-entrar');
    menuBusqueda.classList.add('animar-salir');
    menuBusqueda.addEventListener('animationend', function ocultar() {
      menuBusqueda.classList.add('oculto');
      menuBusqueda.removeEventListener('animationend', ocultar);
    });
  }

  // Categorías
  if (
    !btnCategorias.contains(event.target) &&
    !contenedorBotones.contains(event.target) &&
    !contenedorBotones.classList.contains('oculto')
  ) {
    contenedorBotones.classList.remove('animar-entrar');
    contenedorBotones.classList.add('animar-salir');
    contenedorBotones.addEventListener('animationend', function ocultar() {
      contenedorBotones.classList.add('oculto');
      contenedorBotones.removeEventListener('animationend', ocultar);
    });
  }
});
