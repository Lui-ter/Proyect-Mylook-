<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .modal-personalizado {
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(91, 89, 89, 0.512);
            z-index: 1000;
            /* Lo ocultamos por defecto */
            display: none;
        }

        .contenido-modal-personalizado {
            background-color: var(--color-white);
            border-radius: 0.4em;
            padding: 1em;
            width: 50%;
            box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
            animation: deslizamiento 0.4s ease-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.5em;
            align-items: center;
            position: relative;
            z-index: 2000;
        }

        .btn-cerrar {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: clamp(1em, 2vw, 5em);
            color: var(--color-black);
            cursor: pointer;
            transition: color 0.3s ease;
        }
                            
    </style>
</head>
<body>
    Robert, solo copie lo necesario del css del indexAdmin y su js. ya tu modificas todo eso. ya trae lo mismo como el calendario menos los productos
    
    <!-- MODAL -->
                    {{-- fondo de modal --}}
                    <div id="detalleCitaModal" class="modal-personalizado">

                        {{-- contenido modal --}}
                        <div class="contenido-modal-personalizado">
                            <span class="btn-cerrar" onclick="cerrarModal()">&times;</span>
                            <h3 class="encabezado-modal">Detalles</h3>
                            <div class="cuerpo-modal">
                                <div class="seccion-modal">
                                    <h4 class="subtitulo-modal">Información de la Cita</h4>
                                    <div class="informacion-modal">
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Empleado:</strong></div>
                                            <div class="campo-modal"><span id="modalEmpleado"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Usuario:</strong></div>
                                            <div class="campo-modal"><span id="modalUsuario"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Establecimiento:</strong></div>
                                            <div class="campo-modal"><span id="modalEstablecimiento"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Servicio:</strong></div>
                                            <div class="campo-modal"><span id="modalServicio"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Fecha:</strong></div>
                                            <div class="campo-modal"><span id="modalFecha"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Hora Inicio:</strong></div>
                                            <div class="campo-modal"><span id="modalHoraInicio"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Hora Fin:</strong></div>
                                            <div class="campo-modal"><span id="modalHoraFin"></span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="seccion-modal">
                                    <h4 class="subtitulo-modal">Estado de la Cita</h4>
                                    <div class="informacion-modal">
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Estado:</strong></div>
                                            <div class="campo-modal"><span id="modalEstado"></span></div>
                                        </div>
                                    </div>
                                </div>

                                <form class="formulario-modal" action="{{ route('admin', ['accion' => 'solicitud']) }}"
                                    method="POST">
                                    @csrf
                                    <input class="input-oculto-modal" type="hidden" id="modalIdCita" name="id_cita">
                                    <div class="acciones-modal">
                                        <input class="boton-modal cancelar" type="submit" name="resultado"
                                            value="eliminar">
                                        <input class="boton-modal aceptar" type="submit" name="resultado"
                                            value="aceptar">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    <div id='calendar'></div> 






    {{-- script para la importacion de fullcalendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    {{-- script de la logica de el calendario --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtiene el elemento donde se renderizará el calendario
            var calendarEl = document.getElementById('calendar');

            // Inicializa el calendario
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', // Vista inicial: semana
                locale: 'es', // Idioma español
                allDayText: 'Tiempo', // Texto para eventos de todo el día
                allDaySlot: false, // Ocultar slot de todo el día

                // Configuración de la barra de herramientas del header
                headerToolbar: {
                    start: 'today', // Botón de hoy a la izquierda
                    center: 'title', // Título en el centro
                    end: 'prev,next' // Botones de navegación a la derecha
                },

                // Formato del título (mes, día y año)
                titleFormat: {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                },

                // Formato de las horas en las columnas
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true // Formato 12 horas
                },

                // Formato de la hora en los eventos
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                },

                // Formato de los encabezados de los días
                dayHeaderFormat: {
                    weekday: 'short', // Nombre corto del día (Lun, Mar, etc.)
                    day: 'numeric'
                },

                // Texto personalizado para el botón de "hoy"
                buttonText: {
                    today: 'HOY'
                },

                // Carga de eventos
                events: @json($arreglo).map(event => {
                    // Asigna clase CSS basada en el estado del evento
                    event.className = event.estado?.toLowerCase() === 'aceptado' ? [
                        'evento-aceptado'
                    ] : [];
                    return event;
                }),

                // Personaliza el contenido del evento
                eventContent: function(arg) {
                    const estado = arg.event.extendedProps.estado;
                    const esAceptado = estado?.toLowerCase() === 'aceptado';

                    return {
                        html: `<i class="fas fa-info-circle"></i>`, // Ícono en el evento
                        classNames: esAceptado ? ['evento-aceptado'] :
                        [] // Aplica clase si está aceptado
                    };
                },

                // Se ejecuta cuando un evento se monta en el DOM
                eventDidMount: function(info) {
                    if (info.event.extendedProps.estado?.toLowerCase() === 'aceptado') {
                        info.el.classList.add(
                        'evento-aceptado'); // Agrega clase CSS si el evento está aceptado
                    }
                },

                // Se ejecuta al cambiar de vista en el calendario
                datesSet: function() {
                    document.querySelectorAll('.fc-event').forEach(eventEl => {
                        const eventId = eventEl.getAttribute('data-event-id');
                        const eventObj = calendar.getEventById(eventId);
                        if (eventObj && eventObj.extendedProps.estado?.toLowerCase() ===
                            'aceptado') {
                            eventEl.classList.add('evento-aceptado');
                        }
                    });
                },

                // Maneja el clic sobre un evento
                eventClick: function(info) {
                    const evento = info.event.extendedProps;
                    console.log("Datos extendidos del evento: ", evento);

                    // Actualiza los datos del modal con la información del evento
                    document.getElementById('modalEmpleado').textContent = evento.empleado ||
                        'No definido';
                    document.getElementById('modalUsuario').textContent = evento.usuario ||
                        'No definido';
                    document.getElementById('modalEstablecimiento').textContent = evento
                        .establecimiento || 'No definido';
                    document.getElementById('modalFecha').textContent = info.event.start
                        .toLocaleDateString();
                    document.getElementById('modalHoraInicio').textContent = info.event.start
                        .toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    document.getElementById('modalHoraFin').textContent = info.event.end ? info.event
                        .end.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        }) : 'N/A';
                    document.getElementById('modalEstado').textContent = evento.estado || 'Sin estado';

                    document.getElementById('modalServicio').textContent = evento.servicio || 'Sin estado';

                    // Guarda el ID de la cita en un input hidden
                    document.getElementById('modalIdCita').value = evento.id_cita;

                    // Muestra el modal de detalle
                    document.getElementById('detalleCitaModal').style.display = 'flex';
                }
            });

            // Renderiza el calendario en la página
            calendar.render();

            // Refresca los eventos y ajusta el tamaño del calendario tras 100 ms
            setTimeout(() => {
                calendar.refetchEvents();
                calendar.updateSize();
            }, 100);

            // Maneja el evento de redimensionamiento de la ventana
            window.addEventListener('resize', function() {
                calendar.batchRendering(() => {
                    calendar.getEvents().forEach(event => {
                        event.setProp('title', event
                        .title); // Forzar actualización de títulos
                    });
                });
            });
        });
        //cerrar el modal
        function cerrarModal() {
            document.getElementById("detalleCitaModal").style.display = "none";
        }
    </script>
</body>
</html>