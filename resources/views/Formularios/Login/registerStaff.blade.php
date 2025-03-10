<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Form/registerStaff.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto+Slab:wght@400&display=swap" rel="stylesheet">
    <title>Register Staff - MiNegocio</title>
</head>
    
<body>
    <main>
        <h2 class="tituloPrincipal">REGISTRO DE STAFF</h2>
        <section>
            <p class="paginaDescripcion">
                En este apartado podrás agregar a un miembro de STAFF a tu establecimiento. Esto te permitirá registrarlo en la base de datos de tu establecimiento.
            </p>
        </section>

        <form action="{{ route('registerStaff') }}" method="POST"  class="contenedorForm" >
            @csrf

            <section class="columnaUno">

                <div class="infoInput">
                    <p class="nombreInput">DOCUMENTO DE IDENTIFICACION </p>
                    <input
                        type="text"
                        id="Id"
                        name="documentoStaff"
                        placeholder="Ingrese documento de identificacion..."
                        required
                    />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE NOMBRE</p>
                    <input
                        type="text"
                        id="nombre"
                        name="nombreCompletoStaff"
                        placeholder="Ingresa nombre...."
                        required
                    />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE CONTRASEÑA</p>
                    <div class="passwordContainer">
                        <input
                            type="password"
                            id="contrasena"
                            name="contrasena"
                            placeholder="Ingresa contraseña...."
                            required
                        />
                        <span id="togglePassword">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>
                    </div>
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE CORREO</p>
                    <input
                        type="email"
                        id="correo"
                        name="correoStaff"
                        placeholder="Ingresa correo...."
                        required
                    />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE DIRECCIÓN</p>
                    <input
                        type="text"
                        id="direccion"
                        name="direccionStaff"
                        placeholder="Ingresa dirección...."
                        required
                    />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">INGRESE TELEFONO</p>
                    <input
                        type="number"
                        id="telefono"
                        name="telefonoStaff"
                        placeholder="Ingresa telefono...."
                        required
                    />
                </div>

                <div class="infoInput">
                    <p class="nombreInput">Rol:</p>
                    <select name="tipoRol" id="tipoRol" required>
                        <option value="0">Tipo:</option>
                        <option value="1">Barbero</option>
                        <option value="2">Administrador</option>
                        <option value="3">Estilista</option>
                    </select>
                </div>

                <div class="infoInput">
                    <p class="nombreInput">Imagen del Staff:</p>
                    <label for="imagenServicio" class="fileUploadLabel">Subir imagen</label>
                    <input
                        type="file"
                        id="imagenServicio"
                        name="imagenServicio"
                        accept="image/jpeg, image/png"
                        class="fileUploadInput"
                        required
                    />
                </div>

            </section>

            <section class="columnaDos">

                <div class="contenedorCard">
                    <h2 class="tituloPrevisualizacion">Previsualización de ficha Staff</h2>
                    <div class="card">
                        <figure class="cardImg">
                            <img id="imagenPrevisualizacion" src="./descarga (3).png" alt="" />
                        </figure>
                        <div class="cardText">
                            <h3>Nombre:</h3>
                            <p id="nombrePrevisualizacion">-</p>
                            <h3>Documento de Identificación:</h3>
                            <p id="idPrevisualizacion">-</p>
                            <h3>Teléfono:</h3>
                            <p id="telefonoPrevisualizacion">-</p>
                            <h3>Correo:</h3>
                            <p id="correoPrevisualizacion">-</p>
                            <h3>Dirección:</h3>
                            <p id="direccionPrevisualizacion">-</p>
                            <h3>Rol:</h3>
                            <p id="rolPrevisualizacion">-</p>
                        </div>
                    </div>
                </div>
                <div class="botonSubmit">
                    <button type="submit" class="btnStartSession" name="crearStaff">Registrar</button>
                </div>
            </section>
        </form>
    </main>
    <script src="script.js"></script>
</body>
</html>