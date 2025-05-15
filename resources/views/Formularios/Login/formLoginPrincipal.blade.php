<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Form/formLoginPrincipal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Inicio de sesión | MyLook</title>
</head>

<body>

    <!-- SOLO PARA PRINCIPAL -->
    <div class="contenedorPc">
        <div class="contenedor" id="contenedor">
            <!-- Formulario de Registro -->
            <div class="contenedor-formulario contenedor-registro">
                <form action="{{ route('registerUser') }}" method="POST" class="registerForm"
                    onsubmit="handleValidationRegister(event)">
                    @csrf
                    <h2 class="inputH2">REGISTRARSE</h2>
                    <div class="botones-tipo-usuario">
                        <button type="button" class="boton-tipo-usuario activo" data-tipo="1">Negocio</button>
                        <button type="button" class="boton-tipo-usuario" data-tipo="2">Usuario</button>
                        <input type="hidden" name="tipo_usuario" id="tipo_usuario" class="tipo_usuario">
                    </div>
                    <div class="campos-formulario campos-estudiante">
                        <div class="input-container">
                            <p class="inputP">NIT EMPRESARIAL</p>
                            <input id="1" type="text" name="nitNegocio"/>
                        </div>
                        <div class="input-container">
                            <p class="inputP">NOMBRE DE NEGOCIO</p>
                            <input id="2" type="text" name="nombreNegocio"/>
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA DE NEGOCIO</p>
                            <input id="3" type="password" name="contrasenaNegocio"/>
                        </div>
                    </div>
                    <div class="campos-formulario campos-profesor" style="display: none;">
                        <div class="input-container">
                            <p class="inputP">DOCUMENTO</p>
                            <input id="4" type="text" name="docUsuario" id="documentoUsuario"/>
                        </div>
                        <div class="input-container">
                            <p class="inputP">NOMBRE</p>
                            <input id="5" type="text" name="nombreCompletoUsuario" id="nombreUsuario"/>
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA</p>
                            <input id="7" type="password" name="contrasenaUsuario" id="passwordUsuario"/>
                        </div>
                    </div>
                    <div class="enlaces-formulario2">
                        <a href="#" class="tiene-cuenta">¿YA TIENES CUENTA? INICIAR SESION</a>
                    </div>
                    <button type="submit" name="accionRegistrar" value="registrar">REGISTRAR</button>

                </form>
            </div>

            <!-- Formulario de Inicio de Sesión -->
            <div class="contenedor-formulario contenedor-inicio-sesion activo">
                <form action="{{ route('loginUser') }}" method="POST" class="loginForm"
                    onsubmit="handleValidationLogin(event)">
                    @csrf
                    <h2 class="inputH2">INICIAR SESIÓN</h2>
                    <div class="botones-tipo-usuario">
                        <button type="button" class="boton-tipo-usuario activo" data-tipo="1">USUARIO</button>
                        <button type="button" class="boton-tipo-usuario" data-tipo="2">NEGOCIO</button>
                        <input type="hidden" name="tipo_usuario" class="tipo_usuario">
                    </div>
                    <div class="campos-formulario campos-estudiante">
                        <div class="input-container">
                            <p class="inputP">DOCUMENTO</p>
                            <input type="text" name="documentoUsuario" id="8"/>
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA</p>
                            <input type="password" name="passwordUsuario" id="9"/>
                        </div>
                        <input type="hidden" name="rol" value="estudiante" />
                    </div>
                    <div class="campos-formulario campos-profesor" style="display: none;">
                        <div class="input-container">
                            <p class="inputP">NIT EMPRESARIAL</p>
                            <input type="text" name="nitNegocio" id="10"/>
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA</p>
                            <input type="password" name="contrasenaNegocio" id="11"/>
                        </div>
                    </div>
                    <div class="enlaces-formulario">
                        <a href="#" class="olvidaste-contraseña">¿OLVIDASTE TU CONTRASEÑA?</a>
                        <a href="#" class="no-tiene-cuenta">¿NO TIENE CUENTA?</a>
                    </div>
                    <button type="submit" name="accionIniciarSesion" value="iniciar_sesion">INICIAR</button>
                </form>
            </div>
            
            <!-- Panel de Superposición (solo visible en desktop) -->
            <div class="contenedor-superposicion">
                <div class="superposicion">
                    <div class="panel-superposicion panel-izquierdo">
                        <h1>MYLOOK</h1>
                        <p>BIENVENIDO!</p>
                        <button type="submit" class="fantasma" id="botonInicioSesion">Accede Ahora</button>
                    </div>
                    <div class="panel-superposicion panel-derecho">
                        <div class="imgPresentation">
                            <h3>Bienvenido a</h3>
                            <h1>MYLOOK</h1>
                            <div class="promotion">
                                <p>"Resplandece con estilo.<br>
                                    haz tu cita hoy mismo y dejate envolver por la belleza ¡ No esperes Mas !"</p>
                            </div>
                            <button type="submit" class="fantasma" id="botonRegistro">Únete Hoy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- LOGICA JS PARA EL MANEJO DE FORMULARIOS -->
        <script src="{{ asset('Js/Formularios/LoginPrincipal/logicLoginPrincipal.js') }}"></script>
        <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>
    </div>
</body>

</html>