<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Css/Index/indexUsuario.css') }}">
    <title>Usuario bienvenida</title>
</head>

<body>
    {{-- importamos el componente header --}}
    <x-header tipo="usuario" />

    <main>
        {{-- seccion dedicada a el carrusel --}}
        <section class="contenedor-carrusel">
        {{-- contenedor dedicado a el contenido de carrusel --}}
            <div class="carrusel">
                {{-- elementos de el carrusel --}}
                <article class="elemento-carrusel activo"
                    style="background-image: url('https://img.freepik.com/foto-gratis/sillas-vintage-peluqueria_155003-10150.jpg?t=st=1741447697~exp=1741451297~hmac=01d30b991787161b9275570c9079ef23f665daf1e5feb8ccd7e2139910268521&w=1060');">
                    <span class="etiquet-categoria">BARBERÍA</span>
                    <div class="contenido-elemento">
                        <div class="informacion-establecimiento">
                            <h2 class="titulo-establecimiento">
                                {{ $mejoresEstablecimientos['0']['nombre_establc'] }}
                            </h2>
                            <p class="descripcion-establecimiento">
                                {{ $mejoresEstablecimientos['0']['desc_establc'] }}
                            </p>
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar">
                                    <div class="icono">
                                        <img width="100" height="100"
                                            src="https://img.icons8.com/ios-filled/100/FFFFFF/event-accepted-tentatively.png"
                                            alt="event-accepted-tentatively" />
                                    </div>
                                    <span>AGENDAR</span>
                                </button>
                            </form>
                        </div>
                        <div class="imagen-perfil">
                            <img src="https://d1yjjnpx0p53s8.cloudfront.net/logotipo-imperio-barberia-vector1.png"
                                alt="Logo Imperio Barber" />
                        </div>
                    </div>
                </article>

                <article class="elemento-carrusel"
                    style="
              background-image: url('https://img.freepik.com/foto-gratis/dormitorio-lujo-iluminado-lampara-electrica-moderna-generada-ia_188544-28185.jpg?t=st=1741447790~exp=1741451390~hmac=2eb7e310de63b49725389716fd4417e4020247b2ccd332e2e81854e805b3b360&w=1380');
            ">
                    <span class="etiquet-categoria">SPA</span>
                    <div class="contenido-elemento">
                        <div class="informacion-establecimiento">
                            <h2 class="titulo-establecimiento">
                                {{ $mejoresEstablecimientos['0']['nombre_establc'] }}
                            </h2>
                            <p class="descripcion-establecimiento">
                                {{ $mejoresEstablecimientos['0']['desc_establc'] }}
                            </p>
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar">
                                    <div class="icono">
                                        <img width="100" height="100"
                                            src="https://img.icons8.com/ios-filled/100/FFFFFF/event-accepted-tentatively.png"
                                            alt="event-accepted-tentatively" />
                                    </div>
                                    <span>AGENDAR</span>
                                </button>
                            </form>
                        </div>
                        <div class="imagen-perfil">
                            <img src="https://images-platform.99static.com//LvpAAksYSeeAr56uOhIFeQi3aMk=/306x0:1095x789/fit-in/590x590/projects-files/18/1828/182859/eb7ab1b9-dd87-fa5a-50f0-7258213d7335.png"
                                alt="Logo Imperio Barber" />
                        </div>
                    </div>
                </article>

                <article class="elemento-carrusel"
                    style="
              background: url('https://img.freepik.com/foto-gratis/productos-maquillaje-espacio-copia_23-2148598505.jpg?t=st=1741448694~exp=1741452294~hmac=ab30b85005bc1184b3c21535d49f7c2d3e790ea54f0940bc1f097bb32d3ea733&w=1380');
            ">
                    <span class="etiquet-categoria">BARBERÍA</span>
                    <div class="contenido-elemento">
                        <div class="informacion-establecimiento">
                            <h2 class="titulo-establecimiento">
                                {{ $mejoresEstablecimientos['0']['nombre_establc'] }}
                            </h2>
                            <p class="descripcion-establecimiento">
                                {{ $mejoresEstablecimientos['0']['desc_establc'] }}
                            </p>
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar">
                                    <div class="icono">
                                        <img width="100" height="100"
                                            src="https://img.icons8.com/ios-filled/100/FFFFFF/event-accepted-tentatively.png"
                                            alt="event-accepted-tentatively" />
                                    </div>
                                    <span>AGENDAR</span>
                                </button>
                            </form>
                        </div>
                        <div class="imagen-perfil">
                            <img src="https://cdn.create.vista.com/downloads/dcdd47d4-f1f8-4dc0-83c8-1b3ff3a23a46_1024.jpeg"
                                alt="Logo Imperio Barber" />
                        </div>
                    </div>
                </article>
            </div>
            {{-- boton de la izquierda que para ir a el elemento anterior --}}
            <button class="boton-navegacion boton-anterior">
                <i class="fa-solid fa-caret-left"></i>
            </button>
            {{-- boton de la derechaque para ir a el elemento siguiente --}}
            <button class="boton-navegacion boton-siguiente">
                <i class="fa-solid fa-caret-right"></i>
            </button>
        </section>

        {{-- seccion dedicada a los establecimientos recomendados --}}
        <section class="establecimientos-recomendados">
            <h2 class="titulo-seccion">ESTABLECIMIENTOS RECOMENDADOS</h2>
            <div class="contenedor-establecimientos">
                {{-- elementos de cada establecimiento --}}
                <article class="carta-establecimiento">
                    <img src="https://cdn.create.vista.com/downloads/dcdd47d4-f1f8-4dc0-83c8-1b3ff3a23a46_1024.jpeg"
                        alt="Imagen del establecimiento" />

                    <div class="contenedor-informacion">
                        <div class="informacion">
                            <div class="nombre-descripcion">
                                <h2>{{ $mejoresEstablecimientos['0']['nombre_establc'] }}</h2>
                                <p>{{ $mejoresEstablecimientos['0']['desc_establc'] }}</p>
                            </div>
                            <div class="servicios">
                                <h3>SERVICIOS</h3>
                                <ul>
                                    <li>Sombras</li>
                                    <li>Makeups</li>
                                    <li>SkinCare</li>
                                    <li>Peinados</li>
                                </ul>
                                <div class="puntuacion">★★★★★</div>
                            </div>
                        </div>

                        <div class="contenedor-boton-agendar">
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar"
                                    value="{{ $mejoresEstablecimientos['0']['id_establc'] }}">
                                    AGENDAR
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="carta-establecimiento">
                    <img src="https://d1yjjnpx0p53s8.cloudfront.net/logotipo-imperio-barberia-vector1.png"
                        alt="Imagen del establecimiento" />

                    <div class="contenedor-informacion">
                        <div class="informacion">
                            <div class="nombre-descripcion">
                                <h2>{{ $mejoresEstablecimientos['1']['nombre_establc'] }}</h2>
                                <p>{{ $mejoresEstablecimientos['1']['desc_establc'] }}</p>
                            </div>
                            <div class="servicios">
                                <h3>SERVICIOS</h3>
                                <ul>
                                    <li>Degradados</li>
                                    <li>Dibujos</li>
                                    <li>Barba</li>
                                    <li>Cejas</li>
                                </ul>
                                <div class="puntuacion">★★★★★</div>
                            </div>
                        </div>

                        <div class="contenedor-boton-agendar">
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar"
                                    value="{{ $mejoresEstablecimientos['1']['id_establc'] }}">
                                    AGENDAR
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="carta-establecimiento">
                    <img src="https://images-platform.99static.com//LvpAAksYSeeAr56uOhIFeQi3aMk=/306x0:1095x789/fit-in/590x590/projects-files/18/1828/182859/eb7ab1b9-dd87-fa5a-50f0-7258213d7335.png"
                        alt="Imagen del establecimiento" />

                    <div class="contenedor-informacion">
                        <div class="informacion">
                            <div class="nombre-descripcion">
                                <h2>{{ $mejoresEstablecimientos['0']['nombre_establc'] }}</h2>
                                <p>{{ $mejoresEstablecimientos['0']['desc_establc'] }}</p>
                            </div>
                            <div class="servicios">
                                <div class="especialidades">
                                    <h3>SERVICIOS</h3>
                                    <ul>
                                        <li>Masajes</li>
                                        <li>tratamientos</li>
                                        <li>lavados</li>
                                    </ul>
                                </div>
                                <div class="puntuacion">★★★★★</div>
                            </div>
                        </div>

                        <div class="contenedor-boton-agendar">
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar"
                                    value="{{ $mejoresEstablecimientos['0']['id_establc'] }}">
                                    AGENDAR
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="carta-establecimiento">
                    <img src="https://cdn.create.vista.com/downloads/dcdd47d4-f1f8-4dc0-83c8-1b3ff3a23a46_1024.jpeg"
                        alt="Imagen del establecimiento" />

                    <div class="contenedor-informacion">
                        <div class="informacion">
                            <div class="nombre-descripcion">
                                <h2>{{ $mejoresEstablecimientos['0']['nombre_establc'] }}</h2>
                                <p>{{ $mejoresEstablecimientos['0']['desc_establc'] }}</p>
                            </div>
                            <div class="servicios">
                                <h3>SERVICIOS</h3>
                                <ul>
                                    <li>Sombras</li>
                                    <li>Makeups</li>
                                    <li>SkinCare</li>
                                    <li>Peinados</li>
                                </ul>
                                <div class="puntuacion">★★★★★</div>
                            </div>
                        </div>

                        <div class="contenedor-boton-agendar">
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar"
                                    value="{{ $mejoresEstablecimientos['0']['id_establc'] }}">
                                    AGENDAR
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="carta-establecimiento">
                    <img src="https://d1yjjnpx0p53s8.cloudfront.net/logotipo-imperio-barberia-vector1.png"
                        alt="Imagen del establecimiento" />

                    <div class="contenedor-informacion">
                        <div class="informacion">
                            <div class="nombre-descripcion">
                                <h2>{{ $mejoresEstablecimientos['1']['nombre_establc'] }}</h2>
                                <p>{{ $mejoresEstablecimientos['1']['desc_establc'] }}</p>
                            </div>
                            <div class="servicios">
                                <h3>SERVICIOS</h3>
                                <ul>
                                    <li>Degradados</li>
                                    <li>Dibujos</li>
                                    <li>Barba</li>
                                    <li>Cejas</li>
                                </ul>
                                <div class="puntuacion">★★★★★</div>
                            </div>
                        </div>

                        <div class="contenedor-boton-agendar">
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar"
                                    value="{{ $mejoresEstablecimientos['1']['id_establc'] }}">
                                    AGENDAR
                                </button>
                            </form>
                        </div>
                    </div>
                </article>

                <article class="carta-establecimiento">
                    <img src="https://images-platform.99static.com//LvpAAksYSeeAr56uOhIFeQi3aMk=/306x0:1095x789/fit-in/590x590/projects-files/18/1828/182859/eb7ab1b9-dd87-fa5a-50f0-7258213d7335.png"
                        alt="Imagen del establecimiento" />

                    <div class="contenedor-informacion">
                        <div class="informacion">
                            <div class="nombre-descripcion">
                                <h2>{{ $mejoresEstablecimientos['0']['nombre_establc'] }}</h2>
                                <p>{{ $mejoresEstablecimientos['0']['desc_establc'] }}</p>
                            </div>
                            <div class="servicios">
                                <div class="especialidades">
                                    <h3>SERVICIOS</h3>
                                    <ul>
                                        <li>Masajes</li>
                                        <li>tratamientos</li>
                                        <li>lavados</li>
                                    </ul>
                                </div>
                                <div class="puntuacion">★★★★★</div>
                            </div>
                        </div>

                        <div class="contenedor-boton-agendar">
                            <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                @csrf
                                <button class="boton-agendar"
                                    value="{{ $mejoresEstablecimientos['0']['id_establc'] }}">
                                    AGENDAR
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            </div>
        </section>


        <!-- Sección dedicada a los mejores establecimientos de la semana -->
        <section class="establecimientos-destacados" id="top">

            <h3 class="titulo-seccion">ESTABLECIMIENTOS DESTACADOS</h3>

            <div class="contenedor-imagenes-destacado">
                <!-- Contenedor que agrupa las tarjetas de los establecimientos destacados -->

                <!-- Tarjeta del establecimiento "top 2" -->
                <div class="card-destacado">
                    <img src="https://vanidosasalamoda.cl/cdn/shop/files/Diseno_sin_titulo-4.png?height=628&pad_color=ffffff&v=1679602912&width=1200"
                        alt="top 2" class="destacado-imagen" />
                    <div class="nombre-posicion">
                        <h4>{{ $mejoresEstablecimientos['1']['nombre_establc'] }}</h4>
                        <img src="https://img.icons8.com/wired/64/FFFFFF/2-circle.png" alt="Puesto número 2" />
                    </div>
                </div>

                <!-- Tarjeta del establecimiento top 1-->
                <div class="card-destacado">
                    <img src="https://d1yjjnpx0p53s8.cloudfront.net/logotipo-imperio-barberia-vector1.png"
                        alt="top 1" class="destacado-imagen" />
                    <div class="nombre-posicion">
                        <h4>{{ $mejoresEstablecimientos['0']['nombre_establc'] }}</h4>
                        <img src="https://img.icons8.com/wired/64/FFFFFF/1-circle.png" alt="Puesto número 1" />
                    </div>
                </div>

                <!-- Tarjeta del establecimiento top 3 -->
                <div class="card-destacado">
                    <img src="https://img.freepik.com/vector-premium/plantilla-vectorial-diseno-logotipo-marca-real-lujo_441059-968.jpg?semt=ais_hybrid"
                        alt="top 3" class="destacado-imagen" />
                    <div class="nombre-posicion">
                        <h4>{{ $mejoresEstablecimientos['0']['nombre_establc'] }}</h4>
                        <img src="https://img.icons8.com/wired/64/FFFFFF/3-circle--v1.png" alt="Puesto número 3" />
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- importamos el componente del footer --}}
    <x-footer />

    <script src="/Js/index/indexUsuario.js"></script>
</body>

</html>
