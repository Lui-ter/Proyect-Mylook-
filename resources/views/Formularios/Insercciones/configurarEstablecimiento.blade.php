<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configurar mi establecimiento</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionEstablecimiento.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
</head>

<body>
    <main>
        <!--FORMULARIO PARA REGISTRAR ESTABLECIMIENTOS -->
        <form action="{{ route('registerEstablecimiento') }}" method="POST"
            onsubmit="handleValidationEstablecimiento(event)" class="configuracion-establecimiento formulario"
            id="form3">
            @csrf
            <h2 class="titulo-principal">CONFIGURACIÓN ESTABLECIMIENTO</h2>
            <p>
                En este apartado podrás modificar los datos de la sede de forma fácil y rápida. Esto te permitirá
                mantener la
                información actualizada en todo momento.
            </p>
            <section class="formulario-establecimiento">
                <div class="informacion-input">
                    <p class="nombre-input">NIT ESTABLECIMIENTO</p>
                    <input type="number" class="input-id" id="idEstablc" name="idEstablc"
                     value="{{ old('idEstablc') }}">
                    @error('idEstablc')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">NOMBRE</p>
                    <input type="text" class="input-nombre" id="nombreEst" name="nombreEst"
                    value="{{ old('nombreEst') }}">
                    @error('nombreEst')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">DIRECCIÓN</p>
                    <input type="text" class="input-direccion" id="direccionEstablecimiento"
                        name="direccionEstablecimiento" 
                        value="{{ old('direccionEstablecimiento') }}">
                    @error('direccionEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">DESCRIPCIÓN</p>
                    <textarea name="descripcionEstablecimiento" id="inputDescripcion" cols="30" rows="10" class="inputDescripcion"
                    >{{ old('descripcionEstablecimiento') }}</textarea>
                    @error('descripcionEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">TELÉFONO</p>
                    <input type="text" class="input-tel" id="telefonoEstablecimiento" name="telefonoEstablecimiento"
                        value="{{ old('telefonoEstablecimiento') }}">
                    @error('telefonoEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacion-input">
                    <p class="nombre-input">CORREO</p>
                    <input type="text" class="input-email" id="correoEstablecimiento" name="correoEstablecimiento"
                     value="{{ old('correoEstablecimiento') }}">
                    @error('correoEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            <div class="contenedor-boton">
                <button type="submit" class="boton-continuar">ENVIAR</button>
            </div>
        </form>
    </main>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>
</body>

</html>
