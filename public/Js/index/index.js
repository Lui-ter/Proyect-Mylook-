const isMobile = window.innerWidth <= 768;

const puntos = isMobile ? 7.00 : 9.00;
const distancia = isMobile ? 9.00 : 12.00;
const escala = isMobile ? 0.9 : 1.00;

const elem = document.querySelector("#bienvenidaIzquierda");

let efectoVanta = VANTA.NET({
  el: elem,
  backgroundColor: 0xa68160,
  mouseControls: true,
  touchControls: true,
  gyroControls: false,
  minHeight: elem.clientHeight,
  minWidth: elem.clientWidth,
  scale: escala,
  scaleMobile: escala,
  color: 0xfffff0,
  points: puntos,
  maxDistance: distancia
});

let resizeTimeout;
window.addEventListener("resize", () => {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(() => {
    if (efectoVanta) efectoVanta.destroy();

    const esMobile = window.innerWidth <= 768;
    const puntos = esMobile ? 7.00 : 9.00;
    const distancia = esMobile ? 9.00 : 12.00;
    const escala = esMobile ? 0.9 : 1.00;

    efectoVanta = VANTA.NET({
      el: elem,
      backgroundColor: 0xa68160,
      mouseControls: true,
      touchControls: true,
      gyroControls: false,
      minHeight: elem.clientHeight,
      minWidth: elem.clientWidth,
      scale: escala,
      scaleMobile: escala,
      color: 0xfffff0,
      points: puntos,
      maxDistance: distancia
    });
  }, 250);
});



  //  Lista de imágenes para el fondo dinámico
  const imagenes = [
    "https://img.freepik.com/foto-gratis/joven-peluqueria-corte-pelo_1303-26254.jpg?t=st=1740666578~exp=1740670178~hmac=3d77e5f8c1b60da910d3bfa147db3c59bae2d3600836ca296b793d25bb1fcda9&w=1060",
    "https://img.freepik.com/foto-gratis/maquilladora-preparando-modelo-sesion-fotos_23-2149305147.jpg?t=st=1740666362~exp=1740669962~hmac=d5f3694d2ffd6d3b8398efd3ae090069be25a82bd1bea8c448916bdd5d136e07&w=1060",
    "https://img.freepik.com/foto-gratis/hombre-guapo-barberia-afeitado-barba_1303-26258.jpg?t=st=1740666553~exp=1740670153~hmac=408dc6aa2b5c08858d7ae6da0b0942fe87eca648aa1f01abd079239a92ed68a7&w=1060",
  ];

  // Precarga las imágenes antes de usarlas para evitar retrasos
  const imagenesPrecargadas = imagenes.map(src => {
    const img = new Image();
    img.src = src;
    return img;
  });

  let index = 0;
  const contenedor = document.querySelector(".bienvenida-derecha");

  function cambiarImagen() {
    contenedor.style.backgroundImage = `url(${imagenesPrecargadas[index].src})`; // Cambia la imagen de fondo
    index = (index + 1) % imagenes.length; // Cicla entre las imágenes disponibles
  }

  // Cambiar imagen cada 5 segundos
  setInterval(cambiarImagen, 5000);

  cambiarImagen(); // Llamado inicial para mostrar la primera imagen
