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
        <form action="{{ route('updateUserAdmin',['id' => $usuarioAdmin->id_usuario]) }}" method="POST" onsubmit="handleValidationUpdateAdmin(event)" class="configuracionPerfil formulario active" id="form1" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- titulo formulario  -->
            <h2 class="tituloPrincipal">CONFIGURACION PERFIL</h2>
            <!-- descripcion Formulario -->
            <p>
                En este apartado podrás modificar tu información personal de forma
                fácil y rápida. Esto te permitirá mantener tus datos actualizados
                en todo momento
            </p>
            <!-- contenedor de inputs -->
            <section class="formularioPerfil">
                <div class="informacionInput">
                    <p class="nombreInput">DOCUMENTO</p>
                    <input type="number" class="inputDocumento" id="idAdmin" name="idAdmin" value="{{ $usuarioAdmin->id_usuario}}" readonly>
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">NOMBRE</p>
                        <input type="text" class="inputNombre" id="nombreAdmin" name="nombreAdmin" value="{{ $usuarioAdmin->nombre}}" placeholder="Ingrese su nombre">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">APELLIDO</p>
                        <input type="text" class="inputApellido" id="apellidoAdmin" name="apellidoAdmin" value="{{ $usuarioAdmin->apellido}}" placeholder="Ingrese su apellido">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">CORREO</p>
                        <input type="text" class="inputCorreo" id="correoAdmin" name="correoAdmin" value="{{ $usuarioAdmin->correo}}" placeholder="Ingrese su correo">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">TELEFONO</p>
                        <input type="number" class="inputTelefono" id="telefonoAdmin" name="telefonoAdmin" value="{{ $usuarioAdmin->telefono}}" placeholder="Ingrese su teléfono">
                    </div>

                    <figure>
                        <input type="file" name="imagenPerfil" id="fileInput" accept="image/*" />
                        <img id="previsualizacionImagen" src="data:image/png;base64,{{ $fotoAdmin }}" alt="Imagen de perfil" />
                    </figure>


                    <div class="informacionInput">
                    </div>
                </section>

            <div class="contenedorBoton">
                <button type="submit" class="botonContinuar">ACTUALIZAR</button>
            </div>
        </form>
    </main>
    <script src="{{ asset ('Js/Admin/configBienvenidaAdmin.js') }}"></script>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
    </body>
</html>
