<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Establecimiento</title>
    <link rel="stylesheet"  href="{{ asset('Css/perfilEstablecimiento/perfil.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
    @section('link-index', '/usuarios/index')
    @section('link-configurar-perfil', '/admin/configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/usuarios/logout')

    @include('components.header')


    <main>

        <div class="portada"
            style="background-image: url({{ $negocio['img_portada'] }});">
            <div class="izquierda">
                <figure>
                    <img src="{{$negocio['img_perfil']}}" alt="Portada">
                </figure>
            </div>
            <div class="derecha">
                <div class="contenido-derecha">
                    <div class="nombre-direccion">
                        <h2 class="nombre">{{ $establecimiento['nombre_establc'] }}</h2>
                        <h3 class="direccion">{{ $establecimiento['ubicacion'] }} <i class="fa-solid fa-location-dot"></i>
                        </h3>
                    </div>
                    <div class="descripcion-boton">
                        <p class="descripcion">{{ $establecimiento['desc_establc'] }}</p>
                        <form action="{{ url('/usuarios/agendar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_establecimiento" value="{{ $establecimiento['id_establc'] }}">
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
                        @foreach ($categorias as $categoria )
                               
                        <div class="tarjeta tarjeta-servicio">
                            <img src="{{ $categoria['imagen'] }}"
                                alt="Servicio 1" class="img-servicio">
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
                    @foreach ($staffs as $staff )
                        <div class="tarjeta carta-staff">
                            <figure class="carta-imagen" id="foto-staff">
                                <img src="{{ $staff->usuario['img_usuario']}}"
                                    alt="">
                                <p class="rol">{{$staff->rol['nombre_rol']}}</p>
                            </figure>
                            <h3>{{ $staff->usuario['nombre']}}</h3>
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
                        @foreach($productos as $producto)
                        <div class="tarjeta producto">
                            <figure class="carta-imagen">
                                <img src="{{$producto['img_prod']}}"
                                    alt="">
                                <p class="stock"><i class="fa-solid fa-boxes-stacked"></i> {{ $producto['stock']}}
                                </p>
                                <p class="precio"><span>{{ $producto['valor_prod'] }}</span></p>
                            </figure>
                            <div class="contenido-tarjeta">
                                <h3>{{ $producto['nombre_prod']}}</h3>
                                <p>{{ $producto['desc_prod'] }}
                                </p>
                                <button>SOLICITAR</button>
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
            <div class="tarjeta-testimonio">
                <div class="imagen-perfil">
                    <img src="https://image.ondacero.es/clipping/cmsimages02/2017/03/09/959B78F7-9584-4170-8486-01647BB6B845/98.jpg?crop=640,360,x0,y0&width=1900&height=1069&optimize=high&format=webply"
                        alt="Alejandro Sarasty">
                </div>
                <div class="contenido-testimonio">
                    <h2 class="nombre">RAUL GONZALES</h2>
                    <p class="texto-resena">El establecimiento es súper limpio y moderno. El ambiente es relajante y el
                        personal muy profesional. ¡Siempre salgo feliz y renovado!</p>
                    <div class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <div class="tarjeta-testimonio">
                <div class="imagen-perfil">
                    <img src="https://elcomercio.pe/resizer/v2/473EX5Z3BVEIJOZOU2JCAPMNRU.jpg?auth=eef104e99ffd527d30d9015d2b24d71fe41b94e5116407017b5a431d0490321b&width=1200&height=810&quality=90&smart=true"
                        alt="Laura Gómez">
                </div>
                <div class="contenido-testimonio">
                    <h2 class="nombre">LAURA GÓMEZ</h2>
                    <p class="texto-resena">Increíble servicio. Siempre encuentro disponibilidad y el proceso es súper
                        rápido y sencillo.</p>
                    <div class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <div class="imagen-perfil">
                    <img src="https://www.biografia.de/wp-content/uploads/La-Cobra.webp" alt="Carlos Méndez">
                </div>
                <div class="contenido-testimonio">
                    <h2 class="nombre">CARLOS MÉNDEZ</h2>
                    <p class="texto-resena">Gracias a esta app, agendar mis servicios favoritos es cuestión de segundos.
                        ¡Muy recomendada!</p>
                    <div class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>



        </section>
    </main>
    <script src="/Js/perfilEstablecimiento/pefil.js"></script>

</body>

</html>
