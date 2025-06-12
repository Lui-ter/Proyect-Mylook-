<!DOCTYPE html>
<html lang="es">

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
                            <input id="1" type="text" name="nitNegocio" value="{{ old('nitNegocio') }}"/>
                            @error('nitNegocio')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-container">
                            <p class="inputP">NOMBRE DE NEGOCIO</p>
                            <input id="2" type="text" name="nombreNegocio" value="{{ old('nombreNegocio') }}"/>
                            @error('nombreNegocio')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA DE NEGOCIO</p>
                            <input id="3" type="password" name="contrasenaNegocio" value="{{ old('contrasenaNegocio') }}"/>
                            @error('contrasenaNegocio')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="campos-formulario campos-generales" style="display: none;">
                        <div class="input-container">
                            <p class="inputP">DOCUMENTO</p>
                            <input id="4" type="text" name="docUsuario" id="documentoUsuario" value="{{ old('docUsuario') }}"/>
                            @error('docUsuario')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-container">
                            <p class="inputP">NOMBRE</p>
                            <input id="5" type="text" name="nombreCompletoUsuario" id="nombreUsuario" value="{{ old('nombreCompletoUsuario') }}"/>
                            @error('nombreCompletoUsuario')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA</p>
                            <input id="7" type="password" name="contrasenaUsuario" id="passwordUsuario" value="{{ old('contrasenaUsuario') }}"/>
                            @error('contrasenaUsuario')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
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
                        <button type="button" class="boton-tipo-usuario" data-tipo="2"  id="botonNegocio">NEGOCIO</button>
                        <input type="hidden" name="tipo_usuario" class="tipo_usuario">
                    </div>
                    <div class="campos-formulario campos-estudiante">
                        <div class="input-container">
                            <p class="inputP">DOCUMENTO</p>
                            <input type="text" name="documentoUsuario" id="8"
                                value="{{ old('documentoUsuario') }}" />
                            @error('documentoUsuario')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA</p>
                            <input type="password" name="passwordUsuario" id="9" />
                            @error('passwordUsuario')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="rol" value="estudiante" />
                    </div>
                    @php
                        $mostrarNegocio =
                            session('mostrarNegocio') ||
                            $errors->has('nitNegocio') ||
                            $errors->has('contrasenaNegocio');
                    @endphp
                    <div class="campos-formulario campos-generales"
                        style="{{ $mostrarNegocio ? '' : 'display: none;' }}">
                        <div class="input-container">
                            <p class="inputP">NIT EMPRESARIAL</p>
                            <input type="text" name="nitNegocio" id="10"
                                value="{{ old('nitNegocio') }}" />
                            @error('nitNegocio')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-container">
                            <p class="inputP">CONTRASEÑA</p>
                            <input type="password" name="contrasenaNegocio" id="11" />
                            @error('contrasenaNegocio')
                                <div class="validacion-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="enlaces-formulario">
                        <a href="{{  route('contrasenas', ['accion' => 'olvidarContrasena']) }}" class="olvidaste-contraseña">¿OLVIDASTE TU CONTRASEÑA?</a>
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session('mostrarNegocio'))
                    document.getElementById('botonNegocio')?.click();
                @endif
            });
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mostrar automáticamente el formulario de REGISTRO
            @if ($errors->has('nitNegocio') || $errors->has('nombreNegocio') || $errors->has('contrasenaNegocio') || $errors->has('docUsuario') || $errors->has('nombreCompletoUsuario') || $errors->has('contrasenaUsuario'))
            // Mostrar formulario de registro
            document.getElementById('botonRegistro')?.click();
                // Si los errores son del negocio, activar el botón correspondiente
                @if ($errors->has('nitNegocio') || $errors->has('nombreNegocio') || $errors->has('contrasenaNegocio'))
                    setTimeout(() => {
                        document.querySelector('.boton-tipo-usuario[data-tipo="1"]')?.click();
                    }, 300);
                @else
                    setTimeout(() => {
                        document.querySelector('.boton-tipo-usuario[data-tipo="2"]')?.click();
                    }, 300);
                @endif
            @endif
        });
    </script>

    </div>
</body>
</html>
