<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configurar mi establecimiento</title>
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionEstablecimiento.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
</head>

<body>
    <main>
        <!--FORMULARIO PARA REGISTRAR ESTABLECIMIENTOS -->
        <form action="{{ route('registerEstablecimiento') }}" method="POST" onsubmit="handleValidationEstablecimiento(event)" class="configuracionEstablecimiento formulario" id="form3">
            @csrf
            <h2 class="tituloPrincipal">CONFIGURACIÓN ESTABLECIMIENTO</h2>
            <p>
                En este apartado podrás modificar los datos de la sede de forma fácil y rápida. Esto te permitirá
                mantener la
                información actualizada en todo momento.
            </p>
            <section class="formularioEstablecimiento">
                <div class="informacionInput">
                    <p class="nombreInput">NIT ESTABLECIMIENTO</p>
                    <input type="number" class="inputId" id="idEstablc" name="idEstablc" placeholder="Ingrese el nit del establecimiento" value="{{ old('idEstablc') }}">
                     @error('idEstablc')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">NOMBRE</p>
                    <input type="text" class="inputNombre" id="nombreEst" name="nombreEst" placeholder="Ingrese el nombre del establecimiento" value="{{ old('nombreEst') }}">
                    @error('nombreEst')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">DIRECCIÓN</p>
                    <input type="text" class="inputDireccion" id="direccionEstablecimiento" name="direccionEstablecimiento"  placeholder="Ingrese la dirección del establecimiento" value="{{ old('direccionEstablecimiento') }}">
                    @error('direccionEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">DESCRIPCIÓN</p>
                    <textarea name="descripcionEstablecimiento" id="inputDescripcion" cols="30" rows="10" class="inputDescripcion" placeholder="Ingrese la descripción del establecimiento">{{ old('descripcionEstablecimiento') }}</textarea>
                    @error('descripcionEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">TELÉFONO</p>
                    <input type="text" class="inputTel" id="telefonoEstablecimiento" name="telefonoEstablecimiento" placeholder="Ingrese el teléfono del establecimiento" value="{{ old('telefonoEstablecimiento') }}">
                    @error('telefonoEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">CORREO</p>
                    <input type="text" class="inputEmail" id="correoEstablecimiento" name="correoEstablecimiento" placeholder="Ingrese el correo del establecimiento" value="{{ old('correoEstablecimiento')}}">
                    @error('correoEstablecimiento')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            <div class="contenedorBoton">
                <button type="submit" class="botonContinuar">ENVIAR</button>
            </div>
        </form>
    </main>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
</body>
</html>
