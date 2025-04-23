<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario Categorías</title>
  <link rel="stylesheet" href="{{asset('Css/Form/inserccionCategorias.css')}}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>
<body>
  <!--sección todo-->
<main>
  <article class="titulo">
  <h1 class="titulo1">{{ $modeValidator == 1? '' : 'EDICIÓN Y CREACIÓN DE CATEGORÍAS' }}</h1>
  <p class="texto">{{ $modeValidator == 1 ? '' : 'En este apartado podrás editar y crear las categorías disponibles en tu establecimiento' }}</p>

  </article>
  <!--contenedor del formulario-->
  <section class="formularioCategoria">
    <!--formulario-->
    <form action="{{ $modeValidator == 1? route('updateCategory',['id' => $categoria['id_categoria']]): route('registerCategory') }}" method="post" class="formulario" enctype="multipart/form-data" onsubmit="handleValidationCategory(event)">
      @csrf
      @method($modeValidator == 1? 'PUT':'POST')
      <article class="contenedorPadre">

        <div class="columna">
          <label for="nombreCategoria" class="nombreCategoria">Nombre de la categoría:</label>
          <input type="text" name="nombreCategoria" class="nombreInput" id="nombreCategoria" maxlength="50" value="{{ $categoria['nom_categoria'] ?? '' }}"/>

          <div class="inputImagen">
            <label for="imagen" class="nombreCategoria labelImagen">Subir imagen categoría:</label>
            <input type="file" name="imgCategoria" class="nombreInput subirImagen" id="imagen" />
          </div>

          <label for="descripcion" class="nombreCategoria">Descripción de la categoría:</label>
          <textarea name="descripcionCategoria" id="descripcion" maxlength="300">{{$categoria['desc_categoria']??''}}</textarea>
        </div>

        <!-- Input para llevar el id del establecimiento a registrar en la categoria siempre y cuando el modevalidator sea 2 -->
        @if($modeValidator == 2)
            <input type="hidden" name="idEstablecimiento" value="{{ $idEstablecimiento }}">
        @endif


        <!-- BOTONES DE GUARDAR Y CANCELAR (HAY ALGO POR PREGUNTAR) -->
       <div class="botones">
          <button type="reset" class="cancelar">CANCELAR</button>
          <button type="submit" class="guardar">GUARDAR</button>
        </div>
      </article>
    </form>
    <!-- previsualización de categoría -->
    <div class="columnaDos">
      <h2 class="titulo2">PREVISUALIZACIÓN</h2>
      <article class="contenedorVisualizacion">
        <div class="columna">
          <section class="infoPrevisual">
            <figure>
                <img id="imagenCategoria"
                     src="{{ isset($categoria['imagen']) && !empty($categoria['imagen']) ? $categoria['imagen'] : '' }}"
                     alt="Imagen de la categoría"
                     style="max-width: 100%; display: {{ isset($categoria['imagen']) && !empty($categoria['imagen']) ? 'block' : 'none' }};" />

                @if(!isset($categoria['imagen']) || empty($categoria['imagen']))
                  <p id="sinImagen">No hay imagen disponible</p>
                @endif
              </figure>
            <h3 class="titulo3" id="vistaNombre"></h3>
            <p class="texto2" id="vistaDescripcion"></p>
          </section>
        </div>
      </article>
    </div>
  </section>
</main>
    <script src="{{ asset('Js/Formularios/PrevisualizacionCategoria.js') }}"></script>

  </body>
</html>
