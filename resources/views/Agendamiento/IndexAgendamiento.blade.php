<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- FullCalendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <!-- Idioma español -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.global.min.js"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Css/Index/indexAgendamiento.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Agendamiento</title>
</head>

<body>
    @section('link-index', '/usuarios/index')
    @section('link-configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/usuarios/logout')

    @include('components.header',['imgusuario' => $imgusuario, 'notificaciones' => $notificaciones])
    <main>
        <form action="{{ url('/usuarios/agendamiento') }}" method="post" id="citaForm"
            onsubmit="handleValidationCita(event)" class="agendamiento">
            @csrf
            <!-- Campos ocultos para la creación de la cita -->
            <input type="hidden" name="id_usuario" value="{{ $idUsuario }}">
            <input type="hidden" name="id_establecimiento" value="{{ $idEstablecimiento }}">
            <input type="hidden" name="estado" value="pendiente">
            <input type="hidden" name="fecha" id="fecha">
            <input type="hidden" name="hora" id="hora">
            <input type="hidden" name="idStaff" id="idStaff"
                value="{{ count($staffs) > 0 ? $staffs[0]['id_staff'] : '' }}">


            <article class="titulo-agenda">
                <h1 class="titulo1">AGENDAR CITA</h1>
                <p class="texto1">
                    En este apartado podrás seleccionar la fecha y hora en la que deseas
                    reservar el servicio, además de elegir al personal de tu preferencia
                </p>
            </article>
            <article class="contenedor">
                <div class="columna1">
                    <div class="campos">
                        <p class="titulos">CATEGORIA</p>
                        <select name="idCategoria" id="categoria">

                            @foreach ($categorias as $categoria)
                                <option selected disabled hidden>Selecciona una categoria</option>
                                <option value="{{ $categoria['id_categoria'] }}">{{ $categoria['nom_categoria'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campos-doble">
                        <div class="campos">
                            <p class="titulos">PRODUCTOS</p>
                            <select name="idProducto" id="producto">
                                <option selected disabled hidden>Selecciona un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto['id_prod'] }}" data-stock="{{ $producto['stock'] }}"
                                        data-img="{{ $producto['img_prod'] }}">
                                        {{ $producto['nombre_prod'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="campos">
                            <p class="titulos">SERVICIO</p>
                            <select name="idServicio" id="servicio">
                                <option selected disabled hidden>Selecciona una categoria</option>
                                @foreach ($servicios as $servicio)
                                    <option data-categoria="{{ $servicio['id_categoria'] }}"
                                        value="{{ $servicio['id_servicio'] }}">
                                        {{ $servicio['nombre'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="producto-staff">
                        <!-- Producto seleccionado -->
                        <div class="producto">
                            <p class="titulos">PRODUCTO</p>
                            <div class="contenedor-carta-producto">
                                <div class="card-producto">
                                    <figure>
                                        <img id="producto-img" src="" />
                                        <p class="nombre" id="producto-nombre"></p>
                                            <figcaption id="mensajeOpcional">Opcional</figcaption>

                                    </figure>
                                </div>
                                <input type="hidden" id="idProductoSeleccionado" name="idProducto">
                            </div>
                            <div class="botones-producto">
                                <button class="btn" type="button" id="btn-menos">−</button>
                                <span id="contador">0</span>
                                <button class="btn" type="button" id="btn-mas">+</button>
                                <input type="hidden" name="cantidadProducto" id="cantidadProducto">
                            </div>
                        </div>



                        <!-- Staff disponible -->
                        <div class="staff">
                            <p class="titulos">STAFF</p>
                            <div class="staff-contenedor">
                                <div class="card-staff">
                                    <img id="staff-img" alt="Staff" />
                                    <p class="nombre" id="staff-nombre"></p>
                                </div>
                            </div>

                            <div class="botones-staff">
                                <button type="button" class="btn btn-prev-staff">&lt;</button>
                                <button type="button" class="btn btn-next-staff">&gt;</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!--Calendario-->
                <div class="columna2">
                    <div id="calendar"></div>
                    <!-- Actualizar el diseño de este nombre-->
                    <p class="selected-date" id="selected-date">Ninguna fecha seleccionada</p>
                    <div class="botones">
                        <button type="reset" class="cancelar">CANCELAR</button>
                        <button type="submit" class="guardar">GUARDAR</button>
                    </div>
                </div>
        </form>
    </main>

</body>
<!-- JS para detectar que categoria selecciono y cargarle sus servicios -->
<script>
    document.getElementById('categoria').addEventListener('change', function() {
        const categoriaId = this.value; // ID de categoría seleccionada
        const servicioSelect = document.getElementById('servicio'); // Seleccionar el <select> de servicios

        servicioSelect.innerHTML = '<option value="">Seleccione un servicio</option>'; // Reinicia el select

        // Verifica y filtra los servicios
        const servicios = @json($servicios); // Servicios enviados desde Laravel
        console.log('Servicios cargados:', servicios); // Depura en consola los servicios

        servicios.forEach(servicio => {
            if (servicio.id_categoria == categoriaId) { // Filtrar por categoría seleccionada
                const option = document.createElement('option');
                option.value = servicio.id_servicio; // ID del servicio
                option.textContent = servicio.nombre_servicio; // Nombre del servicio
                servicioSelect.appendChild(option); // Agregar opción al <select>
            }
        });

        if (!servicioSelect.children.length) {
            console.log('No hay servicios disponibles para esta categoría');
        }
    });
</script>

<!-- js para que reconozca las variables del staff -->
<script type="application/json" id="staff-data">
    {!! json_encode($staffs) !!}
</script>

<!-- Script para el calendario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var selectedDateEl = document.getElementById('selected-date');

        var today = new Date(); // Obtener la fecha actual
        today.setHours(0, 0, 0, 0); // Ajustar la hora para evitar errores de comparación

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            allDayText: 'Tiempo',
            allDaySlot: false,
            initialView: 'timeGridWeek',
            headerToolbar: {
                start: 'today',
                center: 'title',
                end: 'prev,next'
            },
            titleFormat: {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            },
            buttonText: {
                today: 'HOY',
                day: 'Día',
                week: 'Semana'
            },
            dayHeaderFormat: {
                weekday: 'short',
                day: 'numeric'
            },
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            },
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            },
            validRange: {
                start: today
            },
            eventContent: function(info) {
                return {
                    html: '<div class="fc-event-title">' + info.event.title + '</div>'
                };
            },
            events: @json($arreglo),
            selectable: true,
            dateClick: function(info) {
                const fechaSeleccionada = new Date(info.date);

                // Formatear fecha manualmente para evitar problemas con UTC
                const year = fechaSeleccionada.getFullYear();
                const month = String(fechaSeleccionada.getMonth() + 1).padStart(2, '0');
                const day = String(fechaSeleccionada.getDate()).padStart(2, '0');
                const fechaFormateada = `${year}-${month}-${day}`;

                // Formatear hora
                const horaSeleccionada = fechaSeleccionada.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                });

                // Actualizar los valores de los campos ocultos
                document.getElementById('fecha').value = fechaFormateada;
                document.getElementById('hora').value = horaSeleccionada;

                // Mostrar la fecha seleccionada al usuario
                selectedDateEl.textContent = "Fecha seleccionada: " + fechaSeleccionada.toLocaleDateString() + " Hora: " + horaSeleccionada;
            }
        });

        calendar.render();
    });
</script>

<script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>
<script src="{{ asset('Js/index/indexAgendamiento.js') }}"></script>

</html>
