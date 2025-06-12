<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configurar mi establecimiento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionEstablecimiento.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/actualizarEstablecimiento.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

</head>

<body>
    @section('link-index', '/admin/index')
    @section('link-configurar-perfil', route('admin', ['accion' => 'config']))
    @section('link-configurar-establecimiento', route('establecimientos', ['accion' => 'config']))
    @section('link-configurar-negocio', route('negocio', ['accion' => 'config']))
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/negocio/logout')

    @include('components.header-staff', ['notificaciones' => $notificaciones, 'imgStaff' => $imgStaff])

    <main>
        <!--FORMULARIO PARA REGISTRAR ESTABLECIMIENTOS -->
        <form action="{{ route('updateEstablecimiento', ['id' => $establecimiento->id_establc]) }}" method="POST"
            onsubmit="handleValidationEstablecimiento(event)" class="configuracion-establecimiento formulario"
            id="form3">
            @method('PUT')
            @csrf
            <h2 class="titulo-principal">CONFIGURACIÓN ESTABLECIMIENTO</h2>
            <p>
                En este apartado podrás modificar los datos de la sede de forma fácil y rápida. Esto te permitirá
                mantener la
                información actualizada en todo momento.
            </p>
            {{-- Quitamos el value con session para evitar errores --}}
            <input type="hidden" name="idNegocio" value="{{ $idNegocio }}">
            <section class="formulario-establecimiento">
                <div class="informacion-input">
                    <p class="nombre-input">NIT NEGOCIO</p>
                    <input type="number" class="input-id" id="idEstablc" name="idEstablc"
                        value="{{ $establecimiento->id_establc }}" readonly>
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">NOMBRE</p>
                    <input type="text" class="input-nombre" id="nombreEst" name="nombreEst"
                        value="{{ $establecimiento->nombre_establc }}"
                       >
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">DIRECCIÓN</p>
                    <input type="text" class="input-direccion" id="direccionEstablecimiento"
                        name="direccionEstablecimiento" value="{{ $establecimiento->ubicacion }}"
                        >
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">DESCRIPCIÓN</p>
                    <textarea name="descripcionEstablecimiento" id="inputDescripcion" cols="30" rows="10" class="inputDescripcion"
                       >{{ $establecimiento->desc_establc }}</textarea>
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">TELÉFONO</p>
                    <input type="text" class="input-tel" id="telefonoEstablecimiento" name="telefonoEstablecimiento"
                        value="{{ $establecimiento->telefono }}">
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">CORREO</p>
                    <input type="text" class="input-email" id="correoEstablecimiento" name="correoEstablecimiento"
                        value="{{ $establecimiento->correo }}">
                </div>
            </section>

            <div class="contenedor-boton">
                <button type="submit" class="boton-continuar">ACTUALIZAR</button>
            </div>
        </form>
    </main>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>

</body>

</html>
