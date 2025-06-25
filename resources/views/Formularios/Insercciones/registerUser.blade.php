<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionPerfil.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Configurar mi perfil</title>

</head>

<body>
    <main>
        <!--FORMULARIO PARA REGISTRAR USUARIOS COMO ADMINISTRADORES -->
        <form action="{{ route('userUpdate') }}" method="POST" class="configuracion-perfil formulario active"
            id="form1" enctype="multipart/form-data" onsubmit="handleValidationUser(event)">
            @method('PUT')
            @csrf

            <div class="encabezado">
                <h2 class="titulo-principal">CONFIGURACIÓN PERFIL</h2>
                <p class="introduccion">En este apartado podrás ingresar tu información personal de forma fácil y rápida. Esto te permitirá mantener tus datos actualizados en todo momento</p>
            </div>

            <div class="informacion">
                <div class="datos-personales">
                    <div class="contenedor-columnas">
                         <div class="campos">
                            <p class="titulo-input">DOCUMENTO</p>
                            <input type="number" class="input-registro" id="idUser" name="idUser" value="{{ $usuario->id_usuario }}" readonly>
                        </div>

                        <div class="campos">
                            <p class="titulo-input">TELÉFONO</p>
                            <input type="number" class="input-registro" id="telefonoUser" name="telefonoUser" value="{{ old('telefonoUser') }}">
                            @error('telefonoUser')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="campos">
                            <p class="titulo-input">NOMBRE</p>
                            <input type="text" class="input-registro" id="nombreUser" name="nombreUser" value="{{ $usuario->nombre }}" readonly>
                        </div>

                        <div class="campos">
                            <p class="titulo-input">APELLIDO</p>
                            <input type="text" class="input-registro" id="apellidoUser" name="apellidoUser" value="{{ old('apellidoUser') }}">
                            @error('apellidoUser')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="contenedor-campos">
                        <p class="titulo-input">CORREO</p>
                        <input type="text" class="input-registro" id="correoUser" name="correoUser" value="{{ old('correoUser') }}">
                        @error('correoUser')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="contenedor-campos campo-condicion">
                        <p class="titulo-input">CONDICIÓN</p>
                        <textarea type="text" class="input-registro" id="condicionUser" name="condicionUser">{{ old('condicionUser') }}</textarea>
                        @error('condicionUser')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="contenedor-boton">
                        <button type="submit" class="boton" id="botonGuardar">GUARDAR</button>
                    </div>
                </div>

                <div class="contenedor-foto">
                    <div class="foto-perfil">
                        <img class="imagen" id="previsualizacionImagen" src="https://i.postimg.cc/50FHH151/usuario-de-perfil.png" alt="Imagen de perfil" />
                    </div>

                    <div class="campo-foto">
                        <label for="fileInput" class="foto">
                            <i class="bi bi-camera icono"></i>
                            <span class="texto-input imagen-input">SELECCIONA LA IMAGEN</span>
                        </label>
                        <input type="file" name="imagenPerfil" id="fileInput" class="input-foto" accept="image/*" onchange="updateProfileImage(event)" src="{{ $usuario->img_usuario ? $usuario->img_usuario : '' }}">
                    </div>

                    <div class="informacionInput">
                        @error('imagenPerfil')
                        <center>
                            <div class="error">{{ $message }}</div>
                        </center>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>

<script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>
<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const archivo = event.target.files[0];
        const preview = document.getElementById('previsualizacionImagen');
        if (archivo) {
            const lector = new FileReader();
            lector.onload = function(e) {
                preview.src = e.target.result;
            };
            lector.readAsDataURL(archivo);
        } else {
            preview.src =
                "https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true";
        }
    });
</script>

</html>
