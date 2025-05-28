<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Recuperación de contraseña</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}" />
    <link rel="stylesheet" href="{{ asset('Css/Form/recuperacionContrasena/codigo.css') }}" />
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <main>
        <form action="{{ route('codigoVerificacion') }}" method="POST" class="carta">
            @csrf
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('logo.svg') }}" alt="">
                    <h3>MYLOOK</h3>
                </div>
                <a href="{{ route('landing') }}" class="btn-home">
                    <i class="fa-solid fa-house"></i>
                </a>
            </div>
            <div class="contenido-carta">
                <h2>RECUPERACIÓN DE CONTRASEÑA</h2>
                <p>
                    Ingrese el código de verificación que se ha enviado a su correo electrónico.
                    El código es válido por 5 minutos.
                </p>
                <div class="informacion-input">
                    <p>Código de verificación</p>
                    <input type="text" name="codigo" id="documentoUsuario" class="inputForm"
                        placeholder="Ingrese el código de verificación" />
                    @error('codigo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contador de 5 minutos -->
                <div class="opciones-codigo">
                    <p id="contador">05:00</p>
                    <p id="mensaje"></p>
                    <button type="button" id="botonReenviar">
                        Reenviar código (3 intentos restantes)
                    </button>
                </div>
                <div class="boton">
                    <button type="submit" class="btnSave" id="botonEnviar">Verificar</button>
                </div>
            </div>


        </form>
    </main>

    <script src="{{ asset('Js/Formularios/contrasena.js') }}"></script>

</body>

</html>
