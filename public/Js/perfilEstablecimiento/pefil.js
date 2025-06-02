document.addEventListener('DOMContentLoaded', () => {
    const carruseles = [
      { listaId: 'lista-staff', prevId: 'btn-prev-staff', nextId: 'btn-next-staff' },
      { listaId: 'lista-servicios', prevId: 'btn-prev-servicios', nextId: 'btn-next-servicios' },
      { listaId: 'lista-productos', prevId: 'btn-prev-productos', nextId: 'btn-next-productos' }
    ];

    carruseles.forEach(({ listaId, prevId, nextId }) => {
      const lista = document.getElementById(listaId);
      const prevBtn = document.getElementById(prevId);
      const nextBtn = document.getElementById(nextId);

      let direction = 1; // 1 = derecha, -1 = izquierda

      const getTarjetaWidth = () => {
        const tarjeta = lista.querySelector('.tarjeta');
        if (!tarjeta) return 0;
        const style = window.getComputedStyle(tarjeta);
        const gap = parseInt(style.marginRight) || 16;
        return tarjeta.offsetWidth + gap;
      };

      const scrollAuto = () => {
        const width = getTarjetaWidth();
        const maxScrollLeft = lista.scrollWidth - lista.clientWidth;

        if (lista.scrollLeft >= maxScrollLeft - 2) {
          direction = -1;
        } else if (lista.scrollLeft <= 0) {
          direction = 1;
        }

        lista.scrollBy({ left: width * direction, behavior: 'smooth' });
      };

      prevBtn.addEventListener('click', () => {
        const width = getTarjetaWidth();
        lista.scrollBy({ left: -width, behavior: 'smooth' });
      });

      nextBtn.addEventListener('click', () => {
        const width = getTarjetaWidth();
        lista.scrollBy({ left: width, behavior: 'smooth' });
      });

      // Auto scroll cada 4s
      let interval = setInterval(scrollAuto, 4000);

      lista.addEventListener('mouseenter', () => clearInterval(interval));
      lista.addEventListener('mouseleave', () => {
        interval = setInterval(scrollAuto, 4000);
      });
    });
  });

  // Logica para Filtrar categorias o nombres de los negocios
document.addEventListener('DOMContentLoaded', () => {
  const inputBusqueda = document.querySelector('#busqueda-input');
  const btnBuscar = document.querySelector('.boton-jecutar');

  const cartasCategorias = document.querySelectorAll('.tarjeta-servicio');

  if (!inputBusqueda || !btnBuscar) {
    console.error('No se encontró input o botón para buscar');
    return;
  }

  function filtrarCategorias() {
    const texto = inputBusqueda.value.toLowerCase().trim();

    cartasCategorias.forEach(carta => {
      const nombreElem = carta.querySelector('.nombre-servicio');
      const nombre = nombreElem ? nombreElem.textContent.toLowerCase() : '';
      carta.style.display = (!texto || nombre.includes(texto)) ? '' : 'none';
    });
  }

  inputBusqueda.addEventListener('input', filtrarCategorias);
  btnBuscar.addEventListener('click', e => {
    e.preventDefault();
    filtrarCategorias();
  });
});
