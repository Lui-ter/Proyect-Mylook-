<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/Form/recuperacionContrasena/codigo.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Recuperacion de contraseña</title>
</head>

<body>
    <main>
        <form action="{{ route('consultarCorreo') }}" method="POST" class="carta">
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
                <p>Ingrese el correo con el que tiene registrada su cuenta. Le enviaremos un mensaje con el código de
                    recuperación.</p>
                <div class="informacion-input">
                    <p>Correo</p>
                    <input type="text" name="correo" id="correoUsuario" class="inputForm"
                        placeholder="Inserte correo" value="{{ old('correo') }}">
                    @error('correo')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <a href="{{ route('login') }}">
                    <h4>volver</h4>
                </a>
                <div class="boton">
                    <button type="submit" class="btnSave" id="btnSend">Enviar</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>
