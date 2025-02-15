<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{($modeValidator == 1) ? "Edición de Servicio" : "Creación de Servicio"}}</title>
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/inserccionServicios.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <main>

      <h2 class="tituloPrincipal">{{($modeValidator == 1) ? "Edición de Servicio" : "Creación de Servicio"}}</h2>

      <section>

        <p class="paginaDescripcion">
          {{($modeValidator == 1) ? "En este apartado podrás editar los servicios que ofreces en tu negocio.
            Esto te permitirá mantener actualizado el catálogo de servicios
            y ofrecer información clara y precisa a tus clientes." :
            "En este apartado podrás agregar servicios al catálogo. Esto te
            permitirá organizar y ofrecer los servicios de manera clara y
            accesible para los clientes al momento de agendar citas."
          }}
        </p>
      </section>
      
      <!--Contenedor principal divisor de columnas-->
      <form class="contenedorForm" method="post" action="{{ $modeValidator == 1 
        ? route('updateService', ['id' => $servicio['id_servicio']]) 
        : route('registerService') }}" enctype="multipart/form-data">
      @csrf
      @method($modeValidator == 1 ? 'PUT' : 'POST')
      <!--Contenedor de columna numero uno-->
        <section class="columnaUno">
          <div class="infoInput">
            <p class="nombreInput">Tipo de Servicio:</p>
            <select id="tipoServicio" name="tipoServicio">
              <option disabled selected>Tipo</option>
            @foreach ($typeServices as $service)
                    <option value="{{ $service['id_tiposerv'] }}">{{ $service['tipo_serv'] }}</option> <!-- FALTA LOGICA PARA ASIGNAR TIPO SERVICIO DEL EDIT -->
            @endforeach
            </select>
          </div>
          <div class="infoInput">
            <p class="nombreInput">Nombre del servicio:</p>
            <input
              type="text"
              id="nombreServicio"
              name="nombreServicio"
              value="{{$servicio['nom_servicio'] ?? ''}}"
              required
            />
          </div>

          <div class="infoInput">
            <p class="nombreInput">Precio del Servicio:</p>
            <input
              type="number"
              id="precioServicio"
              name="precioServicio"
              value="{{$servicio['precio_servicio'] ?? ''}}"
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
              >{{$servicio['desc_servicio'] ?? ''}}
          </textarea>
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
                value="{{$servicio['duracion_serv'] ?? ''}}"
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
                <img id="imagenPrevisualizacion" src="{{$servicio['img_serv'] ?? ''}}" alt="" />
              </figure>
              <div class="cardText">
                <h3 id="nombrePrevisualizacion">{{$servicio['nom_servicio'] ?? 'Nombre'}}</h3>
                <p id="descripcionPrevisualizacion">{{$servicio['desc_servicio'] ?? 'Descripción'}}</p>
                <div class="duracionPrecio">
                  <p id="duracionPrevisualizacion">{{$servicio['duracion_serv'] ?? 'Duración'}}</p>
                  <p id="precioPrevisualizacion">{{$servicio['precio_servicio'] ?? 'Precio'}}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="botonSubmit">
            <input class="guardar" type="submit" value="{{($modeValidator == 1) ? 'Editar Servicio':'Agregar Servicio'}}" />
          </div>
        </section>
      </form>
    </main>
    <script src="{{asset('Js/Insercciones/inserccionServicios.js')}}"></script>
  </body>
</html>
