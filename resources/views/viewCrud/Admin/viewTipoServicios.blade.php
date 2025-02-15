<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Tipos de servicio - MiNegocio</title>
</head>
<body>
    <section class="viewTipservicios">
        <!-- VOLVER AL MENU INICIAL -->
        <span class="volver">
            <i class="fas fa-arrow-left"></i> 
            <h3 class="nomView">Gestion Tipo Servicios</h3>
        </span>
    
        <!-- FILTRADO DE TIPOS DE PRODUCTOS -->
        <nav class="filter">
            <div class="option">
                <button type="submit" id="btnInicio" class="optionGestion"> TODO</button>
                <button type="submit" class="optionGestion">RECIENTES</button>
                <button type="submit" class="optionGestion">RANKING</button>
            </div> 
            <div class="searchBar">
                <select name="service" class="inputSearch">
                    <option value="" disabled selected>Seleccione una categoria</option>
                    <option value="1">Categoria 1</option>
                    <option value="2">Categoria 2</option>
                    <option value="3">Categoria 3</option>
                </select>
            </div>
        </nav>
        
        <!-- CONTENEDOR DEL TIPO DE SERVICIO A REFERENCIAR -->
        <div class="cardItems">
            @foreach($tipoServicios as $tipo)
            <div class="cardUnited">
                <h4 class="nomItem">{{$tipo['tipo_serv']}}</h4>
                <div class="btnCrud">
                <form action="{{ route('tipoServicios', ['accion' => 'editar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnEdit" value="{{ $tipo['id_tiposerv'] }}" name="editTipoServicio">
                        <i class="fas fa-edit"></i>
                    </button>
                </form>

                <form action="{{ route('tipoServicios', ['accion' => 'eliminar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnEdit" value="{{ $tipo['id_tiposerv'] }}" name="deleteTipoServicio">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                </div>
            </div>
            @endforeach
        </div>
    </section>    
</body>
</html>