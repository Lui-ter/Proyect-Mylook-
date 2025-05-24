<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/Config/configUsuarios.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Recuperacion de contraseña</title>
</head>

<body>

    <section class="contenedorPadre">

        <form action="{{ route('codigoVerificacion') }}" method="POST" class="formConfig">
            @csrf
            <div class="groupInput datosNumericos">
                <label for="" class="nomLabel">Código de verificación</label>
                <input type="text" name="codigo" id="documentoUsuario" class="inputForm" placeholder="Ingrese el codigo de verificacion" value="">
                @error('codigo')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="btnSend">
                <button type="submit" class="btnSave" id="btnSend">Enviar</button>
            </div>
        </form>

    </section>
</body>
</html>
