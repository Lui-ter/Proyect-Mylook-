<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/inserccionProductos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>{{$modeValidator == 1 ? 'Editar Producto | Nombre Establecimiento':'Agregar Producto - MyLook'}}</title>
</head>
<body>

    <!-- SECCION DE TODO -->
    <section class="formProductos">

        <!-- ENCABEZADO -->
        <article class="encabezado">
            <h2 class="tittle">INFORMACION DE PRODUCTOS</h2>
        </article>

        <!-- FORMULARIO -->
        <form action="{{ $modeValidator == 1 
        ? route('updateProduct', ['id' => $producto['id_prod']]) 
        : route('registerProduct') }}" method="post" enctype="multipart/form-data" class="formulario">
        @csrf
        @method($modeValidator == 1 ? 'PUT' : 'POST')
            <!-- CONTENEDOR 1 - INPUTs -->
            <div class="cont1">

                <div class="inputs">
                    <label for="" class="inputLabel">Nombre del producto</label>
                    <input type="text" class="camposInput" name="nombre" value="{{$producto['nombre_prod'] ?? ''}}">

                    <label for="" class="inputLabel">Marca del producto</label>
                    <input type="text" class="camposInput" name="marca" value="{{$producto['nom_marca'] ?? ''}}">

                <div class="inputImg">
                    <label for="img" class="imgLabel">Seleccionar imagen</label>
                    <input type="file" class="camposInput imgInput" id="img" name="imagen">
                </div>         
                
                    <label for="" class="inputLabel">Descripción</label>
                    <textarea class="camposInput" maxlength="150" style="height: 20%;"  name="desc" value="{{$producto['desc_prod'] ?? ''}}"></textarea>
                </div>

                <!-- INPUT NUMBER -->
                <div class="num">
                        <div class="inputsNum">
                            <label for="" class="inputText">Cantidad</label>
                            <input type="number" class="inputValor" min="0" name="cantidad" value="{{$producto['stock'] ?? ''}}">
                        </div>

                        <div class="inputsNum">
                            <label for="" class="inputText">Valor</label>
                            <input type="number" class="inputValor" min="0" name="valor" value="{{$producto['valor_prod'] ?? ''}}">
                        </div>
            
                </div>
                <!-- BOTONES -->
                <span class="botones">
                    <label for="" class="texto">Completa todos los campos</label>
                    <button type="button" class="btn" id="cancelar" onclick="window.history.back();">CANCELAR</button>
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
                        <img id="vistaImg" src="{{$producto['img_prod'] ?? ''}}"
                        style="border-radius: 10px;
                        border: 1px solid #a68160;
                        justify-content: center;
                        object-fit: contain;
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

    <script src="/Js/Insercciones/inserccionProductos.js"></script>
    
</body>
</html>