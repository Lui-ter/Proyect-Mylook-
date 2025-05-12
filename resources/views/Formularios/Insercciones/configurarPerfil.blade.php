<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>configurar mi perfil</title>
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionPerfil.css') }}">
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
                    <input type="number" class="inputDocumento" id="idAdmin" name="idAdmin" placeholder="Ingrese su documento">
                </div>

                <div class="informacionInput">
                    <p class="nombreInput">NOMBRE</p>
                        <input type="text" class="inputNombre" id="nombreAdmin" name="nombreAdmin" placeholder="Ingrese su nombre">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">APELLIDO</p>
                        <input type="text" class="inputApellido" id="apellidoAdmin" name="apellidoAdmin" placeholder="Ingrese su apellido">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">CORREO</p>
                        <input type="text" class="inputCorreo" id="correoAdmin" name="correoAdmin" placeholder="Ingrese su correo">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">TELEFONO</p>
                        <input type="number" class="inputTelefono" id="telefonoAdmin" name="telefonoAdmin" placeholder="Ingrese su teléfono">
                    </div>

                    <figure>
                        <input type="file" name="imagenPerfil" id="fileInput" accept="image/*" />
                        <img id="previsualizacionImagen" src="https://elcomercio.pe/resizer/v2/6EET3CTJKFGULGWGFUAVL6LDI4.png?auth=84cb6e3da22c2e6bdaa6eafd1c1d02b9e834412493839dc1e075615b99b9780b&width=1200&height=1200&quality=90&smart=true" alt="Imagen de perfil" />
                    </figure>

                    <div class="informacionInput">
                        <p class="nombreInput">CONTRASEÑA</p>
                        <input type="password" class="inputPassword" id="contrasenaAdmin" name="contrasenaAdmin" placeholder="Ingrese su contraseña">
                    </div>
                </section>

            <div class="contenedorBoton">
                <button type="submit" class="botonContinuar">ACTUALIZAR</button>
            </div>
        </form>
    </main>
    <script src="/Js/Admin/configBienvenidaAdmin.js"></script>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
    </body>
</html>
