<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Css/Index/indexBienvenida.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/trianglify@4.1.1/dist/trianglify.bundle.min.js"></script>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <title>MyLook</title>
</head>

<body>
    <main>
        <section class="seccion-bienvenida">
            <!-- Sección de bienvenida que contiene dos artículos -->

            <article class="bienvenida-izquierda" id="bienvenidaIzquierda" data-aos="fade-right" data-aos-duration="1000">
                <!-- Contenedor izquierdo con el logo, el mensaje de bienvenida y los botones -->

                <div class="logo">
                    <!-- Icono de bombilla representando la marca -->
                    <i class="fa-solid fa-lightbulb bombilla"></i>
                </div>

                <div class="texto-bienvenida">
                    <!-- Mensaje de bienvenida y llamada a la acción -->
                    <h3>Bienvenido a</h3>
                    <h1>MYLOOK</h1>
                    <p>Resplandece con estilo.
                        Haz tu cita hoy mismo y déjate envolver por la belleza
                    </p>
                    <!-- Botón para iniciar sesión -->
                    <a href="{{ route('login') }}">
                        <button>¡Iniciar ahora!</button>
                    </a>
                </div>

                <div class="redes-sociales">

                    <!-- Sección de iconos de redes sociales -->
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/share/1DpJ6TZU7C/">
                        <i class="fab fa-facebook-f iconFacebook"></i>
                    </a>

                    <!-- Instagram -->
                    <a
                        href="https://www.instagram.com/mylook7225?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <!-- Correo electronico -->
                    <a href="mailto:mylook7225@gmail.com">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>

            </article>

            <article class="bienvenida-derecha" >
                <!-- Contenedor derecho donde se mostrarán las imágenes de fondo dinámicas -->
            </article>

        </section>

        <section class="servicios">
            <h2 data-aos-delay="100">¿Qué encuentras en MYLOOK?</h2>
            <p data-aos-delay="200">Aquí encontrarás diferentes tipos de establecimientos
                para brindarte una gran cantidad de servicios.
            </p>

            <div class="contenedor-seccion-servicios">
                <!-- Contenedor de la sección de servicios -->

                <h3 class="subtitulo">TIPOS DE ESTABLECIMIENTO</h3>

                <div class="contenedor-servicios-imgs">
                    <!-- Contenedor que agrupa las tarjetas de servicios -->

                    <!-- Tarjeta de servicio: Depilación -->
                    <div class="carta-servicio"  data-aos="fade-up" data-aos-delay="200">
                        <img src="https://img.freepik.com/foto-gratis/piernas-mujer-hermosa-piel-blanca-suave-aislado-blanco_231208-4863.jpg?t=st=1740667189~exp=1740670789~hmac=5f64d69589b911da2b40cfdb9cca7250ab67e70d3d567a25af54e19bc34d73a0&w=1060"
                            alt="Depilación">
                        <h4>Depilación</h4>
                    </div>

                    <!-- Tarjeta de servicio: Uñas -->
                    <div class="carta-servicio"  data-aos="fade-up" data-aos-delay="200">
                        <img src="https://img.freepik.com/foto-gratis/mujer-mostrando-sus-hermosas-unas_23-2148697087.jpg?t=st=1740667114~exp=1740670714~hmac=83ce4f83c8103ba5f33985642944590cb01186337833a99ab6a5857346e75b35&w=900"
                            alt="Uñas">
                        <h4>Uñas</h4>
                    </div>

                    <!-- Tarjeta de servicio: Barbería -->
                    <div class="carta-servicio"  data-aos="fade-up" data-aos-delay="200">
                        <img src="https://img.freepik.com/foto-gratis/cliente-haciendo-corte-pelo-salon-peluqueria_1303-20772.jpg?t=st=1740667066~exp=1740670666~hmac=2c90c4670a454c46b3441b49e01e9cd0c7a0c21d179f28ba500decd83644f388&w=1060"
                            alt="Barbería">
                        <h4>Barbería</h4>
                    </div>

                    <!-- Tarjeta de servicio: Maquillaje -->
                    <div class="carta-servicio"  data-aos="fade-up" data-aos-delay="200">
                        <img src="https://img.freepik.com/foto-gratis/mujer-maquillarse-profesional_23-2149084920.jpg?t=st=1740667238~exp=1740670838~hmac=863bd165daad128f4f234fff8919cd9e29c66bfb32b617aa6a86a25c86cddd22&w=1060"
                            alt="Maquillaje">
                        <h4>Maquillaje</h4>
                    </div>

                </div>
            </div>

        </section>




        <section class="establecimientos-recomendados">
            <!-- Sección de establecimientos recomendados de la semana -->

            <h3 class="subtitulo">ESTABLECIMIENTOS DESTACADOS</h3>

            <div class="contenedor-imagenes-destacado">
                <!-- Contenedor que agrupa las tarjetas de los establecimientos destacados -->

             @foreach ($mejoresEstablecimientos as $establecimiento)
    @if ($loop->index < 3)
        @php
            $negocio = $establecimiento->negocio;
            $imgPerfil = $negocio && $negocio->img_perfil
                ? 'data:image/jpeg;base64,' . base64_encode($negocio->img_perfil)
                : 'https://via.placeholder.com/300x200?text=Sin+imagen';

            $clasePosicion = match ($loop->index) {
                0 => 'primer-puesto',
                1 => 'segundo-puesto',
                2 => 'tercer-puesto',
                default => '',
            };

            $aosAnimacion = match ($loop->index) {
                0 => 'zoom-in-up',
                1 => 'fade-up-left',
                2 => 'fade-up-right',
            };

            $aosDelay = 100 * ($loop->index + 1);
        @endphp

        <div class="carta-destacado {{ $clasePosicion }}"
             data-aos="{{ $aosAnimacion }}"
             data-aos-delay="{{ $aosDelay }}"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-anchor-placement="top-bottom">
            <img src="{{ $imgPerfil }}" alt="Top {{ $loop->index + 1 }}" class="imagen-destacada">
            <div class="nombre-posicion">
                <h4>{{ $establecimiento->nombre_establc }}</h4>
                <img src="https://img.icons8.com/wired/64/FFFFFF/{{ $loop->index + 1 }}-circle.png"
                    alt="Puesto número {{ $loop->index + 1 }}" />
            </div>
        </div>
    @endif
@endforeach


            </div>
        </section>


    </main>
    {{-- importamos el componente del footer --}}
    <x-footer />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
    <script src="{{ asset('Js/index/index.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
