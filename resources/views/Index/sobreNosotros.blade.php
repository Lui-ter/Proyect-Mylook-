<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quiénes Somos? - MyLook</title>
    <link rel="stylesheet" href="{{ asset('Css/Index/sobreNosotros.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>

<body>
    <main>
        <figure class="fondo">
            <img src="{{ asset('logov2.svg') }}" alt="Animación" class="imagen-animada" data-aos="fade-up">
            <h2><a href="#contenido">CONÓCENOS</a></h2>
        </figure>
        <section class="contenido" id="contenido">
            <div class="izquierda" data-aos="fade-right">
                <h1>¿Quiénes somos?</h1>
                <p>
                    En MyLook creemos que verte bien no debería quitarte tiempo.
                </p>
            </div>
            <div class="derecha" data-aos="fade-left">
                <p>
                    Somos una plataforma especializada en la gestión de citas para el sector de la belleza, conectamos a
                    personas con salones, estilistas y expertos en belleza, de forma rápida, práctica y segura, ya sea
                    un
                    corte de cabello, un facial o un diseño de uñas, todo está en un solo lugar y disponible cuando tú
                    lo
                    necesites.
                </p>
                <p class="destacado">
                    Tu tiempo vale y tu estilo también.
                </p>
            </div>
        </section>
        <section class="cartas" data-aos="fade-up">
            <div class="carta">
                <figure>
                    <img src="https://i.pinimg.com/736x/aa/f9/26/aaf9265bb46e8c6a20f39615cf3c094f.jpg" alt="Carta 1">
                    <figcaption>
                        <h3>MISION</h3>
                    </figcaption>
                </figure>
                <p>
                    Nuestra misión es transformar la experiencia de agendar servicios de belleza, brindando estilo,
                    confianza y comodidad en cada cita.
                </p>
            </div>

            <div class="carta">
                <figure>
                    <img src="https://i.pinimg.com/736x/3b/ef/b8/3befb8a1e80f8f964602a11a3ef513ce.jpg" alt="Carta 1">
                    <figcaption>
                        <h3>VISIÓN</h3>
                    </figcaption>
                </figure>
                <p>
                    Ser referencia en el sector de belleza, reinventando el cuidado personal a través de tecnología,
                    confianza y experiencias únicas.
                </p>
            </div>

            <div class="carta">
                <figure>
                    <img src="https://i.pinimg.com/736x/2b/42/ca/2b42ca1001c2bb04b906626f1dc2b873.jpg" alt="Carta 1">
                    <figcaption>
                        <h3>OBJETIVO</h3>
                    </figcaption>
                </figure>
                <p>
                    Ser la plataforma líder en agendamiento, conectando usuarios y profesionales con una experiencia
                    confiable y centrada en el cliente.
                </p>
            </div>
        </section>
        <section class="seccion-motivos" data-aos="zoom-in" data-aos-delay="100">
            <h2>¿Por qué elegir MyLook?</h2>
            <div class="motivos">
                <article class="motivo">
                    <figure>
                        <i class="fa-solid fa-star"></i>
                    </figure>
                    <p>Ofrecemos una experiencia intuitiva, diseñada tanto para clientes como para profesionales.</p>
                </article>

                <article class="motivo">
                    <figure>
                        <i class="fa-solid fa-bell"></i>
                    </figure>
                    <p>Pueden revisar y gestionar sus citas en cualquier momento, manteniendo todo al día.</p>
                </article>

                <article class="motivo">
                    <figure>
                        <i class="fa-solid fa-calendar-check"></i>
                    </figure>
                    <p>Agenda online y permite que clientes y profesionales gestionen citas de forma rápida y eficiente.
                    </p>
                </article>

                <article class="motivo">
                    <figure>
                        <i class="fa-solid fa-stopwatch"></i>
                    </figure>
                    <p>Permite encontrar servicios de calidad, comparar opciones y reservar en segundos.</p>
                </article>
            </div>

        </section>
    </main>
    <!-- JS de AOS al final del body -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Duración de las animaciones
            once: true // Solo se ejecuta una vez
        });
    </script>

</body>

</html>
