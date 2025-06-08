<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Establecimiento</title>
    <link rel="stylesheet" href="{{ asset('Css/perfilEstablecimiento/perfil.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">


</head>

<body>
    @section('link-index', '/usuarios/index')
    @section('link-configurar-perfil', '/admin/configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/usuarios/logout')

    @include('components.header')


    <main>

        <div class="portada" style="background-image: url({{ $negocio['img_portada'] }});">
            <div class="izquierda">
                <figure>
                    <img src="{{ $negocio['img_perfil'] }}" alt="Portada">
                </figure>
            </div>
            <div class="derecha">
                <div class="contenido-derecha">
                    <div class="nombre-direccion">
                        <h2 class="nombre">{{ $establecimiento['nombre_establc'] }}</h2>
                        <h3 class="direccion">{{ $establecimiento['ubicacion'] }} <i
                                class="fa-solid fa-location-dot"></i>
                        </h3>
                    </div>
                    <div class="descripcion-boton">
                        <p class="descripcion">{{ $establecimiento['desc_establc'] }}</p>
                        <form action="{{ url('/usuarios/agendar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_establecimiento"
                                value="{{ $establecimiento['id_establc'] }}">
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
                </div>
            </div>
        </div>


        <section class="carruseles">
            <section>
                <h2 class="titulo">NUESTRAS CATEGORIAS</h2>
                <div class="carrusel-container">
                    <button id="btn-prev-servicios" class="carrusel-btn"><i class="fa-solid fa-caret-left"></i></button>
                    <div class="lista" id="lista-servicios">
                        @foreach ($categorias as $categoria)
                            <div class="tarjeta tarjeta-servicio">
                                <img src="{{ $categoria['imagen'] }}" alt="Servicio 1" class="img-servicio">
                                <div class="contenido-tarjeta">
                                    <h3 class="nombre-servicio">{{ $categoria['nom_categoria'] }}</h3>
                                    <p class="descripcion">{{ $categoria['desc_categoria'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="btn-next-servicios" class="carrusel-btn"><i
                            class="fa-solid fa-caret-right"></i></button>
                </div>
            </section>

            <section>
                <h2 class="titulo">NUESTRO EQUIPO</h2>
                <div class="carrusel-container">
                    <button id="btn-prev-staff" class="carrusel-btn"> <i class="fa-solid fa-caret-left"></i>
                    </button>
                    <div class="lista" id="lista-staff">
                        @foreach ($staffs as $staff)
                            <div class="tarjeta carta-staff">
                                <figure class="carta-imagen" id="foto-staff">
                                    <img src="{{ $staff->usuario['img_usuario'] }}" alt="">
                                    <p class="rol">{{ $staff->rol['nombre_rol'] }}</p>
                                </figure>
                                <h3>{{ $staff->usuario['nombre'] }}</h3>
                            </div>
                        @endforeach
                    </div>
                    <button id="btn-next-staff" class="carrusel-btn"> <i class="fa-solid fa-caret-right"></i>
                    </button>
                </div>
            </section>

            <section>

                <h2 class="titulo">NUESTROS PRODUCTOS</h2>
                <div class="carrusel-container">
                    <button id="btn-prev-productos" class="carrusel-btn"><i class="fa-solid fa-caret-left"></i></button>
                    <div class="lista" id="lista-productos">
                        @foreach ($productos as $producto)
                            <div class="tarjeta producto">
                                <figure class="carta-imagen">
                                    <img src="{{ $producto['img_prod'] }}" alt="">
                                    <p class="stock"><i class="fa-solid fa-boxes-stacked"></i>
                                        {{ $producto['stock'] }}
                                    </p>
                                    <p class="precio"><span>{{ $producto['valor_prod'] }}</span></p>
                                </figure>
                                <div class="contenido-tarjeta">
                                    <h3>{{ $producto['nombre_prod'] }}</h3>
                                    <p>{{ $producto['desc_prod'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="btn-next-productos" class="carrusel-btn"><i
                            class="fa-solid fa-caret-right"></i></button>
                </div>
            </section>
        </section>

        <section class="comentarios">
            <h2 class="titulo">COMENTARIOS</h2>
            @foreach ($valoraciones as $valoracion)
                <div class="tarjeta-testimonio">
                    <div class="imagen-perfil">
                        <img src="{{ $valoracion->cita->usuario->imagen_base64 ?? 'https://cdn-user-icons.flaticon.com/146157/146157749/1749352501611.svg?token=exp=1749353412~hmac=084ebaafcb75a5566cbfba6de4b5fd2f' }}"
                            alt="Imagen de {{ $valoracion->cita->usuario->nombre }}">
                    </div>
                    <div class="contenido-testimonio">
                        <h2 class="nombre">
                            {{ strtoupper($valoracion->cita->usuario->nombre . ' ' . $valoracion->cita->usuario->apellido) }}
                        </h2>
                        <p class="texto-resena">{{ $valoracion->comentario }}</p>
                        <div class="calificacion">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $valoracion->calificacion)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach

        </section>
    </main>
    <script src="/Js/perfilEstablecimiento/pefil.js"></script>

</body>

</html>
