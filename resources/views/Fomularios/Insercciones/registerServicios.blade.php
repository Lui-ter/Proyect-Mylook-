<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Creación de Servicio</title>
    <link rel="stylesheet" href="/Css/Insercciones/inserccionServicios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <main>

      <h2 class="tituloPrincipal">CREACIÓN DE SERVICIO</h2>

      <section>

        <p class="paginaDescripcion">
          En este apartado podrás agregar servicios al catálogo. Esto te
          permitirá organizar y ofrecer los servicios de manera clara y
          accesible para los clientes al momento de agendar citas.
        </p>
      </section>
      
      <!--Contenedor principal divisor de columnas-->
      <form class="contenedorForm" method="" action="">

      <!--Contenedor de columna numero uno-->
        <section class="columnaUno">
          <div class="infoInput">
            <p class="nombreInput">Tipo de Servicio:</p>
            <select id="tipoServicio" name="tipoServicio">
              <option value="0">Tipo</option>
              <option value="1">Uñas</option>
              <option value="2">Corte de cabello</option>
              <option value="3">Depilación láser</option>
            </select>
          </div>
          <div class="infoInput">
            <p class="nombreInput">Nombre del servicio:</p>
            <input
              type="text"
              id="nombreServicio"
              name="nombreServicio"
              required
            />
          </div>

          <div class="infoInput">
            <p class="nombreInput">Precio del Servicio:</p>
            <input
              type="number"
              id="precioServicio"
              name="precioServicio"
              required
            />
          </div>

          <div class="infoInput">
            <p class="nombreInput">Descripción del Servicio:</p>
            <textarea
              id="descripcionServicio"
              name="descripcionServicio"
              rows="5"
              maxlength="90"
              required
            ></textarea>
          </div>
        </section>

      <!--Contenedor de columna numero dos-->

        <section class="columnaDos">
          <div class="columnaDosRowDos">
            <div class="infoInput">
              <p class="nombreInput">Duración del Servicio:</p>
              <input
                type="number"
                id="duracionServicio"
                name="duracionServicio"
              />
            </div>
            <div class="infoInput">
              <p class="nombreInput">Imagen del Servicio:</p>
              <label for="imagenServicio" class="fileUploadLabel"
                >Presione aqui</label
              >
              <input
                type="file"
                id="imagenServicio"
                name="imagenServicio"
                accept="image/jpeg, image/png"
                class="fileUploadInput"
              />
            </div>
          </div>
      <!--Contenedor de carta de preview-->

          <div class="contenedorCard">
            <h2 class="tituloPrevisualizacion">
              Previsualización del servicio
            </h2>
            <div class="card">
              <figure class="cardImg">
                <img id="imagenPrevisualizacion" src="./descarga (3).png" alt="" />
              </figure>
              <div class="cardText">
                <h3 id="nombrePrevisualizacion">Nombre</h3>
                <p id="descripcionPrevisualizacion">Descripción</p>
                <div class="duracionPrecio">
                  <p id="duracionPrevisualizacion">Duración</p>
                  <p id="precioPrevisualizacion">Precio</p>
                </div>
              </div>
            </div>
          </div>
          <div class="botonSubmit">
            <input class="guardar" type="submit" value="Agregar Servicio" />
          </div>
        </section>
      </form>
    </main>
    <script src="/Js/Insercciones/inserccionProductos.js"></script>
  </body>
</html>
