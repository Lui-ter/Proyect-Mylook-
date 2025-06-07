<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>configurar mi perfil</title>
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionPerfil.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

</head>

<body>
    <main>
        <!--FORMULARIO PARA REGISTRAR USUARIOS COMO ADMINISTRADORES -->
        <form action="{{ route('userUpdate') }}" method="POST" class="configuracionPerfil formulario active"
            id="form1" enctype="multipart/form-data" onsubmit="handleValidationUser(event)">
            @method('PUT')
            @csrf
            <!-- titulo formulario  -->
            <h2 class="tituloPrincipal">CONFIGURACION PERFIL</h2>
            <!-- descripcion Formulario -->
            <p>
                En este apartado podrás ingresar tu información personal de forma
                fácil y rápida. Esto te permitirá mantener tus datos actualizados
                en todo momento
            </p>
            <!-- contenedor de inputs -->
            <section class="formularioPerfil">
                <div class="informacionInput">
                    <p class="nombreInput">DOCUMENTO</p>
                    <input type="number" class="inputDocumento" id="idUser" name="idUser"
                        placeholder="Ingrese su documento" value="{{ $usuario->id_usuario }}" readonly>
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">NOMBRE</p>
                    <input type="text" class="inputNombre" id="nombreUser" name="nombreUser"
                        placeholder="Ingrese su nombre" value="{{ $usuario->nombre }}" readonly>
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">APELLIDO</p>
                    <input type="text" class="inputApellido" id="apellidoUser" name="apellidoUser"
                        placeholder="Ingrese su apellido" value="{{ old('apellidoUser') }}">
                    @error('apellidoUser')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">CORREO</p>
                    <input type="text" class="inputCorreo" id="correoUser" name="correoUser"
                        placeholder="Ingrese su correo" value="{{ old('correoUser') }}">
                    @error('correoUser')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">TELEFONO</p>
                    <input type="number" class="inputTelefono" id="telefonoUser" name="telefonoUser"
                        placeholder="Ingrese su teléfono" value="{{ old('telefonoUser') }}">
                    @error('telefonoUser')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <figure>
                    <input type="file" name="imagenPerfil" id="fileInput" accept="image/*" />
                    <img id="previsualizacionImagen"
                    src="https://cdn-icons-png.flaticon.com/512/7046/7046041.png"
                    alt="Imagen de perfil" />
                </figure>

                <div class="informacionInput">
                    @error('imagenPerfil')
                    <center>
                        <div class="error">{{ $message }}</div>
                    </center>
                    @enderror
                    <div class="informacionInput">
                        <p class="nombreInput">CONDICION</p>
                        <input type="text" class="inputCondicion" id="condicionUser" name="condicionUser"
                            placeholder="Ingrese su condicion" value="{{ old('condicionUser') }}">
                        @error('condicionUser')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <div class="contenedorBoton">
                <button type="submit" class="botonContinuar">ACTUALIZAR</button>
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
