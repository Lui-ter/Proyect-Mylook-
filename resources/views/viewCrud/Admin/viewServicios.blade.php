<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="https://i.pinimg.com/originals/61/0e/4e/610e4e1ceb531802e43da44d89f1f86e.jpg" type="image/x-icon">
    <title>Servicios - MiNegocio</title>
</head>
<body>
    <section class="viewServicios">
        <!-- VOLVER AL MENU INICIAL -->
        <span class="volver">
            <a href="{{route('admin', ['accion' => 'index'])}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h3 class="nomView">Gestion Servicios</h3>
        </span>

        <!-- FILTRADO DE SERVICIOS -->
        <nav class="filter">
            <div class="option">
                <button type="submit" id="btnInicio" class="optionGestion"> TODO</button>
                <button type="submit" class="optionGestion">RECIENTES</button>
                <button type="submit" class="optionGestion">RANKING</button>
                <a href="{{ route('servicios', ['accion' => 'nuevo', 'id' => $categorias['id_categoria']]) }}"><button type="submit" class="optionGestion">NUEVO</button></a>
            </div>
            <div class="searchBar">
                <select name="service" class="inputSearch">
                    <option value="" disabled selected>Seleccione un tipo de servicio</option>
                    @foreach ( $servicios as $servicio )
                        <option value="{{ $servicio->id_servicio }}">{{ $servicio->nombre_servicio }}</option>
                    @endforeach
                </select>
            </div>
        </nav>

        <!-- CONTENEDOR DEL SERVICIO A REFERENCIAR -->
        <section class="cardItems">

            @foreach($servicios as $servicio)
            <div class="cardUnited">
                <article class="itemImg">
                    <img src="{{ $categorias['imagen'] }}" alt="Imagen de la categoria" class="img">
                </article>
                <div class="infoItem">
                    <h2 class="nomNegocio">{{ $nombreNegocio }}</h2>
                    <h3 class="nomItem">{{$servicio->nombre_servicio}}</h3>
                    <p class="precio">$ {{$servicio->precio_servicio}}</p>
                    <p class="precio">{{$servicio->desc_servicio}}</p>

                    <div class="btnCrud">
                    <form action="{{ route('servicios', ['accion' => 'editar']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="editServicio" value="{{ $servicio->id_servicio }}">
                        <button type="submit" class="btnEdit">EDITAR SERVICIO</button>
                    </form>
                    <form action="{{ route('servicios', ['accion' => 'eliminar']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="deleteServicio" value="{{ $servicio->id_servicio }}">
                        <button type="submit" class="btnEdit">ELIMINAR SERVICIO</button>
                    </form>
                    </div>

                    </p>
                    <p class="time">{{$servicio->duracion_serv}} Minutos</p>
                </div>
            </div>
            @endforeach

        </section>
    </section>
</body>
</html>
