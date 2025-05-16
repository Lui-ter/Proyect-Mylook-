<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio Staff</title>
    <link rel="stylesheet" href="{{ asset('Css/index/indexStaff.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body>
    <main>
        <section class="informacion-staff">
            <article class="carta-staff">
                <p class="oculto">TU PERFIL</p>
                <figure>
                    @if ($staff->usuario->img_usuario)
                        <img src="data:image/png;base64,{{ base64_encode($staff->usuario->img_usuario) }}"
                            alt="miembro del staff">
                    @endif

                </figure>
                <div class="datos-staff">
                    <h1>{{ $staff->establecimiento->nombre_establc }}</h1>
                    <h2>{{ $staff->usuario->nombre }} {{ $staff->usuario->apellido }}</h2>
                    <p>{{ $staff->rol->nombre_rol }}</p>
                    <p>{{ $staff->usuario->correo }}</p>
                    <p>{{ $staff->usuario->telefono }}</p>
                </div>
            </article>
            <article class="citas-proximas">
                <h2>CITAS PROXIMAS</h2>
                <div class="contenedor-tablas">
                    <table class="tablaCitas" id="tablaCitas">
                        <thead>
                            <tr>
                                <th>FECHA</th>
                                <th>HORA</th>
                                <th>DURACION</th>
                                <th>SERVICIO</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoCitas">
                            @forelse($arregloProximas as $cita)
                                <tr>
                                    <td data-label="FECHA">{{ \Carbon\Carbon::parse($cita['start'])->format('d-m-Y') }}
                                    </td>
                                    <td data-label="HORA">{{ \Carbon\Carbon::parse($cita['start'])->format('H:i') }}
                                    </td>
                                    <td data-label="DURACIÓN">
                                        {{ \Carbon\Carbon::parse($cita['start'])->diffInMinutes(\Carbon\Carbon::parse($cita['end'])) }}
                                        min
                                    </td>
                                    <td data-label="SERVICIO" class="estadoRealizada">{{ $cita['servicio'] }}</td>
                                </tr>
                            @empty
                                <tr id="mensajeNoCitas">
                                    <td colspan="7" style="text-align: center; font-weight: bold; color: red;">
                                        No se encontraron citas para esta fecha.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </article>
        </section>
        <section class="calendario">
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
                                <input class="boton-modal cancelar" type="submit" name="resultado" value="eliminar">
                                <input class="boton-modal aceptar" type="submit" name="resultado" value="aceptar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id='calendar'></div>

        </section>
    </main>


    {{-- script para la importacion de fullcalendar --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
    {{-- script de la logica de el calendario --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcula el rango visible dependiendo del tamaño de la pantalla
            function getVisibleRange() {
                const now = new Date();
                const start = new Date(now);
                const end = new Date(now);

                if (window.innerWidth < 768) {
                    // Mostrar solo 5 días (ej: de lunes a viernes)
                    const day = now.getDay(); // 0=Domingo, 1=Lunes,...
                    const diffToMonday = day === 0 ? -6 : 1 - day; // Ajusta si es domingo

                    start.setDate(now.getDate() + diffToMonday);
                    end.setDate(start.getDate() + 5);
                } else {
                    // Mostrar semana completa
                    const day = now.getDay();
                    const diffToMonday = day === 0 ? -6 : 1 - day;
                    start.setDate(now.getDate() + diffToMonday);
                    end.setDate(start.getDate() + 7);
                }

                return {
                    start: start.toISOString().slice(0, 10),
                    end: end.toISOString().slice(0, 10)
                };
            }

            // Obtiene el elemento donde se renderizará el calendario
            var calendarEl = document.getElementById('calendar');

            var today = new Date(); // Obtener la fecha actual
            today.setHours(0, 0, 0, 0); // Ajustar la hora para evitar errores de comparación

            // Inicializa el calendario
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', // Vista inicial: semana
                visibleRange: getVisibleRange(),
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
                events: @json($arregloTodas).map(event => {
                    if (event.estado?.toLowerCase() === 'aceptado') {
                        event.className = ['evento-aceptado'];
                    } else if (event.estado?.toLowerCase() === 'pendiente') {
                        event.className = ['evento-pendiente'];
                    } else {
                        event.className = [];
                    }
                    return event;
                }),

                eventContent: function(arg) {
                    const estado = arg.event.extendedProps.estado?.toLowerCase();

                    let iconColor = '';
                    if (estado === 'aceptado') {
                        iconColor = 'color-blanco';
                    } else if (estado === 'pendiente') {
                        iconColor = 'color-cafe';
                    }

                    return {
                        html: `<i class="fas fa-info-circle ${iconColor}"></i>`
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

                    document.getElementById('modalServicio').textContent = evento.servicio ||
                        'Sin estado';


                    // Guarda el ID de la cita en un input hidden
                    document.getElementById('modalIdCita').value = evento.id_cita;

                    // Muestra el modal de detalle
                    document.getElementById('detalleCitaModal').style.display = 'flex';

                    // Si el rol es administrador, mostrar los botones de acción
                    if (evento.rol && evento.rol.toLowerCase() === 'administrador') {
                        document.querySelector('.formulario-modal').style.display =
                            'block'; // Muestra el formulario
                    } else {
                        document.querySelector('.formulario-modal').style.display =
                            'none'; // Oculta el formulario
                    }
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
                    // Forzar actualización de títulos
                    calendar.getEvents().forEach(event => {
                        event.setProp('title', event.title);
                    });

                    // Actualizar el rango visible dependiendo del nuevo tamaño
                    calendar.setOption('visibleRange', getVisibleRange());
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
