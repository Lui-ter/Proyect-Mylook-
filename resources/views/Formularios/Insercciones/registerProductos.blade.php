<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/inserccionProductos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>{{ isset($producto) ? 'Editar Producto | MyLook' : 'Agregar Producto - MyLook' }}</title>
</head>
<body>
    <main>

        <!-- FORMULARIO -->
        <form action="{{ isset($producto) ? route('updateProduct', ['id' => $producto->id]) : route('registerProduct') }}" 
              method="POST" enctype="multipart/form-data" class="formulario-productos">
            @csrf
            @if(isset($producto))
                @method('PUT')
            @endif

            <!-- CONTENEDOR PREVISUALIZACIÓN -->
            <div class="contenedor-carta">

                <!-- CONTENEDOR DE LA IMAGEN -->
                <div class="imagen-carta">
                    <img id="imagenVisualizacion" src="{{ $producto->imagen ?? '' }}">
                </div>

                <!-- CONTENEDOR DETALLES -->
                <div class="detalles-carta">
                    <h4 id="previewNombre" class="nombre-vista">{{ $producto->nombre ?? 'NOMBRE' }}</h4>
                    <p id="previewDescripcion" class="descripcion-vista">{{ $producto->descripcion ?? 'Descripción...' }}</p>
                    <div class="componentes">
                        <div class="componentes-titulos">
                            <p class="titulo-detalles">MARCA</p>
                            <p class="titulo-detalles">CANTIDAD</p>
                            <p class="titulo-detalles">VALOR</p>
                        </div>
                        <div class="componentes-titulos">
                            <p class="elementos">{{ $producto->marca ?? '' }}</p>
                            <p class="elementos">{{ $producto->cantidad ?? '' }}</p>
                            <p class="elementos">{{ $producto->valor ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENEDOR DE INSERCIÓN DE INFORMACIÓN -->
            <div class="contenedor-informacion">

                <!-- TITULO -->
                <h2 class="titulo">INFORMACION DE PRODUCTOS</h2>

                <!-- DESCRIPCIÓN BREVE SOBRE LA FUNCIÓN DEL FORMULARIO -->
                <p class="introduccion">En este apartado podrás ingresar la información de todos tus productos</p>

                <!-- CONTENEDOR DE CADA INPUT -->
                <div class="contenedor-input">

                    <!-- TITULO DE CADA INPUT -->
                    <p class="texto-input">NOMBRE DEL PRODUCTO</p>

                    <!-- INPUT NOMBRE -->
                    <input type="text" name="nombre" class="insercion-input" id="nombreProducto" maxlength="20" value="{{ $producto->nombre ?? '' }}">
                </div>

                <!-- CONTENEDOR DOBLE COLUMNA (MARCA - IMAGEN - CANTIDAD - VALOR) -->
                <div class="doble-columna">

                    <!-- CONTENEDOR DE CADA INPUT -->
                    <div class="contenedor-input">

                        <!-- TITULO DE CADA INPUT -->
                        <p class="texto-input">MARCA DEL PRODUCTO</p>

                        <!-- INPUT MARCA -->
                        <input type="text" name="marca" class="insercion-input" id="marcaProducto" maxlength="15" value="{{ $producto->marca ?? '' }}">
                    </div>

                    <!-- CONTENEDOR PARA INSERCION DE IMAGEN -->
                    <div class="contenedor-foto">

                        <!-- TITULO PARA IMAGEN -->
                        <label for="insercion-imagen" class="foto-input">

                            <!-- ICONO DE CAMARA -->
                            <i class="bi bi-camera icono"></i>

                            <!-- TEXTO -->
                            <span class="texto-input imagen-input">SELECCIONA LA IMAGEN</span>
                        </label>

                        <!-- INPUT PARA LA SELECCION DE FOTO -->
                        <input type="file" name="imagen" class="input-foto" id="insercion-imagen" accept="image/*">
                    </div>

                    <!-- CONTENEDOR DE CADA INPUT -->
                    <div class="contenedor-input">

                        <!-- TITULO DE CADA INPUT -->
                        <p class="texto-input">CANTIDAD DEL PRODUCTO</p>

                        <!-- INPUT CANTIDAD -->
                        <input type="number" name="cantidad" class="insercion-input" id="cantidadProducto" min="0" max="100" value="{{ $producto->cantidad ?? '' }}">
                    </div>

                    <!-- CONTENEDOR DE CADA INPUT -->
                    <div class="contenedor-input">

                        <!-- TITULO DE CADA INPUT -->
                        <p class="texto-input">VALOR DEL PRODUCTO</p>

                        <!-- INPUT VALOR -->
                        <input type="number" name="valor" class="insercion-input" id="valorProducto" min="0" max="100" value="{{ $producto->valor ?? '' }}">
                    </div>
                </div>

                <!-- CONTENEDOR DE CADA INPUT -->
                <div class="contenedor-input">

                    <!-- TITULO DE CADA INPUT -->
                    <p class="texto-input">DESCRIPCIÓN DEL PRODUCTO</p>

                    <!-- TEXTAREA PARA DESCRIPCION -->
                    <textarea name="descripcion" class="insercion-input" id="descripcionProducto" maxlength="100">{{ $producto->descripcion ?? '' }}</textarea>
                </div>


                <!-- CONTENEDOR PARA BOTONES -->
                <div class="contenedor-botones">

                    <!-- BOTON CANCELAR -->
                    <button type="button" class="botones" id="botonCancelar" onclick="window.history.back();">CANCELAR</button>

                    <!-- BOTON GUARDAR -->
                    <button type="submit" class="botones" id="botonGuardar">GUARDAR</button>
                </div>
            </div>
        </form>
    </main>
    <script src="{{ asset('Js/Insercciones/inserccionProductos.js') }}"></script>
</body>
</html>