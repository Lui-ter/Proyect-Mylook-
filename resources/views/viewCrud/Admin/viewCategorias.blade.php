<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Categorias -MiNegocio</title>
</head>
<body>
    <section class="viewCategorias" >
        <!-- VOLVER AL MENU INICIAL -->
        <span class="volver">
            <i class="fas fa-arrow-left"></i> 
            <h3 class="nomView">Gestion Categorias</h3>
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
        
        <!-- CONTENEDOR DE CATEGORÍA A REFERENCIAR -->
        <section class="cardItems">

            <div class="cardUnited">
                <h4 class="nomItem">CORTES</h4>
                <article class="itemImg">
                    <img src="https://joseppons.com/formacion/wp-content/uploads/2022/05/estudiar-barberi%CC%81a@0.5x.jpg" alt="Imagen de Categoria" class="img">
                </article>
                <div class="btnCrud">
                    <button type="submit" class="btnEdit">Editar</button>
                    <button type="submit" class="btnEdit" id="eliminarItem">Eliminar</button>
                </div>
            </div>

        </section>
    </section>    
</body>
</html>