<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>FORMULARIO PRODUCTOS</title>
</head>
<body>

    <!-- SECCION DE TODO -->
    <section class="formProductos">

        <!-- ENCABEZADO -->
        <article class="encabezado">
            <h2 class="tittle">INFORMACION DE PRODUCTOS</h2>
        </article>

        <!-- FORMULARIO -->
<<<<<<< HEAD
        <form action="{{ route('registerProduct') }}" method="post" enctype="multipart/form-data" class="formulario" enctype="multipart/form-data">
        @csrf
=======
        <form action="" method="get" enctype="multipart/form-data" class="formulario">

>>>>>>> ae5c44a1378b5a9395ae342e0563883a972be5ca
            <!-- CONTENEDOR 1 - INPUTs -->
            <div class="cont1">

                <div class="inputs">
                    <label for="" class="inputLabel">Nombre del producto</label>
<<<<<<< HEAD
                    <input type="text" class="camposInput" name="nombre">

                    <label for="" class="inputLabel">Marca del producto</label>
                    <input type="text" class="camposInput" name="marca">

                <div class="inputImg">
                    <label for="img" class="imgLabel">Seleccionar imagen</label>
                    <input type="file" class="camposInput imgInput" id="img" name="imagen">
                </div>         
                
                    <label for="" class="inputLabel">Descripción</label>
                    <textarea class="camposInput" maxlength="150" style="height: 20%;" placeholder="Escribe aquí..." name="desc"></textarea>
=======
                    <input type="text" class="camposInput">

                    <label for="" class="inputLabel">Marca del producto</label>
                    <input type="text" class="camposInput">

                <div class="inputImg">
                    <label for="img" class="imgLabel">Seleccionar imagen</label>
                    <input type="file" class="camposInput imgInput" id="img">
                </div>         
                
                    <label for="" class="inputLabel">Descripción</label>
                    <textarea class="camposInput" maxlength="150" style="height: 20%;" placeholder="Escribe aquí..."></textarea>
>>>>>>> ae5c44a1378b5a9395ae342e0563883a972be5ca
                </div>

                <!-- INPUT NUMBER -->
                <div class="num">
                        <div class="inputsNum">
                            <label for="" class="inputText">Cantidad</label>
<<<<<<< HEAD
                            <input type="number" class="inputValor" min="0" name="cantidad">
=======
                            <input type="number" class="inputValor" min="0">
>>>>>>> ae5c44a1378b5a9395ae342e0563883a972be5ca
                        </div>

                        <div class="inputsNum">
                            <label for="" class="inputText">Valor</label>
<<<<<<< HEAD
                            <input type="number" class="inputValor" min="0" name="valor">
=======
                            <input type="number" class="inputValor" min="0">
>>>>>>> ae5c44a1378b5a9395ae342e0563883a972be5ca
                        </div>
                </div>
                <!-- BOTONES -->
                <span class="botones">
                    <label for="" class="texto">Completa todos los campos</label>
                    <button type="button" class="btn" id="cancelar">CANCELAR</button>
                    <button type="submit" class="btn" id="guardar">GUARDAR</button>
                </span>
            </div>

            </div>

            <!-- CONTENEDOR 2 - VISUALIZACION -->
            <div class="cont2">

                <h2 class="vista">VISUALIZACION</h2>

                <!-- CONTENEDOR - TARJETA -->
                <div class="tarjeta">
                    <div class="imagen">
                        <img id="vistaImg" src="/img/Iconos De Fotos.jpeg" 
                        style="border-radius: 10px;
                        border: 1px solid #a68160;
                        justify-content: center;
                        width: 100%;
                        height: 30vh;"> 
                    </div>

                    <!-- CONTENEDOR - DETALLES -->
                    <div class="detalles">
                        <h4 id="vistaNombre">Nombre</h4>
                        <p id="vistaDesc">Descripción: </p>
                    </div>
                </div>
            </div>

        </form>

    </section>

    <script src="producto.js"></script>
    
</body>
</html>