<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Form/registerStaff.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto+Slab:wght@400&display=swap"
        rel="stylesheet">
    <title>Registrar staff</title>
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
        <h2 class="tituloPrincipal">REGISTRO DE STAFF</h2>
        <section>
            <p class="paginaDescripcion">
                En este apartado podrás agregar a un miembro de STAFF a tu establecimiento. Esto te permitirá
                registrarlo en la base de datos de tu establecimiento.
            </p>
        </section>

        <form action="{{ isset($staff) ? route('updateStaff', ['id' => $staff->id_staff]) : route('registerStaff') }}"
            method="POST" class="contenedorForm" enctype="multipart/form-data" onsubmit="handleValidationStaff(event)">
            @csrf
            @if (isset($staff))
                @method('PUT')
            @endif
            <input type="hidden" name="editStaff" value="{{ $staff->id_usuario ?? '' }}">

            <section class="columnaUno">

                <div class="infoInput">
                    <p class="nombreInput">DOCUMENTO</p>
                    <input type="text" id="Id" name="documentoStaff" value="{{ $usuario->id_usuario ?? '' }}" />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">NOMBRE</p>
                    <input type="text" id="nombre" name="nombreCompletoStaff" value="{{ $usuario->nombre ?? '' }}" />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">APELLIDO</p>
                    <input type="text" id="apellido" name="apellidoStaff" value="{{ $usuario->apellido ?? '' }}" />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">CONTRASEÑA</p>
                    <div class="passwordContainer">
                        <input type="password" id="contrasena" name="contrasena" />
                        <span id="togglePassword">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="infoInput">
                    <p class="nombreInput">CORREO</p>
                    <input type="email" id="correo" name="correoStaff" value="{{ $usuario->correo ?? '' }}" />
                </div>



                <div class="infoInput">
                    <p class="nombreInput">TELEFONO</p>
                    <input type="number" id="telefono" name="telefonoStaff" value="{{ $usuario->telefono ?? '' }}" />
                </div>


            </section>

            <section class="columnaDos">
                <div class="fila-input-grid">
                    <div class="infoInput">
                        <p class="nombreInput">ROL</p>
                        <select name="tipoRol" id="tipoRol">
                            <option value="0">Tipo:</option>
                            @foreach ($roles as $rol)
                                @if (strtolower($rol->nombre_rol) !== 'admin')
                                    <option value="{{ $rol->id_rol }}" {{ isset($staff) && $staff->id_rol == $rol->id_rol ? 'selected' : '' }}>
                                        {{ $rol->nombre_rol }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="infoInput">
                        <p class="nombreInput">IMAGEN</p>
                        <label for="imagenServicio" class="fileUploadLabel">Subir imagen</label>
                        <input type="file" id="imagenServicio" name="imagenStaff"
                            src="{{ $imgBase64 ?? '/descarga (3).png' }}" accept="image/jpeg, image/png"
                            class="fileUploadInput" />
                    </div>
                </div>

                <div class="contenedorCard">
                    <div class="card">
                        <figure class="cardImg">
                            <img id="imagenPrevisualizacion" src="{{ $imgBase64 ?? asset('/descarga (3).png') }}"
                                alt="Imagen del staff" />
                        </figure>
                        <div class="cardText">

                            <div class="fila-input">
                                <h3>Nombre:</h3>
                                <p id="nombrePrevisualizacion"></p>
                            </div>
                            <div class="fila-input">
                                <h3>Apellido:</h3>
                                <p id="apellidoPrevisualizacion"></p>
                            </div>
                            <div class="fila-input">
                                <h3>Documento:</h3>
                                <p id="idPrevisualizacion"></p>
                            </div>
                            <div class="fila-input">
                                <h3>Teléfono:</h3>
                                <p id="telefonoPrevisualizacion"></p>
                            </div>
                            <div class="fila-input">
                                <h3>Correo:</h3>
                                <p id="correoPrevisualizacion"></p>
                            </div>
                            <div class="fila-input">
                                <h3>Rol:</h3>
                                <p id="rolPrevisualizacion"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="botonSubmit">
                    <button type="submit" class="btnStartSession" name="crearStaff">
                        {{ isset($staff) ? 'Actualizar' : 'Registrar' }}
                    </button>
                </div>
            </section>
        </form>
    </main>
    <script src="/Js/Staff/registerStaff.js"></script>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>


</body>

</html>