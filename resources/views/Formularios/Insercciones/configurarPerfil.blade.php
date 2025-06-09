<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>configurar mi perfil</title>
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionPerfil.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
</head>

<body>
    <main>
        <!--FORMULARIO PARA REGISTRAR USUARIOS COMO ADMINISTRADORES -->
        <form action="{{ route('registerUserAdmin') }}" method="POST" onsubmit="handleValidationAdmin(event)" class="configuracionPerfil formulario active" id="form1" enctype="multipart/form-data">
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
                    <input type="number" class="inputDocumento" id="idAdmin" name="idAdmin" placeholder="Ingrese su documento" value="{{ old('idAdmin', $data['idAdmin'] ?? '') }}">
                    @if (isset($validationErrors) && $validationErrors->has('idAdmin'))
                        <div class="error">{{ $validationErrors->first('idAdmin') }}</div>
                    @endif
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">NOMBRE</p>
                        <input type="text" class="inputNombre" id="nombreAdmin" name="nombreAdmin" placeholder="Ingrese su nombre" value="{{ old('nombreAdmin', $data['nombreAdmin'] ?? '') }}">
                        @if (isset($validationErrors) && $validationErrors->has('nombreAdmin'))
                            <div class="error">{{ $validationErrors->first('nombreAdmin') }}</div>
                        @endif
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">APELLIDO</p>
                        <input type="text" class="inputApellido" id="apellidoAdmin" name="apellidoAdmin" placeholder="Ingrese su apellido" value="{{ old('apellidoAdmin', $data['apellidoAdmin'] ?? '') }}">
                        @if (isset($validationErrors) && $validationErrors->has('apellidoAdmin'))
                            <div class="error">{{ $validationErrors->first('apellidoAdmin') }}</div>
                        @endif
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">CORREO</p>
                        <input type="text" class="inputCorreo" id="correoAdmin" name="correoAdmin" placeholder="Ingrese su correo" value="{{ old('correoAdmin', $data['correoAdmin'] ?? '') }}">
                        @if (isset($validationErrors) && $validationErrors->has('correoAdmin'))
                            <div class="error">{{ $validationErrors->first('correoAdmin') }}</div>
                        @endif
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">TELEFONO</p>
                        <input type="number" class="inputTelefono" id="telefonoAdmin" name="telefonoAdmin" placeholder="Ingrese su teléfono" value="{{ old('telefonoAdmin', $data['telefonoAdmin'] ?? '') }}">
                        @if (isset($validationErrors) && $validationErrors->has('telefonoAdmin'))
                            <div class="error">{{ $validationErrors->first('telefonoAdmin') }}</div>
                        @endif
                    </div>

                    <figure>
                        <input type="file" name="imagenPerfil" id="fileInput" accept="image/*" />
                        <img id="previsualizacionImagen" src="https://i.postimg.cc/C1wVVT7L/usuario-de-perfil-1.png" alt="Imagen de perfil" />
                    </figure>

                    <div class="informacionInput">
                        <p class="nombreInput">CONTRASEÑA</p>
                        <input type="password" class="inputPassword" id="contrasenaAdmin" name="contrasenaAdmin" placeholder="Ingrese su contraseña">
                        @if (isset($validationErrors) && $validationErrors->has('contrasenaAdmin'))
                            <div class="error">{{ $validationErrors->first('contrasenaAdmin') }}</div>
                        @endif
                    </div>
                </section>

            <div class="contenedorBoton">
                <button type="submit" class="botonContinuar">ACTUALIZAR</button>
            </div>
        </form>
    </main>
    <script src="{{ asset('Js/Admin/configBienvenidaAdmin.js') }}"></script>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
    </body>
</html>
