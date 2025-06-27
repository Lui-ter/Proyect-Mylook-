<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/Form/recuperacionContrasena/codigo.css') }}" />
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Recuperacion de contraseña</title>
</head>

<body>
    <main>
        <form action="{{ route('nuevaContrasena') }}" method="POST" class="carta">
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
                <h2>CAMBIO DE CONTRASEÑA</h2>
                <p>Elige una nueva contraseña que sea fácil de recordar, pero difícil de adivinar. Debe tener al menos
                    una mayúscula y un número.</p>

                {{-- Mostrar solo un mensaje de error a la vez --}}
                @if ($errors->has('contrasena'))
                    <div class="validacion-error">
                        {{ $errors->first('contrasena') }}
                    </div>
                @elseif ($errors->has('confirmar_contrasena'))
                    <div class="validacion-error">
                        {{ $errors->first('confirmar_contrasena') }}
                    </div>
                @endif

                <div class="informacion-input">
                    <p>Nueva contraseña</p>
                    <input type="text" name="contrasena" id="documentoUsuario" class="inputForm" placeholder=""
                        value="{{ old('contrasena') }}">
                </div>

                <div class="informacion-input">
                    <p>Confirmar contraseña</p>
                    <input type="text" name="confirmar_contrasena" id="nombreUsuario" class="inputForm"
                        placeholder="" value="{{ old('confirmar_contrasena') }}">
                </div>

                <div class="boton">
                    <button type="submit" class="btnSave" id="btnSend">Guardar Cambios</button>
                </div>
            </div>

        </form>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const errores = document.querySelectorAll(".validacion-error");

                errores.forEach((error) => {
                    setTimeout(() => {
                        error.style.opacity = "0";
                    }, 3000);

                    setTimeout(() => {
                        error.remove();
                    }, 3500);
                });
            });
        </script>
    </main>

</body>

</html>
