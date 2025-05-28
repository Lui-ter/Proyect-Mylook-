<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/insercionValoracion.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

    <title>Registrar Valoración | MyLook</title>
</head>

<body>
    @section('link-index', '/usuarios/index')
    @section('link-configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/usuarios/logout')

    @include('components.header', ['imgusuario' => $imgusuario, 'notificaciones' => $notificaciones])

    <main>
        <div class="titulos">
            <h4 class="nombre-vista">Valoración de la Cita</h4>
            <p class="descripcion-vista">Tu opinión nos ayuda a mejorar nuestro servicio</p>
        </div>
        <form action="{{ route('registerValoracion') }}" method="POST" class="formulario-productos" id="formValoracion"
            onsubmit="handleValidationValoracion(event)">
            @csrf

            <input type="hidden" name="id_cita" value="{{ $id_cita }}">
            <!-- FORMULARIO -->
            <div class="columna-uno columna">
                <h2 class="titulo">¿Qué tan buena fue tu experiencia?</h2>
                <div class="informacion-input">
                    <p class="introduccion">Califica tu cita del 1 al 5 y déjanos un comentario para seguir mejorando.
                    </p>
                    <div id="estrellas" class="estrellas">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star estrella-form" data-valor="{{ $i }}"></i>
                        @endfor

                    </div>
                    <!-- Este input oculto se usa para enviar el valor al backend -->
                    <input type="hidden" name="calificacion" id="calificacion" value="">
                </div>


                <div class="informacion-input">
                    <p class="texto-input">COMENTARIO</p>
                    <textarea name="comentario" id="comentario" class="insercion-input" maxlength="255"
                        oninput="actualizarVistaValoracion()"></textarea>
                </div>

                <!-- BOTONES -->
                <div class="contenedor-botones">
                    <button type="button" class="botones cancelar" onclick="window.history.back()">CANCELAR</button>
                    <button type="submit" class="botones guardar">ENVIAR</button>
                </div>
            </div>

            <!-- VISTA DE PREVISUALIZACIÓN -->
            <div class="columna-dos columna">
                <div class="carta">
                    <div class="izquierda">
                        <div class="negocio" style="background: url({{ $img_establecimiento_portada }})">
                            <img src="{{ $img_establecimiento_perfil }}" alt="Perfil del establecimiento"
                                class="img-perfil">
                            <p>{{ $nombre_establecimiento }}</p>
                        </div>
                    </div>
                    <div class="derecha">
                        <div class="cita">
                            <p class="p-cita">ID DE CITA</p>
                            <p class="numero-cita">{{ $id_cita }}</p>
                        </div>

                        <div class="usuario">
                            <div class="usuario-info">
                                <img src="{{ $imgusuario }}" alt="Perfil del usuario" class="img-perfil">
                                <p>{{ $nombre_usuario }} {{ $apellido_usuario }}</p>
                            </div>
                        </div>

                        <div class="estrellas">
                            <p>Puntuacion</p>
                            <div id="estrellas-preview" class="estrellas-preview">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star estrella-preview" data-valor="{{ $i }}"></i>
                                @endfor
                            </div>
                        </div>

                        <div class="comentario">
                            <p class="elementos" id="previewComentario">Comentario</p>
                        </div>
                    </div>


                </div>
            </div>


        </form>
    </main>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>
    <script src="{{ asset('Js/Insercciones/valoraciones.js') }}"></script>


    <style>

    </style>
</body>

</html>
