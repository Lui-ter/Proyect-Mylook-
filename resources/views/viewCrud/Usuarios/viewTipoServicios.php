<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet"  href="{{ asset('Css/Views/viewCrudUsuarios.css') }}">
  <title>Tipos de servicio - MYLOOK</title>
</head>

<body>
  <div class="carousel">
    <button class="arrow arrow-left" onclick="moveLeft()">&#8249;</button>
    <div class="carousel-track">
      <div class="card" style="background-image: url('https://pelonatural.com.ar/wp-content/uploads/cual-es-el-corte-de-pelo-numero-uno-para-hombres.webp')">
        <h3>CORTES</h3>
      </div>
      <div class="card" style="background-image: url('https://www.alpel.es/i/u/recortar-la-barba-con-tijeras.jpg')">
        <h3>BARBAS</h3>
      </div>
      <div class="card" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdtWlOvi1IwQeU0MwvTzYjkfA6ygVd1IOC0g&s')">
        <h3>MANICURE</h3>
      </div>
      <div class="card" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAdu_-Q6vDxtAZY3uB9w3_2HYFLlJwjrhE_IwhZfr3HlETctydftaMdo9qXyyoeg7CnKY&usqp=CAU')">
        <h3>TINTOS</h3>
      </div>
      <div class="card" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToASA_HYtVijseONYcO9f6i4bZyGgxeYISOQ&s')">
        <h3>TRATAMIENTOS</h3>
      </div>
      <div class="card" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIz3liVh4yVcJznTgWMFHdoeJU5IlzxEk8mo6qDA2iXo2fOd8_Rrn86V4CH_yjzgF0tsw&usqp=CAU')">
        <h3>MASAJES</h3>
      </div>
      <div class="card" style="background-image: url('https://tienda.arroyodelaluz.cl/cdn/shop/products/depilacion.jpg?v=1662350084')">
        <h3>DEPILACION</h3>
      </div>
      <div class="card" style="background-image: url('https://essentialloft.com/wp-content/uploads/2020/10/tratamiento-maquillaje-novia-3-350x435.jpg')">
        <h3>MAQUILLAJE</h3>
      </div>
      <div class="card" style="background-image: url('https://hips.hearstapps.com/es.h-cdn.co/coses/images/belleza/maquillaje/5-tratamientos-de-larga-duracion-para-presumir-de-pestanas/127912-1-esl-ES/5-tratamientos-de-larga-duracion-para-presumir-de-pestanas.jpg?crop=0.6904296875xw:1xh;center,top&resize=1200:*')">
        <h3>PESTAÑAS</h3>
      </div>
    </div>
    <button class="arrow arrow-right" onclick="moveRight()">&#8250;</button>
  </div>

  <script src="/Js/Usuario/indexUsuario.js"></script>
</body>
</html>