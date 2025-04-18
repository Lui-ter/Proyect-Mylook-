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

            @section('link-index', '/usuarios/index')
            @section('link-configurar-perfil', '/admin/configurar-perfil')
            @section('link-historial', '/admin/historial')
            @section('link-salir', '/usuarios/logout')
    
            @include('components.header')
    

        <main>
            {{-- seccion dedicada a el carrusel --}}
            <section class="contenedor-carrusel">
                {{-- contenedor dedicado a el contenido de carrusel --}}
                <div class="carrusel">
                    @if (!empty($establecimientosAleatorios))
                        @foreach ($establecimientosAleatorios as $index => $establecimiento)
                            @php
                                $negocio = $establecimiento['negocio'] ?? null;
                                $imgPortada =
                                    $negocio && $negocio['img_portada']
                                        ? 'data:image/jpeg;base64,' . base64_encode($negocio['img_portada'])
                                        : 'https://via.placeholder.com/800x400?text=Portada';
                                $imgPerfil =
                                    $negocio && $negocio['img_perfil']
                                        ? 'data:image/jpeg;base64,' . base64_encode($negocio['img_perfil'])
                                        : 'https://via.placeholder.com/100?text=Perfil';
                            @endphp

                            <article class="elemento-carrusel {{ $index === 0 ? 'activo' : '' }}"
                                style="background-image: url('{{ $imgPortada }}');">
                                <span class="etiquet-categoria">ESTABLECIMIENTO</span>
                                <div class="contenido-elemento">
                                    <div class="informacion-establecimiento">
                                        <h2 class="titulo-establecimiento">
                                            {{ $establecimiento['nombre_establc'] }}
                                        </h2>
                                        <p class="descripcion-establecimiento">
                                            {{ $establecimiento['desc_establc'] }}
                                        </p>
                                        <form action="{{ url('/usuarios/verMas') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_establecimiento"
                                                value="{{ $establecimiento['id_establc'] }}">
                                            <button class="boton-agendar">
                                                <div class="icono">
                                                    <img width="100" height="100"
                                                        src="https://img.icons8.com/ios-filled/100/FFFFFF/event-accepted-tentatively.png"
                                                        alt="Agendar" />
                                                </div>
                                                <span>AGENDAR</span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="imagen-perfil">
                                        <img src="{{ $imgPerfil }}" alt="Logo negocio" />
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p style="text-align: center;">No hay establecimientos disponibles para mostrar.</p>
                    @endif
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

                    @foreach ($establecimientosRecomendados as $establecimiento)
                        <article class="carta-establecimiento">
                            {{-- Imagen de perfil del negocio --}}
                            @php
                                $imgPerfil =
                                    $establecimiento->negocio && $establecimiento->negocio->img_perfil
                                        ? 'data:image/jpeg;base64,' .
                                            base64_encode($establecimiento->negocio->img_perfil)
                                        : asset('images/default-perfil.jpg');
                            @endphp
                            <img src="{{ $imgPerfil }}" alt="Perfil del negocio" class="img-perfil" />

                            <div class="contenedor-informacion">
                                <div class="informacion">
                                    <div class="nombre-descripcion">
                                        <h2>{{ $establecimiento->nombre_establc }}</h2>
                                        <p>{{ $establecimiento->desc_establc }}</p>
                                    </div>

                                    <div class="servicios">
                                        <h3>SERVICIOS</h3>
                                        <ul>
                                            <li>Servicio 1</li>
                                            <li>Servicio 2</li>
                                            <li>Servicio 3</li>
                                        </ul>
                                        <div class="puntuacion">★★★★★</div>
                                    </div>
                                </div>

                                <div class="contenedor-boton-agendar">
                                    <form action="{{ url('/usuarios/agendar') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="id_establc"
                                            value="{{ $establecimiento->id_establc }}">
                                        <button class="boton-agendar">AGENDAR</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </section>




            <!-- Sección dedicada a los mejores establecimientos de la semana -->
            <section class="establecimientos-destacados" id="top">

                <h3 class="titulo-seccion">ESTABLECIMIENTOS DESTACADOS</h3>

                <div class="contenedor-imagenes-destacado">
                    <!-- Contenedor que agrupa las tarjetas de los establecimientos destacados -->
                    @foreach ($mejoresEstablecimientos as $index => $establecimiento)
                        @if ($index < 3)
                            @php
                                $negocio = $establecimiento->negocio;
                                $imgPerfil =
                                    $negocio && $negocio->img_perfil
                                        ? 'data:image/jpeg;base64,' . base64_encode($negocio->img_perfil)
                                        : 'https://via.placeholder.com/300x200?text=Sin+imagen';
                            @endphp

                            <article class="card-destacado">
                                <img src="{{ $imgPerfil }}" alt="Top {{ $index + 1 }}"
                                    class="destacado-imagen" />
                                <div class="nombre-posicion">
                                    <h4>{{ $establecimiento->nombre_establc }}</h4>
                                    <img src="https://img.icons8.com/wired/64/FFFFFF/{{ $index + 1 }}-circle.png"
                                        alt="Puesto número {{ $index + 1 }}" />
                                </div>
                            </article>
                        @endif
                    @endforeach


                </div>

            </section>
        </main>

        {{-- importamos el componente del footer --}}
        <x-footer />

        <script src="/Js/index/indexUsuario.js"></script>
    </body>

    </html>
