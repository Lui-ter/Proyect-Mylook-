<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Css/Index/indexAdmin.css">
    <title>MiNegocio - MYLOOK</title>
</head>


<!-- CUERPO DE LA WEB -->
<body>
       
<!-- ----------------------------------------------------- -->

         <!-- MENU DE NAVEGACION -->
         <div class="navegacion" style="display: none;">

            <!-- CONTENEDOR DE VOLVER ATRAS -->
            <div class="volver">
                <i class="fas fa-arrow-left"></i> 
            </div>

            <!-- CONTENEDOR DE LAS OPCIONES DEL MENU DE NAVEGACION -->
            <div class="options">
                <p class="configCuenta">CONFIGURACION PERFIL</p>
                <p class="configCuenta">FEEDBACK</p>
                <p class="configCuenta" id="scrollMedio">PRODUCTOS</p>
                <p class="configCuenta">TIPOS DE PRODUCTOS</p>
                <p class="configCuenta">CATEGORIAS</p>
            </div>
        </div>

        <!-- BANDEJA DE ENTRADA MOBILE -->
        <div class="bandejaEntradaMobile" style="display: none;">
        

                <!-- ENCABEZADO DE LA BANDEJA DE ENTRADA -->
                <section class="enacbezadoBandeja">
        
                     <!-- CONTENEDOR DE VOLVER ATRAS -->
                     <div class="volver">
                        <i class="fas fa-arrow-left"></i> 
                    </div>
        
                    <!-- TITULO DE LA BANDEJA DE ENTRADA -->
                    <div class="tittleBandeja">
                        <h1 class="nomTittle">MYLOOK</h1>
                    </div>
        
                    <!-- CONTADOR DE MENSAJES -->
                    <div class="contadorBandeja">
                        <i class="fas fa-inbox"></i>
                    </div>
        
                </section>
        
                <!-- CHAT DE LA BANDEJA DE ENTRADA -->
                <div class="chatsBandeja">
        
                    <span class="chat">
                        <img src="" alt="" class="imgPerfil">
                    </span>
        
                    
                    <span class="chat">
                        <img src="" alt="" class="imgPerfil">
                    </span>
        
                    <span class="chat">
                        <img src="" alt="" class="imgPerfil">
                    </span>
        
                </div>
        
                <!-- MENSAJES DE LOS USUARIOS -->
                <article class="messagesBandeja">
        
        
                    <!-- INTERACCION DE MENSAJES -->
                    <article class="bodyMessage">
        
                        <div class="remitenteMessage" id="firstMesagge"></div>
        
                        <div class="recibeMessage"></div>
        
                        <div class="remitenteMessage"></div>
        
        
                    </article>
        
        
                    <!-- ESCRIBIR MENSAJE -->
                    <span class="sendMessages">
        
                        <div class="readMessage">
                            <input type="text" class="message" placeholder="Aa">
                        </div>
        
                        <span class="send">
                            <i class="fas fa-paper-plane"></i>
                        </span>
                    </span>
        
                </article>  
        </div>
    
        <!-- CALENDARIO MOBILE -->
        <div class="calendario" style="display: none;">
            <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=America%2FNew_York" 
             frameborder="0" class="calendarApi" scrolling="no"></iframe>
        </div>

<!------------------------------------------------------ -->

    <!-- ESTA ES UNA SECCION DONDE YA SE PUEDEN INTERACTUAR LOS CRUD DE LA BD CON LOS FORM -->
        
         <!-- PRIMERA SECCION AL ENTRAR AL INDEX ADMIN-->    
         <section class="SectionDefault">

            <!-- VERSION PC -->
            <aside class="bandejaEntrada">

                <!-- CONTENEDOR PADRE DE LA BANDEJA DE MENSAJES DE PC -->
                <section class="containerFathermessages">

                    <!-- ENCABEZADO DE LA BANDEJA DE ENTRADA -->
                    <article class="encabezadoMessage"></article>

                    <!-- MENSAJES -->
                    <div class="messages">

                        <!-- MENSAJES UNITARIOS -->
                        <article class="unitedMessage">

                            <!-- FECHA -->
                            <span class="fecha"></span>

                            <!-- MENSAJE -->
                            <article class="msg"></article>

                            <!-- ICONO -->
                            <span class="icon"></span>
                        
                        </article>
                        
                    </div>

                    <!-- VER MAS MENSAJES -->
                    <span class="verMas"></span>

                </section>

            </aside>

            <nav class="menuNaveacion">
                <button type="submit" class="navOptions" id="servicios">SERVICIOS</button>
                <button type="submit" class="navOptions" id="productos">PRODUCTOS</button>
                <button type="submit" class="navOptions" id="staff">STAFF</button>
                <button type="submit" class="navOptions" id="inicio">INICIO</button>
            </nav>
            <!--------------------------------------------- -->
    
            <!-- ENCABEZADO ADMIN -->
            <header class="encabezadoAdmin">
    
                <!-- NOMBRE DE LA APLICACION -->
                <h1 class="tittleApp">MYLOOK</h1>
    
                <!-- INFORMACION DEL ADMIN PARA PC -->
                <span class="infoAdmin">

                    <div class="infoCuenta">
                        <h3 class="nomAdmin">Benavides Marlon Ausier</h3>
                        <a href="" class="confAccount">Configuración</a>
                        <a href="" class="closeSession" id="close">Cerrar Sesion</a>
                    </div>

                    <div class="fotoPerfil">
                        <img src="" alt="" class="foto">
                    </div>

                

                </span>



                <!-- SOLO PARA PANTALLAS QUE NO SEAN MOBILES -->
                <span class="navMobile">
                    <i class="fas fa-calendar"></i>
                    <i class="fas fa-inbox"></i>
                    <i class="fas fa-bars"></i>
                </span>
                <!-- ---------------------------------------------------- -->
    
            </header>
    
            <!-- SECCION TUTORIAL PASO A PASO DE COMO INTERACTUAR CON EL INDEX -->
            <main class="gestionAdmin">
    
                <!-- AQUI SE ESCONDES LAS SECCIONES PRINCIPALES DEL CRUD DE MYLOOK -->
                <section class="crudItemsAdmin">
    
                    <!-- SECCION POR DEFECTO AL ENTRAR AL INDEX -->
                    <section class="sectionDefaultCrud" style="display: none;">
    
                    <!-- PRIMERA PARTE DE INTRODUCCION A COMO USAR EL MENU -->
                    <article class="introGestion">

                        <!-- INTRODUCCION MOBILE -->
                        <h3 class="pushUno Mobile">Bienvenido a la gestion de establecimento pulse 
                            <i class="fas fa-bars"></i> para añadir, eliminar o editar 
                            alguno de los siguientes modulos:
                        </h3>
                        <!-- ----------------------------------------------------------------------------- -->

                        <!-- INTRODUCCION A PC -->
                        <h3 class="pushPC PC">Bienvenido a la gestion de establecimento pulse 
                            <button type="submit" class="tutorialBtn">BOTÓN</button> para añadir, eliminar o editar 
                            alguno de los siguientes modulos:
                        </h3>
    

                        <!-- LO QUE SE PUEDE GESTIONAR -->
                        <ul class="passDos">
                            <li class="tutorial">  Gestionar <strong>productos</strong></li>
                            <li class="tutorial">  Gestionar <strong>miembros del staff</strong></li>
                            <li class="tutorial">  Gestionar <strong>categorias</strong></li>
                            <li class="tutorial">  Gestionar <strong>tipos servicios</strong></li>
                            <li class="tutorial">  Gestionar <strong>servicios</strong></li>
                            <li class="tutorial">  Gestionar <strong>horarios</strong></li>
                            <li class="tutorial">  Gestionar <strong>bandeja de entrada</strong></li>
                        </ul>
                    </article>
    
                    <span class="important">Nota: Todos los cambios registrados en este apatado seran 
                        reflejados en las interfaces del usuario.
                    </span>
    
                    </section>
    
                    <!-- SECCION PRINCIPAL DE LA GESTION DE PRODUCTOS -->
                    <section class="crudProductos" style="display: none;">

                        <!-- VER TODOS LOS PRODUCTOS REGISTRADOS -->
                        <span class="navCrud">
                        <a href="http://" class="viewAll" id="viewAllproductos">Ver todos</a>
                        </span>
    
                        <section class="contenedorCrud" >
                           
                            <!-- CONTENEDOR DEL ITEM A MOSTRAR -->
                        @foreach ($productsPreview as $productPreview)
                            <article class="item">
    
                                <!-- NOMBRE DEL ITEM -->
                                 <h3 class="nomItem">{{ $productPreview['nombre_prod'] }}</h3>

                                <!-- CONTENEDOR DE IMAGEN -->
                                <div class="imgItem">
                                    <img src="{{ $productPreview['img_prod'] }}" alt="" class="imgItem">
                                </div>
    
                                <!-- BOTONES DE EDITAR Y ELIMINAR -->
                                <span class="btns">
                                    <button type="submit" class="editItem"><a href="http://">EDITAR</a></button>
                                    <button type="submit" class="editItem" id="elimEliminar">ELIMINAR</button>
                                </span>
                            </article>
                        @endforeach
                        </section>
                            
    
                            <span class="registerItem">¿ Quieres añadir un producto ? <a href="" class="redirect">Registralo Aqui</a> </span>
                            
                    </section>

                    <!-- CRUD DE LOS MIEMBROS DEL STAFF DEL ESTABLECIMIENTO -->
                    <section class="crudMiembrostaff" style="display: none;">

                        
                        <!-- VER TODOS LOS PRODUCTOS REGISTRADOS -->
                        <span class="navCrud">
                            <a href="http://" class="viewAll" id="viewAllstaff">Ver todos</a>
                        </span>

                        <section class="contenedorCrud" >
                           
                            <!-- CONTENEDOR DEL ITEM A MOSTRAR -->
                            <article class="item">

                                 <!-- NOMBRE DEL ITEM -->
                                 <h3 class="nomItem">SHAPPER INALAMBRICA</h3>

                                <!-- CONTENEDOR DE IMAGEN -->
                                <div class="imgItem">
                                    <img src="" alt="" class="imgItem">
                                </div>
    
                                <!-- BOTONES DE EDITAR Y ELIMINAR -->
                                <span class="btns">
                                    <button type="submit" class="editItem"><a href="http://">EDITAR</a></button>
                                    <button type="submit" class="editItem" id="elimEliminar">ELIMINAR</button>
                                </span>
                            </article>

                        </section>

                        <!-- ENLACE A REGISTRAR PERFIL -->
                        <span class="registerItem">¿ Quieres añadir un Staff ? <a href="" class="redirect">Registralo Aqui</a> </span>
                        
                    </section>
    
                    <!-- SECCION PRINCIPAL DE LA GESTION DE SERVICIOS -->
                    <section class="crudServicios" style="display: none;">
    
                          <!-- VER TODOS LOS PRODUCTOS REGISTRADOS -->
                          <span class="navCrud">
                            <a href="http://" class="viewAll" id="categorias">Ver categorias</a>
                            <a href="http://" class="viewAll" id="viewAllservicios">Ver todos</a>
                            </span>
    
                        <section class="contenedorCrud" >
                           
                            <!-- CONTENEDOR DEL ITEM A MOSTRAR -->
                            <article class="item">
    
                                <!-- NOMBRE DEL ITEM -->
                                 <h3 class="nomItem">SHAPPER INALAMBRICA</h3>

                                <!-- CONTENEDOR DE IMAGEN -->
                                <div class="imgItem">
                                    <img src="" alt="" class="imgItem">
                                </div>
    
                                <!-- BOTONES DE EDITAR Y ELIMINAR -->
                                <span class="btns">
                                    <button type="submit" class="editItem" id="viewAlltiposervicio">Tipo Servicio</button>
                                    <button type="submit" class="editItem" id="elimEliminar">ELIMINAR</button>
                                </span>
                            </article>

                        </section>
                            
    
                            <span class="registerItem">¿ Quieres añadir un producto ? <a href="" class="redirect">Registralo Aqui</a> </span>
                    </section>
    
                    <section class="sectionPresentations" style="display: none;">
                    
                            <!-- Imagen que se podrá editar -->
                            <img src="https://images.fresha.com/locations/location-profile-images/588513/2109480/19a8f5b8-0922-47ae-b647-3605142a0d9a.jpg?class=venue-gallery-mobile" alt="" class="imgPresentations" id="imgToEdit">
                        
                            <!-- Botón para activar el input file -->
                            <div class="edit" id="editarImagen">
                                <h4 class="nomEdit">EDITAR</h4>
                                <i class="fas fa-edit"></i>
                            </div>
                        
                            <!-- Input file escondido -->
                            <input type="file" id="inputFile" style="display: none;" accept="image/*">

                    </section>

                </section>
    
            </main>
    
            <!-- PIE DE PAGINA -->
            <footer class="piePagina">
            
                <span class="derechosAutor">Derechos reservado MYLOOK</span>
            </footer>
    
        </section>
        <!-- ------------------------------------------------------ -->
        
        <!-- CRUD DE PRODUCTOS -->
        <section class="viewProductos" style="display: none;">

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
            
            <!-- CONTENEDOR DEL PRODUCTO A REFENRENCIAR -->
            <section class="cardItems">
                @foreach ($products as $product)
                <div class="cardUnited">
                    <article class="itemImg">
                        <img src="{{ $product['img_prod'] }}" alt="Imagen de Producto" class="img">
                    </article>
                        <h4 class="nomItem">{{ $product['nombre_prod'] }}</h4>
                        <p class="descripcion"> {{ $product['desc_prod'] }}
                        </p>
    
                        <div class="btnCrud">
                            <button type="submit" class="btnEdit">Editar</button>
                            <button type="submit" class="btnEdit" id="eliminarItem">Eliminar</button>
                        </div>
                    </div>         
                </div>
                @endforeach
            </section>
        </section>

        <!-- CRUD CATEGORIAS -->
        <section class="viewCategorias" style="display: none;" >

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

          
            
            <!-- CONTENEDOR DEL CATEGORIA A REFENRENCIAR -->
            <section class="cardItems">
                @foreach($categories as $category)
                <div class="cardUnited">
                <h4 class="nomItem">{{ strtoupper($category['nom_categoria']) }}</h4>

                <article class="itemImg">
                    <img src="{{ $category['imagen'] }}" alt="Imagen de Categoria" class="img">
                </article>
     
                    <div class="btnCrud">
                        <button type="submit" class="btnEdit">Editar</button>
                        <button type="submit" class="btnEdit" id="eliminarItem">Eliminar</button>
                    </div>
                </div>
                @endforeach
            </section>

        </section>

        <!-- CRUD TIPOS DE  TIPO SERVICIOS -->
        <section class="viewTipservicios" style="display: none;">
           
             <!-- VOLVER AL MENU INICIAL -->
             <span class="volver">
                <i class="fas fa-arrow-left"></i> 
                <h3 class="nomView">Gestion  Tipo Servicios</h3>
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
                    @foreach($categories as $category)
                    <option value="{{ $category['id_categoria'] }}">{{ $category['nom_categoria'] }}</option>
                    @endforeach
                </select>
            </div>
            </nav>

     
            
            <!-- CONTENEDOR DEL CATEGORIA A REFENRENCIAR -->
            <div class="cardItems">


                @foreach($typeServices as $typeService)
                <div class="cardUnited">
                    <h4 class="nomItem">{{ strtoupper($typeService['tipo_serv']) }}</h4>
                    <article class="itemImg">
                        <img src="" alt="">
                    </article>
                    <div class="btnCrud">
                        <button type="submit" class="btnEdit" value="{{ $typeService['id_tiposerv'] }}"><i class="fas fa-edit"></i></button>
                        <button type="submit" class="btnEdit" id="eliminarItem" value="{{ $typeService['id_tiposerv'] }}"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- CRUD DE SERVICIOS -->
        <section class="viewServicios" style="display: none;">
             <!-- VOLVER AL MENU INICIAL -->
             <span class="volver">
                <i class="fas fa-arrow-left"></i> 
                <h3 class="nomView">Gestion Servicios</h3>
            </span>

            <!-- FILTRADO DE PRODUCTOS -->
            <nav class="filter">

                <div class="option">
                    <button type="submit" id="btnInicio" class="optionGestion"> TODO</button>
                    <button type="submit" class="optionGestion">RECIENTES</button>
                    <button type="submit" class="optionGestion">RANKING</button>
                </div> 

                <div class="searchBar">
                    <select name="service" class="inputSearch">
                        <option value="" disabled selected>Seleccione un tipo de servicio</option>
                        @foreach($typeServices as $typeService)
                        <option value="{{ $typeService['id_tiposerv'] }}">{{ $typeService['tipo_serv'] }}</option>
                        @endforeach
                    </select>
                </div>
            </nav>
            
            <!-- CONTENEDOR DEL PRODUCTO A REFENRENCIAR -->
            <section class="cardItems">
                @foreach($services as $service)    
                    <div class="cardUnited">
                        <article class="itemImg">
                            <img src="{{ $service['img_serv'] }}" alt="Imagen de Servicio" class="img">
                        </article>
        
                        <div class="infoItem">
                            <h3 class="nomNegocio">Warrior Barber Club</h3>
                            <h2 class="nomItem">{{ $service['nom_servicio'] }}</h4>
                            <p class="precio">$ {{ $service['precio_servicio'] }} CO</p>
        
                                <div class="btnCrud">
                                    <button type="submit" class="btnEdit">EDITAR SERVICIO</button>
                                </div>
        
                            <p class="descripcion">{{ $service['desc_servicio'] }} </p>
                            <p class="time">{{ $service['duracion_serv'] }} Minutos</p>
    
                        </div>
                    </div>
                </div>
                @endforeach
            </section>
        </section>

<!------------------------------------------------------------ -->

<script src="/Js/Admin/indexAdmin.js"></script>
</body>
</html>