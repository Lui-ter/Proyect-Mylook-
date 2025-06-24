<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configurar mi perfil</title>
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/registroAdministrador.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <main>
        <!--FORMULARIO PARA REGISTRAR USUARIOS COMO ADMINISTRADORES -->
        <form action="{{ route('registerUserAdmin') }}" method="POST" onsubmit="handleValidationAdmin(event)"
            class="configuracion-perfil formulario active" id="form1" enctype="multipart/form-data">
            @csrf

            <div class="encabezado">
                <h1 class="titulo-principal">CONFIGURACIÓN DE PERFIL</h1>
                <p class="introduccion">En este apartado podrás ingresar tu información personal de forma fácil y rápida. Esto te permitirá mantener tus datos actualizados en todo momento</p>
            </div>

            <div class="informacion">
                <div class="datos-personales">
                    <div class="contenedor-columnas">
                        <div class="campos">
                            <p class="titulo-input">DOCUMENTO</p>
                            <input type="number" class="input-registro" id="idAdmin" name="idAdmin" value="{{ old('idAdmin', $data['idAdmin'] ?? '') }}">
                            @if (isset($validationErrors) && $validationErrors->has('idAdmin'))
                                <div class="error">{{ $validationErrors->first('idAdmin') }}</div>
                            @endif
                        </div>

                        <div class="campos">
                            <p class="titulo-input">TELÉFONO</p>
                            <input type="number" class="input-registro" id="telefonoAdmin" name="telefonoAdmin" value="{{ old('telefonoAdmin', $data['telefonoAdmin'] ?? '') }}">
                            @if (isset($validationErrors) && $validationErrors->has('telefonoAdmin'))
                                <div class="error">{{ $validationErrors->first('telefonoAdmin') }}</div>
                            @endif
                        </div>

                        <div class="campos">
                            <p class="titulo-input">NOMBRE</p>
                            <input type="text" class="input-registro" id="nombreAdmin" name="nombreAdmin" value="{{ old('nombreAdmin', $data['nombreAdmin'] ?? '') }}">
                            @if (isset($validationErrors) && $validationErrors->has('nombreAdmin'))
                                <div class="error">{{ $validationErrors->first('nombreAdmin') }}</div>
                            @endif
                        </div>

                        <div class="campos">
                            <p class="titulo-input">APELLIDO</p>
                            <input type="text" class="input-registro" id="apellidoAdmin" name="apellidoAdmin" value="{{ old('apellidoAdmin', $data['apellidoAdmin'] ?? '') }}">
                            @if (isset($validationErrors) && $validationErrors->has('apellidoAdmin'))
                                <div class="error">{{ $validationErrors->first('apellidoAdmin') }}</div>
                            @endif
                        </div>

                        <div class="campos">
                            <p class="titulo-input">CORREO</p>
                            <input type="text" class="input-registro" id="correoAdmin" name="correoAdmin" value="{{ old('correoAdmin', $data['correoAdmin'] ?? '') }}">
                            @if (isset($validationErrors) && $validationErrors->has('correoAdmin'))
                                <div class="error">{{ $validationErrors->first('correoAdmin') }}</div>
                            @endif
                        </div>

                        <div class="campos">
                            <p class="titulo-input">CONTRASEÑA</p>
                            <input type="password" class="input-registro" id="contrasenaAdmin" name="contrasenaAdmin">
                            @if (isset($validationErrors) && $validationErrors->has('contrasenaAdmin'))
                                <div class="error">{{ $validationErrors->first('contrasenaAdmin') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="contenedor-campos campo-condicion">
                        <p class="titulo-input">CONDICIÓN</p>
                        <textarea type="text" class="input-registro" name="" id="condicionUser"></textarea>
                    </div>

                    <div class="contenedor-boton">
                        <button type="submit" class="boton">GUARDAR</button>
                    </div>
                </div>

                <div class="contenedor-foto">
                    <div class="foto-perfil">
                        <img class="imagen" id="previsualizacionImagen" src="https://i.postimg.cc/C1wVVT7L/usuario-de-perfil-1.png" alt="Imagen de perfil" />
                    </div>

                    <div class="campo-foto">
                        <label for="fileInput" class="foto">
                            <i class="bi bi-camera icono"></i>
                            <span class="texto-input imagen-input">SELECCIONA LA IMAGEN</span>
                        </label>
                        <input class="input-foto" type="file" name="imagenPerfil" id="fileInput" accept="image/*" />
                    </div>
                </div>
            </div>
        </form>
    </main>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
    </body>
</html>