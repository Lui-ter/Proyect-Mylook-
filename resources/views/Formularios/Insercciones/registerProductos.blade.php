<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/inserccionProductos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

    <title>{{ isset($producto) ? 'Editar Producto | MyLook' : 'Agregar Producto - MyLook' }}</title>
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

        <!-- FORMULARIO -->
        <form
            action="{{ isset($producto) ? route('updateProduct', ['id' => $producto->id_prod]) : route('registerProduct') }}"
            method="POST" enctype="multipart/form-data" class="formulario-productos"
            onsubmit="handleValidationProduct(event)">
            @csrf
            @if(isset($producto))
                @method('PUT')
                <input type="hidden" name="editProduct" value="true">
            @endif

            <!-- CONTENEDOR DE INSERCIÓN DE INFORMACIÓN -->
            <div class="contenedor-informacion">

                <h1 class="titulo">INFORMACIÓN DE PRODUCTOS</h1>
                <p class="introduccion">En este apartado podrás ingresar la información completa relacionada con tus
                    productos para que se muestren correctamente dentro del sistema.</p>

                <div class="contenedor-nombre">

                    <p class="texto-input">NOMBRE DEL PRODUCTO</p>
                    <input type="text" name="nombre" class="insercion-input" id="nombreProducto" maxlength="25"
                        value="{{ $producto->nombre_prod ?? '' }}">
                    @if(!isset($producto))
                        <input type="hidden" name="idEstablecimiento" id="idEstablecimiento"
                            value="{{$idEstablecimiento ?? ''}}">
                    @endif
                </div>

                <!-- CONTENEDOR DOBLE COLUMNA (MARCA - IMAGEN - CANTIDAD - VALOR) -->
                <div class="doble-columna">

                    <div class="contenedor-campos">
                        <p class="texto-input">MARCA DEL PRODUCTO</p>
                        <input type="text" name="marca" class="insercion-input" id="marcaProducto"
                            value="{{ $producto->nom_marca ?? '' }}">
                    </div>

                    <!-- CONTENEDOR PARA INSERCION DE IMAGEN -->
                    <div class="contenedor-foto">

                        <label for="insercion-imagen" class="foto-input">
                            <i class="bi bi-camera icono"></i>
                            <span class="texto-input imagen-input">SELECCIONA LA IMAGEN</span>
                        </label>
                        <input type="file" name="imagen" class="input-foto" id="insercion-imagen" accept="image/*">
                    </div>

                    <div class="contenedor-campos">
                        <p class="texto-input">CANTIDAD DEL PRODUCTO</p>
                        <input type="number" name="cantidad" class="insercion-input" id="cantidadProducto" min="0"
                            value="{{ $producto->stock ?? '' }}">
                    </div>

                    <div class="contenedor-campos">
                        <p class="texto-input">VALOR DEL PRODUCTO</p>
                        <input type="number" name="valor" class="insercion-input" id="valorProducto" min="0"
                            value="{{ $producto->valor_prod ?? '' }}">
                    </div>
                </div>

                <div class="contenedor-descripcion">
                    <p class="texto-input">DESCRIPCIÓN DEL PRODUCTO</p>
                    <textarea name="descripcion" class="insercion-input" id="descripcionProducto"
                        maxlength="1000">{{ $producto->desc_prod ?? '' }}</textarea>
                </div>


                <!-- CONTENEDOR PARA BOTONES -->
                <div class="contenedor-botones botones2">
                    <button type="button" class="botones" id="botonCancelar"
                        onclick="window.history.back();">CANCELAR</button>
                    <button type="submit" class="botones" id="botonGuardar">GUARDAR</button>
                </div>


            </div>

            <!-- CONTENEDOR PREVISUALIZACIÓN -->
            <div class="contenedor-carta">

                <div class="visualizacion">
                    <!-- CONTENEDOR DE LA IMAGEN -->
                    <div class="imagen-carta">
                        <img class="imagen-vista" id="imagenVisualizacion" src="{{ $producto->img_prod ?? '' }}">
                    </div>

                    <!-- CONTENEDOR DETALLES -->
                    <div class="detalles-carta">
                        <h2 id="previewNombre" class="nombre-vista">{{ $producto->nombre_prod ?? 'NOMBRE' }}</h2>
                        <p id="previewDescripcion" class="descripcion-vista">{{ $producto->desc_prod ?? 'Descripción...' }}
                        </p>

                        <div class="componentes">
                            <div class="componentes-titulos">
                                <p class="titulo-detalles">MARCA</p>
                                <p class="titulo-detalles">CANTIDAD</p>
                                <p class="titulo-detalles">VALOR</p>
                            </div>

                            <div class="componentes-titulos">
                                <p class="elementos">{{ $producto->nom_marca ?? '' }}</p>
                                <p class="elementos">{{ $producto->stock ?? '' }}</p>
                                <p class="elementos">{{ $producto->valor_prod ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contenedor-botones botones1">
                    <button type="button" class="botones" id="botonCancelar"
                        onclick="window.history.back();">CANCELAR</button>
                    <button type="submit" class="botones" id="botonGuardar">GUARDAR</button>
                </div>
            </div>

        </form>
    </main>
    <script src="{{ asset('Js/Insercciones/inserccionProductos.js') }}"></script>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>

</body>

</html>
