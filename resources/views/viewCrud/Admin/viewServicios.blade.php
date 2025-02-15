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
            </div> 
            <div class="searchBar">
                <select name="service" class="inputSearch">
                    <option value="" disabled selected>Seleccione un tipo de servicio</option>
                    @foreach($tipoServicio as $tipo)
                    <option value="{{$tipo['tipo_serv']}}">{{$tipo['tipo_serv']}}</option>
                    @endforeach
                </select>
            </div>
        </nav>
        
        <!-- CONTENEDOR DEL SERVICIO A REFERENCIAR -->
        <section class="cardItems">

            @foreach($servicios as $servicio)
            <div class="cardUnited">
                <article class="itemImg">
                    <img src="{{$servicio['img_serv']}}" alt="Imagen de Servicio" class="img">
                </article>
                <div class="infoItem">
                    <h3 class="nomNegocio">ALEJANDRO MALDITA PERRA</h3>
                    <h2 class="nomItem">{{$servicio['nom_servicio']}}</h2>
                    <p class="precio">$ {{$servicio['precio_servicio']}} CO</p>
    
                    <div class="btnCrud">
                    <form action="{{ route('servicios', ['accion' => 'editar']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="editServicio" value="{{ $servicio['id_servicio'] }}">
                        <button type="submit" class="btnEdit">EDITAR SERVICIO</button>
                    </form>
                    </div>
    
                    </p>
                    <p class="time">{{$servicio['duracion_serv']}} Minutos</p>
                </div>
            </div>
            @endforeach

        </section>
    </section>    
</body>
</html>