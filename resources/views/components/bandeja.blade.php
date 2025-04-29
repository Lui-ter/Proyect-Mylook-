<meta name="csrf-token" content="{{ csrf_token() }}">
<aside class="contenedor-bandeja" id="sidebar">
    <div class="encabezado-bandeja">
        <p>BANDEJA DE ENTRADA</p>
    </div>
    <div class="contenido-bandeja">  
        @foreach ($notificaciones as $notificacion )
        <div class="elemento-bandeja" id="notificacion-{{ $notificacion['id_notificacion'] }}">
            <div class="contenedor-fecha">
                <div class="numero-fecha">{{ $notificacion['fecha'] ?? 'No se encontró' }}</div>
            </div>
            <div class="texto-solicitud">{{ $notificacion['titulo'] ?? 'No se encontró' }}</div>
            <div class="contenedor-icono">
                <button class="button-borrar-notificacion" data-id="{{ $notificacion['id_notificacion'] }}">X</button>
            </div>
        </div>
        @endforeach 
    </div>
</aside>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", system-ui, -apple-system, BlinkMacSystemFont,
            "Segoe UI";
    }

    html {
        html {
            scroll-behavior: smooth;
        }
    }

    /* Variables de css*/
    :root {
        --color-primary: #a68160;
        --color-secondary: #f2f2f2;
        --color-white: white;
        --color-black: black;
    }

    .contenedor-bandeja {
        position: fixed;
        /* Flotante y fuera del flujo del documento */
        top: 15%;
        left: 1%;
        width: 100%;
        border-radius: 0.8em;
        overflow: hidden;
        flex: 1;
        z-index: 100;
        max-width: 30vw;
        min-height: 60vh;
        max-height: 80vh;
        transform: translateX(-200%);
        /* Oculta hacia la derecha */
        transition: transform 0.5s ease;


        .encabezado-bandeja {
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: 0.8em;
            font-weight: bold;
            text-align: center;
            font-size: clamp(1em, 1.1vw, 3em);
            letter-spacing: 0.5px;
        }

        /* Contenido con scroll */
        .contenido-bandeja {
            padding: 0.7em;
            height: 70.9vh;
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            overflow-y: auto;
            border-left: 2px solid var(--color-primary);
            border-right: 2px solid var(--color-primary);
            border-bottom: 2px solid var(--color-primary);
            border-radius: 0 0 0.7em 0.7em;
            background-color: var(--color-secondary);

            /* Elemento individual */
            .elemento-bandeja {
                flex: 1;
                display: flex;
                align-items: center;
                background-color: var(--color-white);
                border: 1px solid var(--color-black);
                border-radius: 0.4em;
                max-height: 10vh;

                /* Contenedor de fecha */
                .contenedor-fecha {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100%;
                    margin-right: 0.7em;
                    padding: 0.4em 0.7em;
                    border-right: 1px solid var(--color-black);

                    .numero-fecha {
                        font-weight: bold;
                        font-size: clamp(.9em, 1.5vw, 10em);

                    }

                    .mes-fecha {
                        font-size: clamp(.9em, 1.5vw, 10em);
                    }
                }

                /* Texto de la solicitud */
                .texto-solicitud {
                    flex: 1;
                    font-size: clamp(.9em, 1.4vw, 10em);

                    font-weight: 600;
                }

                .contenedor-icono {
                    margin-right: clamp(.4em, 1vw, 3em);
                    margin-left: clamp(.2em, .1vw, 3em);
                    position: relative;
                }

                /* Sobre cerrado */
                .sobre {
                    border-radius: 0.1em;
                    position: relative;
                    font-size: clamp(1em, 1.5vw, 10em);
                    color: var(--color-primary);
                    /* Color para estado pendiente */
                }
            }

            .elemento_leido {
                background-color: var(--color-primary);
                color: white;
                border: 1px solid var(--color-primary);

                .contenedor-fecha {
                    border-color: var(--color-white);
                }

                .sobre {
                    color: var(--color-white);
                    font-size: clamp(1em, 1.5vw, 10em);
                }
            }

            /* Estilos para la barra de desplazamiento */
            .contenido-bandeja::-webkit-scrollbar {
                width: 6px;
            }

            .contenido-bandeja::-webkit-scrollbar-track {
                background: #e6d2b5;
            }

            .contenido-bandeja::-webkit-scrollbar-thumb {
                background-color: #b08968;
                border-radius: 6px;
            }
        }
    }

    /* Cuando se muestra */
    .contenedor-bandeja.mostrar {
        transform: translateX(0);
        /* Se mueve al lugar visible */
    }

    @media (max-width: 768px) {
        .contenedor-bandeja {
            max-width: 70vw;
            min-height: 50vh;
            top: 10%;
            left: 5%;
        }
    }
</style>
<script>
    // Mostrar u ocultar la bandeja con la campanita
    document.getElementById("toggle-bandeja").addEventListener("click", function(e) {
        e.stopPropagation(); // Evita que se cierre inmediatamente al hacer click
        document.getElementById("sidebar").classList.toggle("mostrar");
    });

    // Ocultar la bandeja si haces click fuera
    document.addEventListener("click", function(e) {
        const sidebar = document.getElementById("sidebar");
        const toggle = document.getElementById("toggle-bandeja");

        if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
            sidebar.classList.remove("mostrar");
        }
    });

    // Mostrar contenido (modal o sección) al hacer click en un elemento de la bandeja
    const elementosBandeja = document.querySelectorAll(".elemento-bandeja");
    const contenedorNotificacion = document.getElementById("notificacion");

    elementosBandeja.forEach(elemento => {
        elemento.addEventListener("click", () => {
            ocultarTodasLasSecciones();
            contenedorNotificacion.style.display = "grid"; // Muestra la info de la notificación
        });
    });

    //Eliminar una notificación visualmente
    document.querySelectorAll('.button-borrar-notificacion').forEach(button => {
    button.addEventListener('click', function() {
        let notificationId = this.dataset.id; // Obtiene el ID de la notificación
        let notificationElement = document.getElementById(`notificacion-${notificationId}`);

            fetch(`/delete-notificacion/${notificationId}`, {
                method: 'DELETE',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                if (response.ok) {
                    notificationElement.remove(); // Elimina visualmente la notificación
                }
            }).catch(error => console.error('Error:', error));
        });
    });
</script>
</body>

</html>
