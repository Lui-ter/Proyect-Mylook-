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
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Agendamiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Ajustar tamaño */
            width: 95%;
            margin-bottom: 20px;
        }

        #calendar {
            max-width: 800px; /* Ajustar tamaño */
            margin: 0 auto;
            background: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .selected-date {
            font-size: 16px;
            font-weight: bold;
            color: #007BFF;
            margin-top: 10px;
        }
        .fc-day-sun {
        background-color: white !important; /* Cambiar el fondo de los domingos */
        opacity: 1 !important; /* Asegurar que tenga la misma visibilidad que los demás */
        }
    </style>
</head>
<body>
    <form action="{{ url('/usuarios/agendamiento') }}" method="post" id="citaForm">
        <center><h1>Agendamiento</h1></center>
        @csrf
        <!-- Campos ocultos -->
        <input type="hidden" name="id_usuario" value="{{ $idUsuario }}">
        <input type="hidden" name="id_establecimiento" value="{{ $idEstablecimiento }}">
        <input type="hidden" name="estado" value="pendiente">
        <input type="hidden" name="fecha" id="fecha">
        <input type="hidden" name="hora" id="hora"> 

        <!-- Full Calendar -->
        <div id="calendar"></div>

        <!-- Mostrar fecha seleccionada -->
        <p class="selected-date" id="selected-date">Ninguna fecha seleccionada</p>
        Staff
        <!-- Mostrar el staff -->
        <select id="staff" name="idStaff">
            <option value="">Seleccione una staff</option>
            @foreach ($staffs as $staff )
            <!--Pendiente -->    
            <option value="{{ $staff['id_staff'] }}">{{ $staff->usuario['nombre'] }}</option>

            @endforeach
        </select>
        <br>
        Categoria:
        <select id="categoria" name="idCategoria">
            <option value="">Seleccione una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria['id_categoria'] }}">{{ $categoria['nom_categoria'] }}</option>
            @endforeach
        </select>        
        <script>
            // JS para detectar que categoria selecciono y cargarle sus servicios
           document.getElementById('categoria').addEventListener('change', function () {
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
        <br>
        Servicios
        <!-- Mostrar los servicios -->
        <select id="servicio" name="idServicio">
            <option value="">Seleccione un servicio</option>
            @foreach ($servicios as $servicio)
                <option data-categoria="{{ $servicio['id_categoria'] }}" value="{{ $servicio['id_servicio'] }}">
                    {{ $servicio['nombre'] }}
                </option>
            @endforeach
        </select>

        <br>
        Opcional
        <br>
        Productos
        <!-- Mostrar los productos -->
        <select id="producto" name="idProducto">
            <option value="">Seleccione un producto</option>
            @foreach ($productos as $producto)
                <option value="{{ $producto['id_prod'] }}" data-stock="{{ $producto['stock'] }}">
                    {{ $producto['nombre_prod'] }}
                </option>
            @endforeach
        </select>
        <br>
        <script>
            //  Js para dectectar la cantidad disponible del producto y permitirle lo max que puede pedir
            document.getElementById('producto').addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex]; // Obtener opción seleccionada
                const stock = selectedOption.getAttribute('data-stock'); // Obtener stock desde atributo

                // Mostrar la existencia del producto
                document.getElementById('existencia_producto').textContent = stock;

                // Ajustar el máximo del input de cantidad
                const cantidadInput = document.getElementById('cantidad');
                cantidadInput.max = stock; // Definir límite máximo
                cantidadInput.value = stock > 0 ? 1 : 0; // Preseleccionar valor mínimo
            });
        </script>
        <p>Existencia: <b id="existencia_producto">0</b></p>
        <input type="number" name="cantidad_producto" id="cantidad" min="1">

        <br>
        <!-- Botón de enviar -->
        <input type="submit" value="Enviar">

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var selectedDateEl = document.getElementById('selected-date');

            var today = new Date(); // Obtener la fecha actual
            today.setHours(0, 0, 0, 0); // Ajustar la hora para evitar errores de comparación

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es', // Idioma español
                initialView: 'timeGridWeek', // Vista inicial
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek' // Botones
                },
                buttonText: {
                    today: 'Hoy', // Botón "Hoy"
                    day: 'Día',  // Botón "Día"
                    week: 'Semana' // Botón "Semana"
                },
                dayHeaderFormat: { 
                    weekday: 'long', 
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
                start: today // No permitir selección de días anteriores
                },
                

                eventContent: function(info) {
                    return {
                        html: '<div class="fc-event-title">' + info.event.title + '</div>'
                    };
                },
                events: {!! json_encode($arreglo) !!},
                selectable: true,
                
                dateClick: function (info) {
                    // Convertir la fecha seleccionada en un objeto de JavaScript
                    const fechaSeleccionada = new Date(info.date);

                    // Extraer la hora de la fecha seleccionada
                    const horaSeleccionada = fechaSeleccionada.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false });

                    // Actualizar los valores de los campos ocultos
                    document.getElementById('fecha').value = fechaSeleccionada.toISOString().split('T')[0]; // Sólo la fecha (YYYY-MM-DD)
                    document.getElementById('hora').value = horaSeleccionada; // Sólo la hora (HH:mm)

                    // Mostrar la fecha seleccionada al usuario
                    selectedDateEl.textContent = "Fecha seleccionada: " + fechaSeleccionada.toLocaleDateString() + " Hora: " + horaSeleccionada;
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>