<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet"  href="{{ asset('Css/Views/viewStaff.css') }}">
  <title>Miembros del staff - MiNegocio</title>
</head>

<body>
  <div class="carousel">
    <button class="arrow arrow-left" onclick="moveLeft()">&#8249;</button>
    <div class="carousel-track">
      <div class="card" style="background-image: url('https://i.pinimg.com/236x/53/d0/5d/53d05d2146a58db4115d53c37e0c2444.jpg')">
        <h3>MAURICIO</h3>
      </div>
      <div class="card" style="background-image: url('https://i.pinimg.com/236x/ed/1f/3a/ed1f3a69f71d4a953f0567aa5957f2cd.jpg')">
        <h3>ALVARO</h3>
      </div>
      <div class="card" style="background-image: url('https://i.pinimg.com/236x/9f/a4/14/9fa4145bc9ea7c42415a5621f00afc0d.jpg')">
        <h3>SERGIO</h3>
      </div>
      <div class="card" style="background-image: url('https://img.freepik.com/foto-gratis/hombre-guapo-joven-posando-pared-ladrillo_176420-14644.jpg')">
        <h3>ALEAJANDRO</h3>
      </div>
      <div class="card" style="background-image: url('https://st4.depositphotos.com/3584053/22349/i/450/depositphotos_223490788-stock-photo-i-have-a-personal-barber.jpg')">
        <h3>ROBERT</h3>
      </div>
    </div>
    <button class="arrow arrow-right" onclick="moveRight()">&#8250;</button>
  </div>

  <script src="/Js/Staff/indexStaff.js"></script>
</body>
</html>