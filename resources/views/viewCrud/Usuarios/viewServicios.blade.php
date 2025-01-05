<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Views/viewCrudUsuarios.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Servicios - MYLOOK</title>
</head>
<body>
    <section class="viewServicios">
        <!-- VOLVER AL MENU INICIAL -->
        <span class="volver">
            <i class="fas fa-arrow-left"></i> 
            <h3 class="nomView">VISUALIZACION DE SERVICIOS</h3>
        </span>
    
        <!-- FILTRADO DE SERVICIOS -->
        <nav class="filter">
            <div class="option">
                <button type="submit" id="btnInicio" class="optionGestion"> MAS VENDIDOS</button>
                <button type="submit" class="optionGestion">MEJOR CALIFICACION</button>
                <button type="submit" class="optionGestion">RECOMENDADOS</button>
            </div> 
            <div class="searchBar">
                <select name="service" class="inputSearch">
                    <option value="" disabled selected>Seleccione un tipo de servicio</option>
                    <option value="1">Tipo Servicio 1</option>
                    <option value="2">Tipo Servicio 2</option>
                    <option value="3">Tipo Servicio 3</option>
                </select>
            </div>
        </nav>
        
        <!-- CONTENEDOR DEL SERVICIO A REFERENCIAR -->
        <section class="cardItems">

            <div class="cardUnited">
                <article class="itemImg">
                    <img src="https://richardsalon.es/wp-content/uploads/2023/01/Mullet-corte-de-pelo-para-chicos-de-moda-2023.jpg" alt="Imagen de Servicio" class="img">
                </article>
    
                <div class="infoItem">
                    <h3 class="nomNegocio">Warrior Barber Club</h3>
                    <h2 class="nomItem">Mullet Degradado Medio</h2>
                    <p class="precio">$ 35,000 CO</p>
    
                    <div class="btnCrud">
                        <button type="submit" class="btnEdit">SEPARAR SERVICIO</button>
                    </div>
    
                    <p class="descripcion">Tendencia en colombia y en el mundo corte de cabello mullet 
                         con un degradado medio que simula a la perfeccion y frecura y el buen aura de la persona que lo porta 
                         que esperar para lucir esa melena de leon
                    </p>
                    <p class="time">30 Minutos</p>
                </div>
            </div>

        </section>
    </section>    
</body>
</html>