<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../Js/pcLogin.js"></script>
    
    <link rel="stylesheet" href="{{asset('Css/Form/formLoginPrincipal.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Inicio de sesión | MyLook</title>
</head>
<body>

    <section class="contenedorMobile"> <!-- SOLO PARA MOBILES -->
        <article class="iniciarLogin">   
            <div class="logoSta">
                <span class="iconoDesarrolladores"> <i class="far fa-lightbulb icon"></i></span>
                <h3 class="nomDesarrolladores">STA</h3>
            </div>

            <span class="informacionForm">
                <h3 class="welcome">Bienvenido a</h3>
                <h1 class="tittleApp">MYLOOK</h1>
            </span>

            <div class="activadorForm">
                <div class="btn">
                    <button type="submit" class="startSesionBtn">INICIAR SESION</button>
                    <span class="registerSesionBtn">¿ No tienes cuenta aun ? <a class="link-register" href="http://">Regsitrate Aqui.</a></span>
                </div>
            </div>
            <span class="cabecera"><p>></p></span>
        </article> <!-- PRIMERA ENTRADA DE BOTONES A MANEJAR EN MOBILE -->
        <article class="registerSesion login">

                <span class="tipUsuarios">
                    <button type="submit" class="Btn" id="formRegisterUsuario">Usuario</button>
                    <button type="submit" class="Btn" id="formRegisterEstablecimiento">Establecimiento</button>
                </span>

                <!-- REGISTRAR ESTABLECIMIENTO -->
                <form action="" method="post" class="registerEstablecimiento" style="display: none;" onsubmit="handleValidationRegister(event)">
                    <div class="groupInput">
                        <i class="fas fa-building"><input type="number" class="inputRegister" name="nitNegocio" id="nitNegocio" placeholder="Ingrese nitEmpresarial..."></i></i>
                    </div>
                    <div class="groupInput">
                        <i class="fas fa-user"><input type="text" class="inputRegister" name="nombreNegocio" id="nombreNegocio" placeholder="Ingrese nombre establecimiento..."></i></i>
                    </div>
                    <div class="groupInput">
                    <i class="fas fa-lock"><input type="password" class="inputRegister" name="contrasenaNegocio" id="contrasenaNegocio" placeholder="Ingrese contraseña..."></i>
                    </div>
                    <div class="groupInput">
                        <div class="recuerdame">
                            <input type="checkbox" value="1">
                            <p>Recuerdame</p>
                        </div>
                    </div>
                    <button type="submit" class="btnRegisterEstablecimiento">Registrar Establecimiento</button>
                    <div class="socialMedia">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-whatsapp"></i>
                        <i class="fab fa-telegram"></i>
                        <i class="fab fa-google"></i>
                    </div>                    
                </form>

                <!-- REGISTRAR USUARIO -->
                <form action="" method="post" class="registerUsuario" onsubmit="handleValidationRegister(event)">
                    <div class="groupInput">
                        <i class="fas fa-file-alt"><input type="number" class="inputRegister" name="documentoUsuario" placeholder="Ingrese documento..."></i></i>
                    </div>
                    <div class="groupInput">
                        <i class="fas fa-user"><input type="text" class="inputRegister" name="nombreUsuario" placeholder="Ingrese nombre completo..."></i></i>
                    </div>
                    <div class="groupInput">
                    <i class="fas fa-lock"><input type="password" class="inputRegister" name="passwordUsuario" placeholder="Ingrese contraseña..."></i>
                    </div>
                    <div class="groupInput">
                        <div class="recuerdame">
                            <input type="checkbox" value="1">
                            <p>Recuerdame</p>
                        </div>
                    </div>
                    <button type="submit" class="btnRegisterUsuario">Registrar Usuario</button>
                    <div class="socialMedia">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-whatsapp"></i>
                        <i class="fab fa-telegram"></i>
                        <i class="fab fa-google"></i>
                    </div>
                </form>
        </article> <!-- REGISTRAR PERFIL -->
        <article class="iniciarSesion login">
            <span class="tipUsuarios">
                <button type="submit" class="Btn" id="formStartUsuario">Usuario</button>
                <button type="submit" class="Btn" id="formStartEsatblecimiento">Establecimiento</button>
            </span>
            
                <!-- INICIAR SESION ESTABLECIMIENTO -->
                <form action="" method="post" class="StartEstablecimiento" style="display: none;">
                <div class="groupInput">
                    <i class="fas fa-building"><input type="number" class="inputStart" name="nitNegocio" placeholder="Ingrese nitEmpresarial..."></i></i>
                </div>
                <div class="groupInput">
                <i class="fas fa-lock"><input type="password" class="inputStart" name="nombreNegocio" placeholder="Ingrese contraseña..."></i>
                </div>
                <div class="groupInput">
                    <div class="recuerdame">
                        <input type="checkbox" value="1">
                        <p>Recuerdame</p>
                    </div>
                    <a href="http://" class="olvidoContraseña">¿ Olvido su contraseña ?</a>
                </div>
                <button type="submit" class="btnStartEstablecimiento">Iniciar Sesion</button>
                <div class="socialMedia">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-whatsapp"></i>
                    <i class="fab fa-telegram"></i>
                    <i class="fab fa-google"></i>
                </div>
            </form>

            <!-- INICIAR SESION USUARIO -->
            <form action="" method="post" class="StartUsuario">
                <div class="groupInput">
                    <i class="fas fa-file-alt"><input type="number" class="inputStart" name="documentoUsuario" placeholder="Ingrese documento..."></i></i>
                </div>

                <div class="groupInput">
                <i class="fas fa-lock"><input type="password" class="inputStart" name="passwordUsuario" placeholder="Ingrese contraseña..."></i>
                </div>
                <div class="groupInput">
                    <div class="recuerdame">
                        <input type="checkbox" value="1">
                        <p>Recuerdame</p>
                    </div>
                    <a href="http://" class="olvidoContraseña">¿ Olvido su contraseña ?</a>
                </div>
                <button type="submit" class="btnStartUsuario">Iniciar Sesion</button>
                <div class="socialMedia">
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-whatsapp"></i>
                    <i class="fab fa-telegram"></i>
                    <i class="fab fa-google"></i>
                </div>
            </form>
        </article>  <!-- LOGIN -->
    </section>

   
    <div class="contenedorPc"> <!-- SOLO PARA PC -->
        <div class="contenedor" id="contenedor">
            <div class="contenedor-formulario contenedor-registro">
                <form action="{{ route('registerUser') }}" method="POST" onsubmit="handleValidationRegister(event)">
                    @csrf
                    <div class="botones-tipo-usuario">
                        <button type="button" class="boton-tipo-usuario activo" data-tipo="1">Negocio</button>
                        <button type="button" class="boton-tipo-usuario" data-tipo="2">Usuario</button>
                        <input type="hidden" name="tipo_usuario" id="tipo_usuario" class="tipo_usuario">
                    </div>
                    <div class="campos-formulario campos-estudiante">
                        <div class="input-container">
                            <i class="fas fa-id-card"></i>
                            <input id="1" type="text" name="nitNegocio" placeholder="Ingrese su nit Empresarial..." required />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-user"></i>
                            <input id="2" type="text" name="nombreNegocio"  placeholder="Ingrese el nombre de negocio..." required />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-lock"></i>
                            <input id="3" type="password" name="contrasenaNegocio"  placeholder="Ingrese la contraseña del negocio..." required />
                        </div>
                    </div>
                    <div class="campos-formulario campos-profesor" style="display: none;">
                        <div class="input-container">
                            <i class="fas fa-id-card"></i>
                            <input id="4" type="text" name="docUsuario" id="documentoUsuario" placeholder="Ingrese su Documento..." required />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-user"></i>
                            <input id="5" type="text" name="nombreCompletoUsuario" id="nombreUsuario" placeholder="Ingrese su Nombre..." required />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-lock"></i>
                            <input id="7" type="password" name="contrasenaUsuario" id="passwordUsuario" placeholder="Ingrese su Contraseña..."required />
                        </div>
                    </div>
                    <button type="submit" name="accionRegistrar" value="registrar">Registrar</button>
                </form>
            </div>

            <div class="contenedor-formulario contenedor-inicio-sesion">
                <form action="{{ route('loginUser') }}" method="POST" onsubmit="handleValidationLogin(event)">
                    @csrf
                    <div class="botones-tipo-usuario">
                        <button type="button" class="boton-tipo-usuario activo" data-tipo="1">Usuario</button>
                        <button type="button" class="boton-tipo-usuario" data-tipo="2">Negocio</button>
                        <input type="hidden" name="tipo_usuario" class="tipo_usuario">
                    </div>
                    <div class="campos-formulario campos-estudiante">
                        <div class="input-container">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="documentoUsuario" placeholder="Ingrese su Documento..."  />
                        </div>
                        <div class="input-container">
                        
                            <i class="fas fa-lock"></i>
                            <input type="password" name="passwordUsuario" placeholder="Ingrese su Contraseña..."  />
                        </div>
                        <input type="hidden" name="rol" value="estudiante" />
                    </div>
                    <div class="campos-formulario campos-profesor" style="display: none;">
                        <div class="input-container">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="nitNegocio" id="10" placeholder=" Ingrese su nit Empresarial..."  />
                        </div>
                        <div class="input-container">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="contrasenaNegocio" id="10" placeholder="Ingrese su contraseña..."  />
                        </div>
                    
                    </div>
                    <a href="#" class="olvidaste-contraseña">¿Olvidaste tu contraseña?</a>
                    <button type="submit" name="accionIniciarSesion" value="iniciar_sesion">Iniciar Sesión</button>
                    
                </form>
            </div>
            <div class="contenedor-superposicion">
                <div class="superposicion">
                    <div class="panel-superposicion panel-izquierdo">
                        <h1>MYLOOK</h1>
                        <p>BIENVENIDO!</p>
                        <button  type="submit" class="fantasma" id="botonInicioSesion">Accede Ahora</button>
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
    <script src="{{asset('Js/Formularios/LoginPrincipal/logicLoginPrincipal.js')}}"></script>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
</body>
</html>