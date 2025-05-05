<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('Css/Index/indexAdmin.css') }}">
    <title>Mi Negocio</title>
</head>


<body>

    @section('link-index', '/admin/index')
    @section('link-configurar-perfil', '/admin/configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/negocio/logout')

    @include('components.header-staff',['notificaciones' => $notificaciones, 'imgStaff' => $imgStaff])


    <main>

        {{-- seccion contenedora --}}
        <section class="contenedor-administrador">
            {{-- navegacion entre secciones --}}
            <nav class="navegacion">
                <button type="submit" class="boton-seccion">AGENDA</button>
                <button type="submit" class="boton-seccion">STAFF</button>
                <button type="submit" class="boton-seccion">PRODUCTOS</button>
                <button type="submit" class="boton-seccion">CATEGORIA</button>
            </nav>


            {{-- contenedor de secciones --}}
            <section class="secciones">

                {{-- seccion de agenda --}}
                <section class="agenda" id="agenda">

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
                                    <h4 class="subtitulo-modal">Detalles del Producto</h4>
                                    <div class="informacion-modal">
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Producto:</strong></div>
                                            <div class="campo-modal"><span id="modalProducto"></span></div>
                                        </div>
                                        <div class="fila-modal">
                                            <div class="etiqueta-modal"><strong>Cantidad:</strong></div>
                                            <div class="campo-modal"><span id="modalCantidad"></span></div>
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

                    <!--calendario de agenda-->
                    <div id='calendar'></div>
                </section>

                {{-- seccion de staff --}}
                <section class="staff seccion-opcion" id="staff">

                    {{-- carta de staff --}}
                    @foreach ($infoStaff as $item)
                        <article class="carta" id="carta-staff">
                            <figure class="carta-imagen" id="foto-staff">
                                <img src="{{ $item['usuario']['img_usuario'] }}" alt="imagen staff">
                                <p class="rol">{{ $item['rol']['nombre_rol'] }}</p>
                            </figure>
                            <h3>{{ $item['usuario']['nombre'] }}</h3>
                            <div class="contenedor-botones">
                                <!-- Boton para editar un staff -->
                                <form action="{{ route('staff', ['accion' => 'editar']) }}" method="POST">
                                    @csrf
                                    <button class="boton" type="submit" value="{{ $item['id_usuario'] }}"
                                        name="editStaff">Editar</button>
                                </form>

                                <!-- Boton para eliminar un staff -->
                                <form action="{{ route('staff', ['accion' => 'eliminar']) }}" method="POST">
                                    @csrf
                                    <button class="boton" type="submit" value="{{ $item['id_usuario'] }}"
                                        name="deleteStaff">Eliminar</button>
                                </form>
                            </div>
                        </article>
                    @endforeach

                    {{-- carta de agregar staff --}}
                    <form class="agregar" action="{{ route('staff', ['accion' => 'register']) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none;">
                            <i class="fa-solid fa-plus"></i>
                            <p>AGREGAR</p>
                        </button>
                    </form>

                    {{-- carta de staff --}}
                    <form class="ver-todos" action="{{ route('staff', ['accion' => 'ver']) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none;">
                            <i class="fa-solid fa-users"></i>
                            <p>VER TODOS</p>
                        </button>
                    </form>
                </section>

                {{-- seccion de productos --}}
                <section class="productos seccion-opcion" id="productos">

                    {{-- carta de productos --}}
                    @foreach ($productsPreview as $product)
                        <article class="carta">
                            <figure class="carta-imagen">
                                <img src="{{ $product['img_prod'] }}" alt="">
                                <p class="stock">{{ $product['stock'] }} <i class="fa-solid fa-boxes-stacked"></i>
                                </p>
                                <p class="precio"><span>{{ $product['valor_prod'] }} COP</span></p>
                            </figure>
                            <h3>{{ $product['nombre_prod'] }}</h3>
                            <p>{{ $product['desc_prod'] }}</p>
                            <div class="contenedor-botones">
                                <form action="{{ route('productos', ['accion' => 'editar']) }}" method="POST">
                                    @csrf
                                    <button class="boton" type="submit" value="{{ $product['id_prod'] }}"
                                        name="editProducto">Editar</button>
                                </form>
                                <form action="{{ route('productos', ['accion' => 'eliminar']) }}" method="POST">
                                    @csrf
                                    <button class="boton" value="{{ $product['id_prod'] }}"
                                        name="deleteProducto">Eliminar</button>
                                </form>
                            </div>
                        </article>
                    @endforeach

                    {{-- carta de agregar productos --}}
                    <form class="agregar" action="{{ route('productos', ['accion' => 'nuevo']) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none;">
                            <i class="fa-solid fa-plus"></i>
                            <p>AGREGAR</p>
                        </button>
                    </form>

                    {{-- carta de ver todos los productos --}}
                    <form class="ver-todos" action="{{ route('productos', ['accion' => 'ver']) }}" method="get">
                        <button type="submit" style="background: none;">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <p>VER TODOS</p>
                        </button>
                    </form>

                </section>

                {{-- seccion de categorias --}}
                <section class="categoria seccion-opcion" id="categoria">

                    {{-- carta de categorias --}}
                    @foreach ($categorias as $categoria)
                        <article class="carta">

                            <figure class="carta-imagen">
                                <img src="{{ $categoria['imagen'] }}" alt="Foto de categoria">
                                <a class="stock"
                                    href="{{ route('servicios', ['accion' => 'ver', 'id' => $categoria['id_categoria']]) }}">
                                    VER SERVICIOS
                                </a>

                            </figure>
                            <h3>{{ $categoria['nom_categoria'] }}</h3>
                            <p>{{ $categoria['desc_categoria'] }}</p>
                            <div class="contenedor-botones">
                                <form action="{{ route('categorias', ['accion' => 'editar']) }}" method="POST">
                                    @csrf
                                    <button class="boton" type="submit" value="{{ $categoria['id_categoria'] }}"
                                        name="editCategoria">Editar</button>
                                </form>
                                <form action="{{ route('categorias', ['accion' => 'eliminar']) }}" method="POST">
                                    @csrf
                                    <button class="boton" value="{{ $categoria['id_categoria'] }}"
                                        name="deleteCategoria">Eliminar</button>
                                </form>
                            </div>
                        </article>
                    @endforeach

                    {{-- carta de agregar categroias --}}
                    <form class="agregar" action="{{ route('categorias', ['accion' => 'nuevo']) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none;">
                            <i class="fa-solid fa-plus"></i>
                            <p>AGREGAR</p>
                        </button>
                    </form>

                    {{-- carta de ver todas las categorias --}}
                    <form class="ver-todos" action="{{ route('categorias', ['accion' => 'ver']) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none;">
                            <i class="fa-solid fa-star"></i>
                            <p>VER TODOS</p>
                        </button>
                    </form>
                </section>
            </section>
        </section>

    </main>



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
                    document.getElementById('modalProducto').textContent = evento.producto ||
                        'Sin producto';
                    document.getElementById('modalCantidad').textContent = evento.cantidad ||
                        'Sin cantidad';
                    document.getElementById('modalEstado').textContent = evento.estado || 'Sin estado';

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
    </script>


    <script src="/Js/Admin/indexAdmin.js"></script>
</body>

</html>
