<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Form/registerAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto+Slab:wght@400&display=swap" rel="stylesheet">
    <title>Register Admin - MiNegocio</title>
</head>

<body>
    <section class="containerfatherRegister">
        <article class="formstaffRegister">
            <form action="#" method="POST" class="formStaff">
                <h2 id="titleRegister">ADMINISTRADOR</h2>
                <div class="formContainer">
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="documentoAdmin" class="inputText" placeholder="Documento de Identidad" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="nombreCompletoAdmin" class="inputText" placeholder="Nombre Completo" required>
                    </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="telefonoAdmin" class="inputText" placeholder="Teléfono" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="correoAdmin" class="inputText" placeholder="Correo Electrónico" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="contrasenaAdmin" class="inputText" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <button type="submit" class="btnStartSession">Registrar</button>
                </div>
            </form>
        </article>
        <aside class="containerinfoRegister">
            <div id="introRegister">
                <div class="InfoRigth">
                    <div class="solicitud">
                        <h2 id="imgPerfil">Por favor seleccione su imagen de perfil</h2>
                    </div>
                        <div class="imagePreview">
                            <img id="previewImg" src="../../../formServicios/Asset/Img/imgDefecto.png" alt="Vista previa de la imagen">
                        </div>
                        <div class="importFile">
                            <input type="file" id="imageUpload" accept="image/*" onchange="previewImage(event)">
                            <button class="upload-btn" onclick="document.getElementById('imageUpload').click()">Seleccionar imagen</button>
                        </div>
                    </div>
                </div>
        </aside>
    </section>

    <script src="../../../DOM/registerAdmin.js"></script>

</body>
</html>
