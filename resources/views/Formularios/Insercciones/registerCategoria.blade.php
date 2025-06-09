<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario Categorías</title>
  <link rel="stylesheet" href="{{asset('Css/Form/inserccionCategorias.css')}}" />
  <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

</head>

<body>
  @section('link-index', '/admin/index')
  @section('link-configurar-perfil', route('admin', ['accion' => 'config']))
  @section('link-configurar-establecimiento', route('establecimientos', ['accion' => 'config']))
  @section('link-configurar-negocio', route('negocio', ['accion' => 'config']))
  @section('link-historial', '/admin/historial')
  @section('link-salir', '/negocio/logout')

  @include('components.header-staff',['notificaciones' => $notificaciones, 'imgStaff' => $imgStaff])
  <!--sección todo-->
  <main>
    <article class="titulo">
      <h1 class="titulo1">{{ $modeValidator == 1? '' : 'EDICIÓN Y CREACIÓN DE CATEGORÍAS' }}</h1>
      <p class="texto">{{ $modeValidator == 1 ? '' : 'En este apartado podrás editar y crear las categorías disponibles en tu establecimiento' }}</p>
    </article>

    <!--contenedor del formulario-->
    <section class="formulario-categoria">
      <!--formulario-->
      <form action="{{ $modeValidator == 1? route('updateCategory',['id' => $categoria['id_categoria']]): route('registerCategory') }}" method="post" class="formulario" enctype="multipart/form-data" onsubmit="handleValidationCategory(event)">
        @csrf
        @method($modeValidator == 1? 'PUT':'POST')
        <input type="hidden" name="editProduct" value="true">
        <article class="contenedor-padre">

          <div class="columna">
            <div class="info-input">
              <p class="nombre-categoria">NOMBRE:</p>
              <input type="text" name="nombreCategoria" class="nombre-input" id="nombreCategoria" maxlength="50" value="{{ $categoria['nom_categoria'] ?? '' }}" />
            </div>
            <div class="info-input">
              <p class="nombre-categoria">DESCRIPCIÓN:</p>
              <textarea name="descripcionCategoria" id="descripcion" maxlength="300">{{$categoria['desc_categoria']??''}}</textarea>
            </div>
            <div class="info-input input-imagen">
              <label for="inserccion-foto" class="nombre-categoria imagen1">
                <i class="bi bi-camera icono"></i>
                <span class="texto-input imagen-input">SUBIR IMAGEN</span>
              </label>
              <input type="file" name="imgCategoria" class="subir-imagen" id="imagen" />
            </div>
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
      <div class="columna-dos">
        <h2 class="titulo2">PREVISUALIZACIÓN</h2>
        <article class="contenedor-visualizacion">
          <div class="columna-tres">
            <section class="informacion-previsual">

              <h3 class="titulo3" id="vistaNombre"></h3>
              <div class="fila">
                <p class="texto2" id="vistaDescripcion"></p>
                <figure>
                  <img id="imagenCategoria"
                    src="{{ isset($categoria['imagen']) && !empty($categoria['imagen']) ? $categoria['imagen'] : 'https://i.postimg.cc/CLVQ2RpV/003-agregar.png' }}"
                    alt="Imagen de la categoría"
                    style="max-width: 100%;" />

                  @if(!isset($categoria['imagen']) || empty($categoria['imagen']))
                  <p id="sinImagen"></p>
                  @endif
                </figure>

              </div>
            </section>
          </div>
        </article>
      </div>
    </section>
  </main>
  <script src="{{ asset('Js/Formularios/PrevisualizacionCategoria.js') }}"></script>
  <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>


</body>

</html>
