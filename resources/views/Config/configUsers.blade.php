<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Css/Config/configUsuarios.css') }}">
    <title>Configuracion Usuarios - MYLOOK</title>
</head>
<body>
    
    <section class="contenedorPadre">

        <div class="containerPerfil">
            <!-- Imagen de perfil -->
            <figure>
                <form action="" method="POST"  enctype="multipart/form-data">
                <img id="profileImage" src="" alt="" class="imgPerfil">
                 <!-- Ícono de la cámara -->
            <label for="fileInput" class="camera-icon">
                <i class="fas fa-camera"></i>
            </label>
            
            <!-- Input de archivo oculto -->
            <input type="file" id="fileInput" class="file-input" accept="image/*" onchange="updateProfileImage(event)">
                </form>
            </figure>
        </div>

        <form action="" method="POST" class="formConfig"  enctype="multipart/form-data">
            @csrf
            <div class="groupInput datosNumericos">
                <label for="" class="nomLabel">Documento</label>
                <input type="text" name="nombre" id="documentoUsuario" class="inputForm" placeholder="123456789">
            </div>

            <div class="datosPersonales">
                <div class="groupInput containerPersonal">
                    <label for="" class="nomLabel">Nombre</label>
                    <input type="text" name="nombre" id="nombreUsuario"class="inputForm" placeholder="Alejandro">
                </div>

                <div class="groupInput containerPersonal">
                    <label for="" class="nomLabel">Apellido</label>
                    <input type="text" name="apellidoUsuario" id="nombre"class="inputForm" placeholder="Aguilon Buitrago">
                </div>
            </div>
            <div class="groupInput datosContactos">
                <label for="" class="nomLabel">Telefono</label>
                <input type="text" name="telefonoUsuario" id="nombre" class="inputForm" placeholder="+57 444-444-4444">
            </div>
            <div class="groupInput datosEmail">
                <label for="" class="nomLabel">Correo</label>
                <input type="text" name="correoUsuario" id="nombre" class="inputForm" placeholder="aaguilon@misena.edu.co">
            </div>   
            <div class="groupInput condicionUser">
                <label for="" class="nomLabel">Condicion</label>
                <textarea name="" id="condicionUsuario" class="inputForm" placeholder="Tengo una alergia producto a los quimicos que contienen los tintes..."></textarea>
            </div> 
            
            <div class="btnSend">
                <button type="submit" class="btnSave" id="btnSend">Guardar Cambios</button
                ><button type="submit" class="btnSave">Cancelar</button>
            </div>
        </form>

    </section>

    <script src="/Js/Usuarios/configUsuario.js"></script>

</body>
</html>