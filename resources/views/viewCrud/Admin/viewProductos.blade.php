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
            <i class="fas fa-arrow-left"></i> 
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

            <div class="cardUnited">
                <article class="itemImg">
                    <img src="https://www.productosdelapeluqueria.es/384-home_default/aceite-barba-ossion.jpg" alt="Imagen de Producto" class="img">
                </article>
                <h4 class="nomItem">ACEITE BARBÓN</h4>
                <p class="descripcion">Producto 100% natural con aceite de argan y coco para mejor arreigacion a la piel 
                    con extracto de sumo de zanahoria que hace que tu barba se vea mas gruesa.
                </p>
                <div class="btnCrud">
                    <button type="submit" class="btnEdit">Editar</button>
                    <button type="submit" class="btnEdit" id="eliminarItem">Eliminar</button>
                </div>
            </div>

        </section>
    </section> 
       
</body>
</html>