<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Form/loguinStaff.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Enlace a Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto+Slab:wght@400&display=swap" rel="stylesheet"><!--  Enlace de letras google -->
    <script src="../Js/Front/DOM/modulRegisterSatff.js"></script>
    <title>Login Staff - MYLOOK</title>
</head>
<body>
    <section class="containerfatherLogin">
        <aside class="imgContainer">
            <img class="imgpromotionStaff" src="../../../Asset/img1.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img2.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img3.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img4.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img5.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img1.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img2.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img3.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img4.jpeg">
            <img class="imgpromotionStaff" src="../../../Asset/img5.jpeg">
        </aside>
        <article class="formstaffLogin">
            <form action="../php/loginStaff.php" method="POST" class="formStaff">
                <h1 id="tittleLogin">MYLOOK</h1>
                <div class="formContainer">
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" class="inputText" id="documento" name="documento" placeholder=" Ingrese su documento..." required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="inputText" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña..." required>
                        </div>
                    </div>
                    <div class="link">
                        <a href="#">¿ Recuperar Contraseña ?</a>
                    </div>
                    <button type="submit" class="btnStartSession" name="inicioSesion">Iniciar Sesion</button>
                </div>
            </form>
        </article>
    </section>

    <script src="../../../DOM/loginStaff.js"></script>
</body>
</html>

