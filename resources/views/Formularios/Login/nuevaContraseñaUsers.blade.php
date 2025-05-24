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

        <form action="{{ route('nuevaContrasena') }}" method="POST" class="formConfig">
            @csrf
            <div class="groupInput datosNumericos">
                <label for="" class="nomLabel">Nueva contraseña</label>
                <input type="text" name="contrasena" id="documentoUsuario" class="inputForm" placeholder="" >
                @error('contrasena')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="datosPersonales">
                <div class="groupInput containerPersonal">
                    <label for="" class="nomLabel">Confirmar contraseña</label>
                    <input type="text" name="confirmar_contrasena" id="nombreUsuario" class="inputForm" placeholder="">
                    @error('confirmar_contrasena')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

            <div class="btnSend">
                <button type="submit" class="btnSave" id="btnSend">Guardar Cambios</button>
            </div>
        </form>

    </section>
</body>
</html>
