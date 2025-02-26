<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"  href="{{ asset('Css/Index/IndexAgendamiento.css') }}">
    <title>Index Agendamiento - MYLOOK</title>
</head>
<body>
    
   
    <!-- SECCION DE IMAGEN DE PUBLICIDAD DE ESTABLECIMIENTOS -->
    <section class="sectionPublicidad">

        <!-- MENU DE NAVEGACION DEL USUARIO CON RESPECTO A SU INDEX -->
        <nav class="menuUsuario">

            <h1 class="nomApp">MYLOOK</h1>

            <ul class="menuNav">
                <li>
                    <button type="submit" class="optionNav btnInicio">Inicio</button>
                    <button type="submit" class="optionNav">Ranking</button>
                    <button type="submit" class="optionNav">Ubicaciones</button>
                    <button type="submit" class="optionNav">Sitios</button>
                    <img src="" alt="" class="imgPerfil">

                </li>
            </ul>
        </nav>

        <!--CONTENEDOR IMAGEN DE PUBLICIDAD DE ESTABLECIMIENTOS -->
        <figure class="imgEstablecimientos">
            <img src="https://st2.depositphotos.com/1001094/8449/i/450/depositphotos_84497136-stock-photo-barber-shop-in-amsterdam.jpg" alt="" class="imgPublicitaria">
        </figure>


        <span class="logoEstablecimientos">

            <figure class="logoEstablecimiento">
                <img src="https://previews.123rf.com/images/farhad73/farhad732105/farhad73210500028/169500877-concepto-de-dise%C3%B1o-de-barber%C3%ADa-con-poste-de-barbero.jpg" alt="" class="logo">
            </figure>

            <h2 class="nomEstablecimientos">{{$establecimiento['nombre_establc']}}</h2>

        </span>

    </section>

    <!-- SECCION PARA VISUALIZAR PRODUCTOS EN EL ESTABLECIMIENTOS -->
    <section class="sectionProductos">

        <span class="tittleProductos">
            <h3 class="nomTittle">PRODUCTOS DE IMPERIO BARBER PLUS HD</h3>
        </span>

        <article class="itemProductos">
            @foreach($productos as $producto)
            <div class="contianerProducto">
                <figure class="productoItem">
                    <img src="{{$producto['img_prod']}}" alt="" class="imgProducto">
                </figure>

                <article class="infoProducto">

                    <h3 class="nomProducto">{{$producto['nombre_prod']}}</h3>

                    <p class="txtProducto">
                        {{$producto['desc_prod']}}
                    </p>
                </article>

                <div class="btnRediret">
                    <button type="submit" class="btnSeparar">Agregar</button>
                    <button type="submit" class="btnSeparar">Ver detalle</button>
                </div>
            </div>
            @endforeach
        </article>

    </section>

    <!-- SECCION DE INVITAR A AGENDAR A ESE ESTABLECIMIENTO -->
    <section class="sectionReserva">

        <article class="introReserva">
            <p class="nomReserva">Consigue un cambio de look en <strong>{{$establecimiento['nombre_establc']}}</strong> con la 
                asesoria de nuestro barberos profesionales encargados de brindarte una expriencia inolvidable.
            </p>
        </article>
        <span class="rediretReserva">
            <a href="http://" class="rediret Reserva">RESERVAR AHORA</a>
            <a href="http://" class="rediret Contactanos">LLAMANOS</a>
        </span>
        
    </section>

    <!-- SECCION DE SERVICIOS DE EL ESTABLECIMIENTO EN VISUALIZACION -->
    <section class="sectionServicios">
        <span class="allServices">
            <a href="#" class="nomAll">VER TODOS...</a>
        </span>

        <article class="categoriesSevices">

            <div class="containerUnited">
                <article class="servicesPrincipal">
                    <img src="{{$categorias['0']['imagen']}}" alt="" class="imgService">
                    <div class="serviceName">{{$categorias['0']['nom_categoria']}}</div> <!-- Nombre del servicio -->
                </article>
            </div>

            <div class="continerRoad">

                <article class="roadServices">
                    <img src="{{$categorias['1']['imagen']}}" alt="" class="imgService">
                    <div class="serviceName">{{$categorias['1']['nom_categoria']}}</div> <!-- Nombre del servicio -->
                </article>

                <article class="roadServices">
                    <img src="{{$categorias['2']['imagen']}}" alt="" class="imgService">
                    <div class="serviceName">{{$categorias['2']['nom_categoria']}}</div> <!-- Nombre del servicio -->
                </article>

                <article class="roadServices">
                    <img src="{{$categorias['3']['imagen']}}" alt="" class="imgService">
                    <div class="serviceName">{{$categorias['3']['nom_categoria']}}</div> <!-- Nombre del servicio -->
                </article>

                <article class="roadServices">
                    <img src="{{$categorias['4']['imagen']}}" alt="" class="imgService">
                    <div class="serviceName">{{$categorias['4']['nom_categoria']}}</div> <!-- Nombre del servicio -->
                </article>

            </div>

        </article>

    </section>

    <!-- SECCION PARA VISUALIZAR EL STAFF -->
    <section class="sectionStaff">
        <span class="cardStaff">

            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

            
            <article class="cardUnited">
                <img src="https://barberroom.co/wp-content/uploads/2020/05/10_de_diciembre_-42_3678-1023x682-1.jpg" alt="" class="imgStaff">
                <div class="nameStaff">ALEJANDRO AGUILON BUITRAGO</div> <!-- El nombre del miembro del staff -->
            </article>

        </span>
    </section>

    <!-- SECCION PARA VISUALIZAR LOS COMENTARIOS DE MYLOOK -->
    <section class="sectionComentarios">

        <nav class="optionComment">
            <button type="submit" class="btnComment allComment">Todos</button>
            <button type="submit" class="btnComment">Más Calificados</button>
            <button type="submit" class="btnComment">Menos Calificados</button>
            <button type="submit" class="btnComment">Más Recientes</button>
        </nav>

        <div class="containerComentarios">
        @foreach($valoraciones as $valoracion)
    <article class="commentUnited">
        
        <figure class="imgPerfil">
            <!-- Mostrar la imagen del usuario si existe, de lo contrario, una imagen por defecto -->
            <img src="{{ $valoracion['cita']['usuario']['imagen_base64'] ?? 'https://media.istockphoto.com/id/1364917563/de/foto/gesch%C3%A4ftsmann-l%C3%A4chelt-mit-verschr%C3%A4nkten-armen-auf-wei%C3%9Fem-hintergrund.jpg?b=1&s=612x612&w=0&k=20&c=uu4AnlKd8Y8bTRU2eqymMrHuMgRtzyrkAUPlIE35z_c=' }}" alt="Imagen del usuario" class="imgUnited">
        </figure>

        <div class="descripPerfil">
            <h3 class="nomPerfil">{{ $valoracion['cita']['usuario']['nombre'] ?? 'Nombre no disponible' }}</h3>

            <p class="commentPerfil">{{ $valoracion['comentario'] ?? 'Comentario no disponible' }}</p>

            <figure class="valComment">
                <div class="startVal">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $valoracion['calificacion'] >= $i ? 's' : 'r' }} fa-star"></i>
                    @endfor
                </div>

                <div class="fechVal">
                    <p class="fecha">{{ \Carbon\Carbon::parse($valoracion['cita']['fecha_cita'])->format('l') }}</p>
                </div>
            </figure>
        </div>
    </article>
@endforeach

        </div>

    </section>

    <!-- SECCION FOOTER DE MYLOOK -->
    <section class="sectionFooter">

            <!-- SECCION DE FOOTER SOBRE NOSOTROS -->
            <article class="infoFooter infoUno">
    
                <span class="infoSTA">
                    <h3 class="tittleNosotros">Sobre Nosotros</h3>
                    <p class="descrip">¿ Quienes somos ?</p>
                    <p class="descrip">Contactanos</p>
                    <p class="descrip">Centro de ayuda</p>
    
                    <span class="socialMediaFooter">
                        <!-- Icono Facebook -->
                        <i class="fab fa-facebook-f social-icon"></i>
    
                        <!-- Icono WhatsApp -->
                        <i class="fab fa-whatsapp social-icon"></i>
    
                        <!-- Icono YouTube -->
                        <i class="fab fa-youtube social-icon"></i>
    
                        <!-- Icono Twitter -->
                        <i class="fab fa-twitter social-icon"></i>
    
                        <!-- Icono Instagram -->
                        <i class="fab fa-instagram social-icon"></i>
                    </span>
                </span>
            </article>
    
            <!-- SECCION DE FOOTER LOGO DE DESARROLLADORES -->
            <article class="infoFooter">
    
                <span class="infoSTA infoMedio">
                    <i class="fas fa-lightbulb"></i>
                    <h3 class="tittleDesarrollo">STA</h3>
                </span>
            </article>
    
            <!-- SECCION DE FOOTER SOBRE CONTACTANOS -->
            <article class="infoFooter infoTres">
    
                <span class="infoSTA">
    
                    <!-- FORMULARIO DE INSERCCION DE INFORMACION SOBRE ACTUALIZACIONES DE MYLOOK -->
                    <form action="" method="post" class="formPromocion">
    
                         <!-- Icono Correo -->
                         <i class="fas fa-envelope"></i>   
                        <input type="email" name="emailPromocion" id="email" placeholder="Ingresa tu correo..." class="inputPromocion"> 
                        <button type="submit" class="btnPromocion">Enviar</button>           
                    </form>
    
                    <!-- NOTA QUE EXPLICA QUE HACE EL FORMULARIO DE ARRIBA -->
                    <span class="notaForm">
                        <p class="nota"><strong>Nota: </strong>La inscripcion del correo sera beneficioso para saber todos los detalles de nuestras futuras actualizaciones
                        
                        </p>
                    </span>
                </span>
            </article>
    
    </section>
    
</body>
</html>