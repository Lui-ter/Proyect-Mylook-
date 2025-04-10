<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Establecimiento</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <main>

        <div class="portada"
            style="background-image: url(https://img.freepik.com/foto-gratis/sillas-vintage-peluqueria_155003-10150.jpg?t=st=1741447697~exp=1741451297~hmac=01d30b991787161b9275570c9079ef23f665daf1e5feb8ccd7e2139910268521&w=1060);">
            <div class="izquierda">
                <figure>
                    <img src="https://d1yjjnpx0p53s8.cloudfront.net/logotipo-imperio-barberia-vector1.png" alt="">
                </figure>
            </div>
            <div class="derecha">
                <div class="contenido-derecha">
                    <div class="nombre-direccion">
                        <h2 class="nombre">IMPERIO BARBER</h2>
                        <h3 class="direccion">CRA 23 #56-96 <i class="fa-solid fa-location-dot"></i>
                        </h3>
                    </div>
                    <div class="descripcion-boton">
                        <p class="descripcion">En Imperio Barber más que un corte, vivimos la experiencia. Nuestro
                            espacio
                            está diseñado para
                            que te
                            relajes, disfrutes y salgas con un estilo que hable por ti. Desde cortes clásicos hasta
                            estilos
                            urbanos modernos, nuestro staff está listo pa’ dejarte como un verdadero rey. ¡Tu imagen es
                            nuestra
                            pasión!.</p>
                        <form action="{{ url('/usuarios/agendar') }}" method="GET">
                            <button class="boton-agendar">
                                <div class="icono">
                                    <img width="100" height="100"
                                        src="https://img.icons8.com/ios-filled/100/FFFFFF/event-accepted-tentatively.png"
                                        alt="event-accepted-tentatively" />
                                </div>
                                <span>AGENDAR</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <section class="carruseles">
            <section>
                <h2 class="titulo">NUESTRAS CATEGORIAS</h2>
                <div class="carrusel-container">
                    <button id="btn-prev-servicios" class="carrusel-btn"><i class="fa-solid fa-caret-left"></i></button>
                    <div class="lista" id="lista-servicios">
                        <div class="tarjeta tarjeta-servicio">
                            <img src="https://img.freepik.com/foto-gratis/vista-posterior-mujer-cortando-primer-plano-cabello-su-cliente_23-2148353439.jpg"
                                alt="Servicio 1" class="img-servicio">
                            <div class="contenido-tarjeta">
                                <h3 class="nombre-servicio">Corte de cabello</h3>
                                <p class="descripcion">Clásico o moderno, como tú quieras.</p>
                            </div>
                        </div>

                        <div class="tarjeta tarjeta-servicio">
                            <img src="https://miriam.mx/assets/img/_1200x630_crop_center-center_82_none/Depilaci%C3%B3n-de-ceja-para-hombres.jpg?mtime=1695688258"
                                alt="Servicio 2" class="img-servicio">
                            <div class="contenido-tarjeta">
                                <h3 class="nombre-servicio">Perfilado de cejas</h3>
                                <p class="descripcion">Definición precisa con navaja o máquina, según tu estilo.</p>
                            </div>

                        </div>
                        <div class="tarjeta tarjeta-servicio">
                            <img src="https://img.freepik.com/foto-gratis/hombre-guapo-barberia-afeitado-barba_1303-26258.jpg?t=st=1744074655~exp=1744078255~hmac=d303756569cf3f14333bd35388314d7b4630db80c09651317a12853b91bb28fe&w=996"
                                alt="Servicio 2" class="img-servicio">
                            <div class="contenido-tarjeta">
                                <h3 class="nombre-servicio">Afeitado</h3>
                                <p class="descripcion">Con navaja tradicional o máquina.</p>
                            </div>
                        </div>
                        <div class="tarjeta tarjeta-servicio">
                            <img src="https://img.freepik.com/foto-gratis/encantadora-dama-adulta-pelo-corto-ondulado-lila-aretes-redondos-camisa-blanca-sobre-rosa-aislado_197531-19239.jpg?t=st=1744075030~exp=1744078630~hmac=bdb1cce3cc6e6bc77a1c1ddfa968a77d80ba8e6feacdb138341420ad2a4305c4&w=996"
                                alt="Servicio 2" class="img-servicio">
                            <div class="contenido-tarjeta">
                                <h3 class="nombre-servicio">Tinte</h3>
                                <p class="descripcion">Aplicación de tinte para definir el estilo y resaltar la mirada.
                                </p>
                            </div>

                        </div>

                    </div>
                    <button id="btn-next-servicios" class="carrusel-btn"><i
                            class="fa-solid fa-caret-right"></i></button>
                </div>
            </section>

            <section>
                <h2 class="titulo">NUESTRO EQUIPO</h2>
                <div class="carrusel-container">
                    <button id="btn-prev-staff" class="carrusel-btn"> <i class="fa-solid fa-caret-left"></i>
                    </button>
                    <div class="lista" id="lista-staff">
                        <div class="tarjeta carta-staff">

                            <figure class="carta-imagen" id="foto-staff">
                                <img src="https://img.freepik.com/foto-gratis/peluqueria-limpieza-condensador-ajuste-electrico-cepillo_23-2147839780.jpg?t=st=1744085927~exp=1744089527~hmac=dc5900010ee9c151988a8f4dcdf830a9aea6dbd2a1a08f09836249aaca6c82a2&w=740"
                                    alt="">
                                <p class="rol">Barbero</p>
                            </figure>
                            <h3>Pedro Neto</h3>

                        </div>
                        <div class="tarjeta carta-staff">

                            <figure class="carta-imagen" id="foto-staff">
                                <img src="https://img.freepik.com/foto-gratis/peluquero-masculino-joven-confiado-que-lleva-uniforme-que-sostiene-que-cruza-sciccors-peine-aislado-pared-verde-oliva_141793-105721.jpg?t=st=1744085620~exp=1744089220~hmac=4cdf41d3ce7f6c6f814717af9bf8daf59b7c295349a173acd89ca76cb2e50f53&w=826"
                                    alt="">
                                <p class="rol">Barbero</p>
                            </figure>
                            <h3>Pedro Neto</h3>

                        </div>
                        <div class="tarjeta carta-staff">

                            <figure class="carta-imagen" id="foto-staff">
                                <img src="https://img.freepik.com/foto-gratis/dueno-peluqueria-latina-preparandose-clientes_23-2150286080.jpg?t=st=1744085651~exp=1744089251~hmac=7fed54a2e0278c4198b5b52879588716cd879d7d35118f128d98bcdc2022120c&w=740"
                                    alt="">
                                <p class="rol">Barbero</p>
                            </figure>
                            <h3>Pedro Neto</h3>

                        </div>
                        <div class="tarjeta carta-staff">

                            <figure class="carta-imagen" id="foto-staff">
                                <img src="https://img.freepik.com/foto-gratis/hombre-tatuajes-produciendo-cerveza-artesana_23-2148110856.jpg?t=st=1744085809~exp=1744089409~hmac=79e6852262794711be854d8c352db266d35afc784b8308557b1ca3a3b2b8b270&w=740"
                                    alt="">
                                <p class="rol">Barbero</p>
                            </figure>
                            <h3>Pedro Neto</h3>

                        </div>


                    </div>
                    <button id="btn-next-staff" class="carrusel-btn"> <i class="fa-solid fa-caret-right"></i>
                    </button>
                </div>
            </section>

            <section>

                <h2 class="titulo">NUESTROS PRODUCTOS</h2>
                <div class="carrusel-container">
                    <button id="btn-prev-productos" class="carrusel-btn"><i class="fa-solid fa-caret-left"></i></button>
                    <div class="lista" id="lista-productos">
                        <div class="tarjeta producto">
                            <figure class="carta-imagen">
                                <img src="https://www.ruufe.com/cdn/shop/files/egogel3_1e2b67f3-3286-4939-9cf2-541151bf22dd.jpg?v=1740001391"
                                    alt="">
                                <p class="stock"><i class="fa-solid fa-boxes-stacked"></i> 23
                                </p>
                                <p class="precio"><span>40.000 COP</span></p>
                            </figure>
                            <div class="contenido-tarjeta">
                                <h3>Gel EGO</h3>
                                <p>Fijador de alta resistencia que mantiene tu peinado en su lugar durante todo el día.
                                </p>
                                <button>SOLICITAR</button>
                            </div>
                        </div>
                        <div class="tarjeta producto">
                            <figure class="carta-imagen">
                                <img src="https://elmeromacho.co/cdn/shop/files/CeraOssionMateVerde5.jpg?v=1722994802&width=480"
                                    alt="">
                                <p class="stock"><i class="fa-solid fa-boxes-stacked"></i> 15</p>
                                <p class="precio"><span>35.000 COP</span></p>
                            </figure>
                            <div class="contenido-tarjeta">
                                <h3>Cera Mate</h3>
                                <p>Acabado natural sin brillo para un look definido y moderno.</p>
                                <button>SOLICITAR</button>
                            </div>
                        </div>

                        <div class="tarjeta producto">
                            <figure class="carta-imagen">
                                <img src="https://www.fusionselvatica.com/cdn/shop/products/ANTICASPA450_50204429-98b2-4fe1-9653-e53832426a91.png?v=1680705514"
                                    alt="">
                                <p class="stock"><i class="fa-solid fa-boxes-stacked"></i> 8</p>
                                <p class="precio"><span>50.000 COP</span></p>
                            </figure>
                            <div class="contenido-tarjeta">
                                <h3>Shampoo Anti-Caspa</h3>
                                <p>Elimina la caspa y refresca el cuero cabelludo desde el primer uso.</p>
                                <button>SOLICITAR</button>
                            </div>
                        </div>

                        <div class="tarjeta producto">
                            <figure class="carta-imagen">
                                <img src="https://www.oboticario.com.co/cdn/shop/files/73794-2-MALBEC-BALSAMO-POST-BARBA-CLUB-100G_1500x.jpg?v=1725046774"
                                    alt="">
                                <p class="stock"><i class="fa-solid fa-boxes-stacked"></i> 30</p>
                                <p class="precio"><span>28.000 COP</span></p>
                            </figure>
                            <div class="contenido-tarjeta">
                                <h3>Crema para Barba</h3>
                                <p>Hidrata, suaviza y moldea tu barba para un look impecable.</p>
                                <button>SOLICITAR</button>
                            </div>
                        </div>



                    </div>
                    <button id="btn-next-productos" class="carrusel-btn"><i
                            class="fa-solid fa-caret-right"></i></button>
                </div>
            </section>
        </section>

        <section class="comentarios">
            <h2 class="titulo">COMENTARIOS</h2>
            <div class="tarjeta-testimonio">
                <div class="imagen-perfil">
                    <img src="https://image.ondacero.es/clipping/cmsimages02/2017/03/09/959B78F7-9584-4170-8486-01647BB6B845/98.jpg?crop=640,360,x0,y0&width=1900&height=1069&optimize=high&format=webply"
                        alt="Alejandro Sarasty">
                </div>
                <div class="contenido-testimonio">
                    <h2 class="nombre">RAUL GONZALES</h2>
                    <p class="texto-resena">El establecimiento es súper limpio y moderno. El ambiente es relajante y el
                        personal muy profesional. ¡Siempre salgo feliz y renovado!</p>
                    <div class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <div class="tarjeta-testimonio">
                <div class="imagen-perfil">
                    <img src="https://elcomercio.pe/resizer/v2/473EX5Z3BVEIJOZOU2JCAPMNRU.jpg?auth=eef104e99ffd527d30d9015d2b24d71fe41b94e5116407017b5a431d0490321b&width=1200&height=810&quality=90&smart=true"
                        alt="Laura Gómez">
                </div>
                <div class="contenido-testimonio">
                    <h2 class="nombre">LAURA GÓMEZ</h2>
                    <p class="texto-resena">Increíble servicio. Siempre encuentro disponibilidad y el proceso es súper
                        rápido y sencillo.</p>
                    <div class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="tarjeta-testimonio">
                <div class="imagen-perfil">
                    <img src="https://www.biografia.de/wp-content/uploads/La-Cobra.webp" alt="Carlos Méndez">
                </div>
                <div class="contenido-testimonio">
                    <h2 class="nombre">CARLOS MÉNDEZ</h2>
                    <p class="texto-resena">Gracias a esta app, agendar mis servicios favoritos es cuestión de segundos.
                        ¡Muy recomendada!</p>
                    <div class="calificacion">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>



        </section>
    </main>
    <script src="app.js"></script>
</body>

</html>
