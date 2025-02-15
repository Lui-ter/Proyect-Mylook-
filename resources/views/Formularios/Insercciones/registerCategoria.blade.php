<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario Categorías</title>
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/inserccionCategorias.css') }}"/>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <body>

    <!-- sección todo -->
    <article class="titulo">
      <h1 class="titulo1">{{($modeValidator == 1) ? 'EDICIÓN DE CATEGORIAS':'CREACIÓN DE CATEGORIAS'}}</h1>
      <p class="texto">
      {{ ($modeValidator == 1) ? 'En este apartado podrás editar las categorías existentes en tu establecimiento.' : 'En este apartado podrás crear las categorías que se encontrarán disponibles en tu establecimiento.' }}
      </p>
    </article>

    <!-- contenedor del formulario -->
    <section class="formCategoria">

      <!-- Formulario -->
      <form action="{{ $modeValidator == 1 
        ? route('updateCategory', ['id' => $categoria['id_categoria']]) 
        : route('registerCategory') }}"   method="post" class="formulario" enctype="multipart/form-data" onsubmit="handleValidationCategory(event)">
        @csrf
        @method($modeValidator == 1 ? 'PUT' : 'POST')

        <article class="contenedorPadre">
          <div class="colum">
            <label for="" class="nombreCat">Nombre de la categoría:</label
            >
            <input type="text" name="nombreCategoria" class="nombreInput" id="nombreCategoria" value="{{$categoria['nom_categoria'] ?? ''}}"/>
              <div class="inputImg">
                <label for="imagen" class="nombreCat labelImagen" >Subir imagen categoría:</label
                  >
                  <input type="file" name="imgCategoria" class="nombreInput subirImagen" id="imagen" />
              </div>
           

            <label for="" class="nombreCat">Descripción de la categoría:</label
            >
            <textarea name="descripcionCategoria" id="descripcion">{{$categoria['desc_categoria'] ?? ''}}</textarea>
           
          </div>
        </div>


        <!-- BOTONES DE GUARDAR Y CANCELAR -->
        <div class="botones">
         <a href="{{route('admin')}}" class="cancelar">CANCELAR</a>
         <button type="submit" class="guardar" name="{{($modeValidator == 1) ? 'updateButton':''}}">{{($modeValidator == 1) ? 'EDITAR':'GUARDAR' }}</button>
      </div>
        </article>
      </form>

      
      <!-- previsualización de categoría -->
      <div class="columnaDos">
        <h2 class="titulo2">PREVISUALIZACIÓN</h2>
        <article class="contenedorVisualizacion">
            <div class="colum">
              <h3 class="titulo3">MAQUILLAJE</h3>
                <section class="infoPrevisual">
                    <figure>
                        <img
                          id="imagenMaquillaje"
                          src=""
                          alt="La imagen no cargo"
                        />
                        
                      </figure>
                      <p class="texto2">
                          ¡Descubre nuestra categoría de maquillaje! Transformamos cada rostro en una obra de arte, resaltando tu belleza natural para cualquier ocasión: desde un look fresco y sutil para el día, hasta un estilo impactante para la noche o eventos especiales.¡Siéntete radiante y segura de ti misma en cada paso!
                        </p>
                </section>
            
          </article>
      </div>
    </section>

    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>

  </body>
</html>
