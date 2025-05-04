<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Form/registerStaff.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto+Slab:wght@400&display=swap"
        rel="stylesheet">
    <title>Register Staff - MiNegocio</title>
</head>

<body>
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
                    <p class="nombreInput">DOCUMENTO DE IDENTIFICACION </p>
                    <input type="text" id="Id" name="documentoStaff" value="{{ $usuario->id_usuario ?? '' }}"
                        placeholder="Ingrese documento de identificacion..." required />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE NOMBRE</p>
                    <input type="text" id="nombre" name="nombreCompletoStaff"
                        value="{{ $usuario->nombre ?? '' }}" placeholder="Ingresa nombre...." required />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE APELLIDO</p>
                    <input type="text" id="apellido" name="apellidoStaff"
                        value="{{ $usuario->apellido ?? '' }}" placeholder="Ingresa apellido...." required />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE CONTRASEÑA</p>
                    <div class="passwordContainer">
                        <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa contraseña...."
                            required />
                        <span id="togglePassword">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE CORREO</p>
                    <input type="email" id="correo" name="correoStaff" value="{{ $usuario->correo ?? '' }}"
                        placeholder="Ingresa correo...." required />
                </div>



                <div class="infoInput">
                    <p class="nombreInput">INGRESE TELEFONO</p>
                    <input type="number" id="telefono" name="telefonoStaff" value="{{ $usuario->telefono ?? '' }}"
                        placeholder="Ingresa telefono...." required />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">Rol:</p>
                    <select name="tipoRol" id="tipoRol" required>
                        <option value="0">Tipo:</option>
                        @foreach ($roles as $rol)
                            @if (strtolower($rol->nombre_rol) !== 'admin')
                                <option value="{{ $rol->id_rol }}"
                                    {{ isset($staff) && $staff->id_rol == $rol->id_rol ? 'selected' : '' }}>
                                    {{ $rol->nombre_rol }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <div class="infoInput">
                    <p class="nombreInput">Imagen del Staff:</p>
                    <label for="imagenServicio" class="fileUploadLabel">Subir imagen</label>
                    <input type="file" id="imagenServicio" name="imagenStaff"
                        src="{{ $imgBase64 ?? '/descarga (3).png' }}" accept="image/jpeg, image/png"
                        class="fileUploadInput" {{ isset($staff) ? '' : 'required' }} />
                </div>

            </section>

            <section class="columnaDos">

                <div class="contenedorCard">
                    <h2 class="tituloPrevisualizacion">Previsualización de ficha Staff</h2>
                    <div class="card">
                        <figure class="cardImg">
                            <img id="imagenPrevisualizacion" src="{{ $imgBase64 ?? asset('/descarga (3).png') }}" alt="Imagen del staff" />
                        </figure>
                        <div class="cardText">
                            <h3>Nombre:</h3>
                            <p id="nombrePrevisualizacion">-</p>
                            <h3>Apelldio:</h3>
                            <p id="apellidoPrevisualizacion">-</p>
                            <h3>Documento de Identificación:</h3>
                            <p id="idPrevisualizacion">-</p>
                            <h3>Teléfono:</h3>
                            <p id="telefonoPrevisualizacion">-</p>
                            <h3>Correo:</h3>
                            <p id="correoPrevisualizacion">-</p>
                            <h3>Rol:</h3>
                            <p id="rolPrevisualizacion">-</p>
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
</body>

</html>
