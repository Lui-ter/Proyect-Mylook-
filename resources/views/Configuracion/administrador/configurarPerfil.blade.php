<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('Css/Config/configPerfil.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Configurar mi perfil</title>

</head>

<body>
    @section('link-index', '/admin/index')
    @section('link-configurar-perfil', route('admin', ['accion' => 'config']))
    @section('link-configurar-establecimiento', route('establecimientos', ['accion' => 'config']))
    @section('link-configurar-negocio', route('negocio', ['accion' => 'config']))
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/negocio/logout')

    @include('components.header-staff', ['notificaciones' => $notificaciones, 'imgStaff' => $imgStaff])
    
    <main>
        <!--FORMULARIO PARA REGISTRAR USUARIOS COMO ADMINISTRADORES -->
        <form action="{{ route('updateUserAdmin', ['id' => $usuarioAdmin->id_usuario]) }}" method="POST"
            onsubmit="handleValidationUpdateAdmin(event)" class="configuracion-perfil formulario active" id="form1"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="encabezado">
                <h1 class="titulo">CONFIGURACIÓN DE PERFIL</h1>
                <p class="introduccion">En este apartado podrás modificar tu información personal de forma fácil y rápida. Esto te permitirá mantener tus datos actualizados en todo momento.</p>
            </div>

            <div class="informacion">
                <div class="datos-personales">
                    <div class="contenedor-columnas">
                        <div class="campos">
                            <p class="titulo-input">DOCUMENTO</p>
                            <input type="number" class="input-usuario" id="idAdmin" name="idAdmin" value="{{ $usuarioAdmin->id_usuario}}" readonly>
                        </div>

                        <div class="campos">
                            <p class="titulo-input">TELÉFONO</p>
                            <input type="number" class="input-usuario" id="telefonoAdmin" name="telefonoAdmin" value="{{ $usuarioAdmin->telefono}}">
                        </div>

                        <div class="campos">
                            <p class="titulo-input">NOMBRE</p>
                            <input type="text" class="input-usuario" id="nombreAdmin" name="nombreAdmin" value="{{ $usuarioAdmin->nombre}}">
                        </div>

                        <div class="campos">
                            <p class="titulo-input">APELLIDO</p>
                            <input type="text" class="input-usuario" id="apellidoAdmin" name="apellidoAdmin" value="{{ $usuarioAdmin->apellido}}">
                        </div>
                    </div>

                    <div class="contenedor-campos">
                        <p class="titulo-input">CORREO</p>
                        <input type="text" class="input-usuario" id="correoAdmin" name="correoAdmin" value="{{ $usuarioAdmin->correo}}">
                    </div>

                    <div class="contenedor-campos campo-condicion">
                        <p class="titulo-input">CONDICIÓN</p>
                        <textarea type="text" class="input-usuario" name="" id="condicionUser"></textarea>
                    </div>

                    <div class="contenedor-botones">
                        <button type="button" class="botones" id="botonCancelar"onclick="window.history.back();">CANCELAR</button>
                        <button type="submit" class="botones" id="botonGuardar">GUARDAR</button>
                    </div>
                </div>

                <div class="contenedor-foto">
                    <div class="foto-perfil">
                        <img class="imagen" id="previsualizacionImagen" src="data:image/png;base64,{{ $fotoAdmin }}" alt="Imagen de perfil" />
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
    <script src="{{asset('Js/Admin/configBienvenidaAdmin.js')}}"></script>
    </body>
</html>