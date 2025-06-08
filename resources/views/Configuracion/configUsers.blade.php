<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/Config/configUsuarios.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <title>Configuracion de usuarios</title>
</head>

<body>

    @section('link-index', '/usuarios/index')
    @section('link-configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/usuarios/logout')

    @include('components.header',['imgusuario' => $imgusuario, 'notificaciones' => $notificaciones])

    <main>
        <form action="{{ route('updateUsers', ['id' => $usuario->id_usuario]) }}" method="POST"
            onsubmit="handleValidationConfigUser(event)" class="configuracion-usuario" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h1 class="titulo">CONFIGURACIÓN DE USUARIO</h1>
            <p class="introduccion">En este apartado podrás consultar y modificar tu información personal. Asegúrate de revisar y actualizar tus datos con regularidad para garantizar que todo esté correcto.</p>

            <div class="informacion">
                <div class="contenedor-foto">
                    <div class="foto-perfil">
                        <img class="imagen" id="imagenVisualizacion" src="{{ $usuario->img_usuario ? 'data:image/jpeg;base64,' . base64_encode($usuario->img_usuario) : 'https://cdn-user-icons.flaticon.com/146157/146157749/1749355227699.svg?token=exp=1749356138~hmac=99e703ccc7e3ab66c1dbfc8aa26cf896' }}" alt="Imagen de perfil">
                    </div>

                    <div class="campo-foto">
                        <label for="fileInput" class="foto">
                            <i class="bi bi-camera icono"></i>
                            <span class="texto-input imagen-input">SELECCIONA LA IMAGEN</span>
                        </label>
                        <input type="file" name="imagenPerfil" id="fileInput" class="input-foto" accept="image/*" onchange="updateProfileImage(event)">
                    </div>
                </div>


                <div class="datos-personales">
                    <div class="contenedor-columnas">
                        <div class="campos">
                            <p class="titulo-input">DOCUMENTO</p>
                            <input type="text" name="documentoUsuario" id="documentoUsuario" class="input-usuario" value="{{ $usuario->id_usuario }}">
                        </div>

                        <div class="campos">
                            <p class="titulo-input">TELÉFONO</p>
                            <input type="text" name="telefonoUsuario" id="telefonoUsuario" class="input-usuario" value="{{ $usuario->telefono }}">
                        </div>

                        <div class="campos">
                            <p class="titulo-input">NOMBRE</p>
                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="input-usuario" value="{{ $usuario->nombre }}">
                        </div>

                        <div class="campos">
                            <p class="titulo-input">APELLIDO</p>
                            <input type="text" name="apellidoUsuario" id="apellidoUsuario" class="input-usuario" value="{{ $usuario->apellido }}">
                        </div>
                    </div>

                    <div class="contenedor-campos">
                        <p class="titulo-input">CORREO</p>
                        <input type="text" name="correoUsuario" id="correoUsuario" class="input-usuario" value="{{ $usuario->correo }}">
                    </div>

                    <div class="contenedor-campos">
                        <p class="titulo-input">CONDICIÓN</p>
                        <input type="text" name="condicionUsuario" id="condicionUsuario" class="input-usuario" value="{{ $usuario->condicion }}">
                    </div>

                    <div class="contenedor-botones">
                        <button type="button" class="botones" id="botonCancelar"onclick="window.history.back();">CANCELAR</button>
                        <button type="submit" class="botones" id="botonGuardar">GUARDAR</button>
                    </div>

                </div>
            </div>
        </form>

    </main>

    <script src="/Js/Usuarios/configUsuario.js"></script>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>

</body>
</html>
