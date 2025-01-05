<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Styles/Staff/regsiterStaff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto+Slab:wght@400&display=swap" rel="stylesheet">
    <title>Register Staff - MiNegocio</title>
</head>
    
<body>
    <section class="containerfatherRegister">
        <article class="formstaffRegister">
            <form action="../php/registerStaff.php" method="POST" class="formStaff">
                <h2 id="titleRegister">R E G I S T R A R</h2>
                <div class="formContainer">
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="documentoStaff" class="inputText" placeholder="Documento de Identidad" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="nombreCompletoStaff" class="inputText" placeholder="Nombre Completo" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="telefonoStaff" class="inputText" placeholder="Teléfono" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="correoStaff" class="inputText" placeholder="Correo Electrónico" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="direccionStaff" class="inputText" placeholder="Dirección" required>
                        </div>
                    </div>
                    <div class="formGroup">
                        <div class="inputWithIcon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="contrasenaStaff" class="inputText" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <button type="submit" class="btnStartSession" name="crearStaff">Registrar</button>
                </div>
            </form>
        </article>
        <aside class="containerinfoRegister">
            <div id="introRegister">
                <div class="InfoRigth">
                    <div class="line line-1"></div>
                    <div class="line line-2"></div>
                    <div class="line line-3"></div>
                    <div class="line line-4"></div>
                    <div class="line line-5"></div>
                    <div class="line line-6"></div>
                    <div class="logoSTA">
                        <i class="fas fa-lightbulb"></i>
                        <h2>STA</h2>
                    </div> 
                    <div class="MYLOOK">
                        <h3>Bienvenido A La Familia</h3>
                        <h1>MYLOOK</h1>
                        <div class="promotion">
                            <p>"Acompáñanos en la misión<br>
                                 de embellecer la vida de nuestros clientes, creando experiencias únicas y memorables".
                            </p>
                        </div> 
                    </div>
                    
                </div>
            </div>
        </aside>
    </section>
    
</body>
</html>
