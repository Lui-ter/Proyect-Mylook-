<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet"  href="{{ asset('Css/Config/configAdmin.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Configuracion</title>
</head>
<body>

    <section class="configAdmi">

        <aside class="navConfig">

            <figure class="imgContainer">
                <form action="" method="POST"  enctype="multipart/form-data">
                    <img src="data:image/png;base64,{{ $fotoAdmin }}" alt="Foto del administrador" class="imgPerfil" id="profileImage">
                    <label for="fileInput" class="changePhotoButton">
                    <i class="fa fa-camera"></i>
                    </label>
                    <input type="file" name="imgPerfil" id="fileInput" accept="image/*" style="display: none;"  enctype="multipart/form-data">
                </form>
              </figure>

              <nav class="navOptions">
                <ul class="listaNav">
                    <button type="button" class="optionNav" data-target=".configPerfil">Configurar Perfil</button>
                    <button type="button" class="optionNav" data-target=".configEstablecimiento">Configurar Establecimiento</button>
                    <button type="button" class="optionNav" data-target=".configCuenta">Configurar Cuenta</button>
                    <button type="button" class="optionNav" data-target=".cerrarSesion">Cerrar Sesión</button>
                </ul>
            </nav>

            <span class="nomApp">
                <h1 class="tittle">MYLOOK</h1>
            </span>

        </aside>

        <article class="optionsConfig">

<!--            FORMUALRIO QUE SE VISUALIZA UNA VEZ SE ENTRA A CONFIGURAR EL INDEX ADMIN -->
            <form action="" method="POST" class="seccionDefault" id="seccionDefault"  enctype="multipart/form-data">
                @csrf

                <section class="defaultIntroduccion">

                <article class="introduccionConfig">
                    <span class="tittleIntroduccion">
                        <h2 class="nomConfig">Configuración de MiNegocio</h2>
                        <p class="descripConfig">En este apartado podras ilustar tu negocio
                            y comercializar tus productos para entrar a la familia MyLook.
                        </p>
                    </span>
                </article>

                <articles class="infoConfig">
                    <ul class="passConfig">
                        <li class="passUnited">Configurar perfil administrador</li>
                        <li class="passUnited">Configurar perfil del establecimiento</li>
                        <li class="passUnited">Configuracion de cuenta</li>
                        <li class="passUnited">Configuracion de la imagen de presentacion</li>
                        <li class="passUnited">Configuracion del logo de negocio</li>
                        <li class="passUnited">Configuracion de foto de perfil admin</li>
                    </ul>
                </articles>

                <article class="notaConfig">
                    <p class="tittleNota"><strong>Consejo:</strong> Los registros que se hagan en este apartado seran reflejados en las interfaz
                    en las que interactuar los usuarios recomendiacion toamrse serio el proceso de comercializacion de tu establecimiento </p>
                </article>

                <article class="btnCrud">
                    <div class="groupBtn">
                        <button type="submit" class="btnCrud btnSave">Continuar</button>
                    </div>
                </article>
            </section>

            </form>

<!--             FORMULARIO DONDE SE PUEDE EDITAR LA INFORMACION DEL PERFIL DEL ADMINISTRADOR -->
            <form action="" method="POST" class="configPerfil" id="configPerfil"  enctype="multipart/form-data"  style="display: none;">
                @csrf

                <label for="" class="nomForm">
                    <h3 class="tittleForm">Configuración del perfil administrador</h3>
                    <p class="descripConfig">Bienvenido al panel de Configuración del administrador donde
                        podras cambiar tus datos personales cuando desees y estar actalizado.
                    </p>
                </label>

                <article class="datosUnico">
                        <label for="" class="labelInput">Documento</label>
                        <input type="text" class="inputDocumento" name="docuAdmin" value="{{ $usuarioAdmin->id_usuario }}" readonly>
                </article>

                <article class="datosPersonales">
                    <div class="groupInputs">
                        <label for="" class="labelInput">Nombre</label>
                        <input type="text" class="inputNombre" name="nombreAdmin" value="{{ $usuarioAdmin->nombre }}">
                    </div>

                    <div class="groupInputs">
                        <label for="" class="labelInput Apellido">Apellido</label>
                        <input type="text" class="inputApellido" name="apellidoAdmin" value="{{ $usuarioAdmin->apellido }}">
                    </div>
                </article>

                <article class="datosContact">
                        <label for="" class="labelInput">Correo</label>
                        <input type="text" class="inputCorreo" name="correoAdmin" value="{{ $usuarioAdmin->correo }}">

                        <label for="" class="labelInput">Telefono</label>
                        <input type="text" class="inputTelefono" name="TelefonoAdmin" value="{{ $usuarioAdmin->telefono }}">
                </article>

                <article class="btnCrud">
                    <div class="groupBtn">
                        <button type="submit" class="btnCrud" onclick="window.history.back();">Cancelar</button>
                        <button type="submit" class="btnCrud btnSave">Guardar</button>
                    </div>
                </article>

            </form>

<!--             FORMULARIO DONDE SE PUEDE EDITAR LA INFORMACION DEL PERFIL DEL ESTABLECIMIENTO -->
            <form action="" method="POST" class="configEstablecimiento" id="configEstablecimientotyle"  enctype="multipart/form-data" style="display: none;">
                @csrf

                <label for="" class="nomForm">
                    <h3 class="tittleForm">Configuración del establecimiento</h3>
                    <p class="descripConfig">Bienvenido al panel de Configuración del establecimiento donde
                        podras cambiar los datos personales de la sede cuando desees y estar actalizado.
                    </p>
                </label>

                <article class="datosNumericos">
                    <label for="" class="labelInputEstablecimiento">Identificacion del negocio</label>
                    <input type="text" class="inputId" name="idNegocio" value="{{ $establecimiento->id_establc }}" readonly>
                </article>

                <article class="datosShearch">
                    <div class="groupInputs">
                        <label for="" class="labelInputEstablecimiento">Nombre</label>
                        <input type="text" class="inputNombre" name="nombreEstablecimiento" value="{{ $establecimiento->nombre_establc }}">
                    </div>

                    <div class="groupInputs">
                        <label for="" class="labelInputEstablecimiento">Dirección</label>
                        <input type="text" class="inputDireccion" name="direccionEstablecimiento" value="{{ $establecimiento->ubicacion }}">
                    </div>
                </article>

                <article class="datosDescriptivos">

                    <label for="" class="labelInputEstablecimiento">Descripción</label>
                    <textarea name="descripEstablecimiento" id="" cols="30" rows="10" class="inputDescripcion">{{ $establecimiento->desc_establc }}</textarea>

                </article>

                <article class="datosTel">

                    <label for="" class="labelInputEstablecimiento">Telefono</label>
                    <input type="text" class="inputTel" name="telefonoEstablecimiento" value="{{ $establecimiento->telefono }}">

                </article>

                <article class="datosEmail">

                    <label for="" class="labelInputEstablecimiento">Correo</label>
                    <input type="text" class="inputEmail" name="correoEstablecimiento" value="{{ $establecimiento->correo }}">

                </article>


                <article class="btnCrud">
                    <div class="groupBtn">
                        <button type="submit" class="btnCrud">Cancelar</button>
                        <button type="submit" class="btnCrud btnSave">Guardar</button>
                    </div>
                </article>

            </form>

<!--             FORMULARIO DONDE SE PUEDE EDITAR LA INFORMACION DEL PERFIL DEL NEGOCIO ( ESTO SOLO PDRA SER EDITADO SI EL ADMIN LIDER INICIE SESION ) -->
            <form action="" method="POST" class="configCuenta" id="configCuenta" style="display: none;"  enctype="multipart/form-data">>
                @csrf


                <article class="imgsNegocio">

                    <figure class="imgPresentacion">
                        <img src="data:image/jpeg;base64,{{ $imgPortada }}" alt="imagen presentacion" class="presentacion">

                        <div class="inputPresentacion">
                            <label for="fileInput" class="redirectEditar">
                                <span class="nomEditar">Editar</span>
                                <i class="fas fa-arrow-right-from-bracket"></i>
                            </label>
                            <input type="file" id="fileInput" name="imgPresentacion" class="input-file-hidden" accept="image/*">
                        </div>
                    </figure>

                    <figure class="imgLogo">
                        <p class="fechCreacion"><strong>Fecha creación:</strong> 28 novimenbre 2023 </p>
                        <img src="data:image/jpeg;base64,{{ $imgPerfil }}"  name="imgLogo" alt="imagen logo" class="logo">
                    </figure>

                </article>

                <article class="infoNegocio">
                    <label for="" class="labelInputNegocio">Identificacion</label>
                    <input type="text" class="inputId" name="idNegocio" value="{{ $negocio->id_negocio }}" readonly>
                </article>

                <article class="infoPublica">
                    <label for="" class="labelInputNegocio">Nombre</label>
                    <input type="text" class="inputNombre" name="nombreNegocio" value="{{ $negocio->nombre_negocio }}">
                </article>

                <article class="infoDesciptiva">
                    <label for="" class="labelInputNegocio">Descripción</label>
                    <textarea name="descripcionNegocio" id="" class="inputDescrip">{{ $negocio->desc_negocio }}</textarea>
                </article>

                <article class="infoPrivada">
                    <label for="" class="labelInputNegocio">Administrador Lider</label>
                    <input type="text" class="inputLider" name="nombreAdmin" value="{{ $usuarioAdmin->nombre .' '. $usuarioAdmin->apellido }}" readonly>
                </article>



                <article class="btnCrud">
                    <div class="groupBtn">
                        <button type="submit" class="btnCrud">Cancelar</button>
                        <button type="submit" class="btnCrud btnSave">Guardar</button>
                    </div>
                </article>

            </form>

        </article>

    </section>

    <script src="{{ asset ('Js/Admin/configBienvenidaAdmin.js') }}"></script>

</body>
</html>
