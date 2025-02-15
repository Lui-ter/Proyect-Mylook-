<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"  href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <title>Productos - MiNegocio</title>
</head>
<body>

    <section class="viewProductos">
        <!-- VOLVER AL MENU INICIAL -->
        <span class="volver">
            <a href="{{route('admin')}}"><i class="fas fa-arrow-left"></i></a> 
            <h3 class="nomView">Gestion Productos</h3>
        </span>
    
        <!-- FILTRADO DE PRODUCTOS -->
        <nav class="filter">
            <div class="option">
                <button type="submit" id="btnInicio" class="optionGestion"> TODO</button>
                <button type="submit" class="optionGestion">RECIENTES</button>
                <button type="submit" class="optionGestion">AGOTADOS</button>
            </div> 
            <div class="searchBar">
                <i class="fas fa-search"></i>
                <input type="text" class="inputSearch" placeholder="Buscar producto...">
            </div>
        </nav>
        
        <!-- CONTENEDOR DEL PRODUCTO A REFERENCIAR -->
        <section class="cardItems">
            @foreach($productos as $producto)
            <div class="cardUnited">
                <article class="itemImg">
                    <img src="{{$producto['img_prod']}}" alt="Imagen de Producto" class="img">
                </article>
                <h4 class="nomItem">{{$producto['nombre_prod']}}</h4>
                <p class="descripcion">{{$producto['desc_prod']}}</p>
                <div class="btnCrud">
                <form action="{{ route('productos', ['accion' => 'editar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnEdit" name="editProducto" value="{{ $producto['id_prod'] }}">Editar</button>
                </form>

                <form action="{{ route('productos', ['accion' => 'eliminar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnEdit" name="deleteProducto" value="{{ $producto['id_prod'] }}">Eliminar</button>
                </form>
                </div>
            </div>
            @endforeach
        </section>
    </section> 
       
</body>
</html>