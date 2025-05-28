<header>
    <div class="contenedor-logo">
        <img src="{{ asset('logo.svg') }}" alt="Logo">
        <h2 class="my-look">MYLOOK</h2>
    </div>

    <div class="contenedor-opciones">
        <div class="contenedor-iconos">
            <a href="@yield('link-index')"><button class="contenedor-icono"><i
                        class="fa-solid fa-house-chimney"></i></button></a>
            <button class="contenedor-icono" id="toggle-bandeja"><i class="fa-solid fa-bell"></i></button>
        </div>
        <div class="contenedor-perfil" id="perfil">
            <figure>
                <img src="{{ $imgStaff }}" alt="Imagen de perfil">
            </figure>

            <div class="menu-perfil oculto" id="menu-perfil">
                <a href="@yield('link-configurar-perfil')">
                    <p>Configurar perfil</p>
                </a>
                <hr>
                <a href="@yield('link-configurar-establecimiento')">
                    <p>Configurar Establecimiento</p>
                </a>
                <hr>
                <a href="@yield('link-configurar-negocio')">
                    <p>Configurar negocio</p>
                </a>
                <hr>
                <a href="@yield('link-historial')">
                    <p>Historial de citas</p>
                </a>
                <hr>
                <a href="@yield('link-salir')">
                    <p>Salir</p>
                </a>
            </div>
        </div>
    </div>

</header>


@include('components.bandeja', ['notificaciones' => $notificaciones])

<style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");

    /* Reset básico y fuentes */
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Montserrat", system-ui, "Segoe UI", "Open Sans",
            "Helvetica Neue", sans-serif;
    }

    html {
        scroll-behavior: smooth;
    }


    /* Variables de css*/
    :root {
        --color-primary: #a68160;
        --color-secondary: #f2f2f2;
        --color-white: white;
        --color-black: black;
    }

    header {
        display: grid;
        grid-template-columns: 1fr 9fr;
        background-color: var(--color-secondary);
        color: var(--color-primary);
        justify-content: space-between;
        align-items: center;
        padding: 0em 1em;
        gap: 2em;
        z-index: 22;
        height: 11vh;

        .contenedor-logo {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1vw;

            h2 {

                font-size: clamp(1.4em, 3vw, 7vh);
                font-weight: bold;

            }

            img {
                width: clamp(1.9em, 3vw, 7vh);
                height: clamp(1.9em, 3vw, 7vh);

            }
        }

        .contenedor-opciones {
            display: flex;
            align-items: center;
            gap: 1vw;
            height: 100%;
            justify-content: end;

            .contenedor-iconos {
                display: flex;
                align-items: center;
                gap: 1vw;
                height: 100%;
                justify-content: end;

                .contenedor-icono {
                    height: 100%;
                    border: none;

                    i {
                        color: var(--color-primary);
                        font-size: clamp(.8em, 4.5vh, 7vh);
                        cursor: pointer;
                        transition: color 0.3s ease-in-out, transform 0.2s ease;
                    }

                    a {
                        text-decoration: none;

                        i {
                            color: var(--color-primary);
                            font-size: clamp(.8em, 4.5vh, 7vh);
                            cursor: pointer;
                            transition: color 0.3s ease-in-out, transform 0.2s ease;
                        }
                    }
                }
            }

            .contenedor-perfil {
                position: relative;
                cursor: pointer;

                figure {
                    width: clamp(.8em, 6vh, 7vh);
                    height: clamp(.8em, 6vh, 7vh);
                    border-radius: 100%;
                    cursor: pointer;
                    transition: transform 0.2s ease-in-out;

                    img {
                        width: 100%;
                        height: 100%;
                        border-radius: 100%;
                        object-fit: cover;
                        object-position: center;
                        transition: transform 0.2s ease-in-out;
                    }
                }

                .menu-perfil {
                    position: absolute;
                    top: 110%;
                    right: 0;
                    background-color: var(--color-white);
                    border: 1px solid var(--color-primary);
                    border-radius: .5em;
                    text-align: center;
                    min-width: 15em;

                    z-index: 100;
                    overflow: hidden;
                    background-clip: padding-box;

                    a {
                        padding: 1em;
                        cursor: pointer;
                        color: var(--color-primary);
                        text-decoration: none;

                        p {
                            font-weight: bold;
                            font-size: clamp(1em, 2vh, 5vh);
                            color: var(--color-primary);

                        }



                    }


                    a:hover {
                        background-color: var(--color-primary);

                        & p {
                            color: var(--color-white);
                        }
                    }


                    hr {
                        border: none;
                        border-top: 1px solid var(--color-primary);
                    }


                }

                .menu-perfil.oculto {
                    display: none;
                }

            }

        }
    }

    .animar-entrar {
        animation: slideDown 0.3s ease forwards;
        display: grid !important;
    }

    .animar-salir {
        animation: slideUp 0.3s ease forwards;
    }

    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: scaleY(0);
        }

        100% {
            opacity: 1;
            transform: scaleY(1);
        }
    }

    @keyframes slideUp {
        0% {
            opacity: 1;
            transform: scaleY(1);
        }

        100% {
            opacity: 0;
            transform: scaleY(0);
        }
    }
</style>


<script>
    const contenedorPerfil = document.getElementById('perfil');
    const menuPerfil = document.getElementById('menu-perfil');

    contenedorPerfil.addEventListener('click', () => {
        if (menuPerfil.classList.contains('oculto')) {
            menuPerfil.classList.remove('oculto', 'animar-salir');
            menuPerfil.classList.add('animar-entrar');
        } else {
            menuPerfil.classList.remove('animar-entrar');
            menuPerfil.classList.add('animar-salir');

            menuPerfil.addEventListener('animationend', function ocultar() {
                menuPerfil.classList.add('oculto');
                menuPerfil.removeEventListener('animationend', ocultar);
            });
        }
    });

    // Cerrar menús al hacer clic fuera
    document.addEventListener('click', (event) => {
        if (
            !contenedorPerfil.contains(event.target) &&
            !menuPerfil.contains(event.target) &&
            !menuPerfil.classList.contains('oculto')
        ) {
            menuPerfil.classList.remove('animar-entrar');
            menuPerfil.classList.add('animar-salir');
            menuPerfil.addEventListener('animationend', function ocultar() {
                menuPerfil.classList.add('oculto');
                menuPerfil.removeEventListener('animationend', ocultar);
            });
        }
    });
</script>
