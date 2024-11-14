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
      <h1 class="titulo1">CREACIÓN DE CATEGORíAS</h1>
      <p class="texto">
        En este apartado podrás crear las categorías que se encontrarán
        disponibles en tu establecimiento
      </p>
    </article>

    <!-- contenedor del formulario -->
    <section class="formCategoria">


      <!-- Formulario -->
      <form action="{{ route('registerCategory') }}" method="post" class="formulario" enctype="multipart/form-data">
        @csrf
        <article class="contenedorPadre">
          <div class="colum">
            <label for="" class="nombreCat">Nombre de la categoría:</label
            >
            <input type="text" name="nombreCategoria" class="nombreInput" />
              <div class="inputImg">
                <label for="imagen" class="nombreCat labelImagen" >Subir imagen categoría:</label
                  >
                  <input type="file" name="imgCategoria" class="nombreInput subirImagen" id="imagen" />
              </div>
           

            <label for="" class="nombreCat">Descripción de la categoría:</label
            >
            <textarea name="descripcionCategoria" id="descripcion"></textarea>
           
          </div>
        </div>


        <!-- BOTONES DE GUARDAR Y CANCELAR -->
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
            <div class="colum">
              <h3 class="titulo3">MAQUILLAJE</h3>
                <section class="infoPrevisual">
                    <figure>
                        <img
                          id="imagenMaquillaje"
                          src="maquillaje.jpg"
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

    

  </body>
</html>
