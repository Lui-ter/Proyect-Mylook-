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
    <link rel="stylesheet" href="{{ asset('Css/Index/indexAgendamiento.css') }}">

    <title>Agendamiento</title>
</head>

<body>
    <main>
        <form action="" method="post" class="agendamiento">
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
                        <p class="titulos">Seleccionar categoría:</p>
                        <select name="idcategoria" id="categoria">
                            <option value=""> </option>
                            <option value="">Maquillaje</option>
                            <option value="">Barbería</option>
                            <option value="">Uñas</option>
                            <option value="">Peluquería</option>
                        </select>
                    </div>

                    <div class="campos-doble">
                        <div class="campos">
                            <p class="titulos">Seleccionar productos:</p>
                            <select name="idproducto" id="producto">
                                <option value=""> </option>
                                <option value="">Crema Dayli</option>
                                <option value="">Cera para cejas</option>
                            </select>
                        </div>

                        <div class="campos">
                            <p class="titulos">Seleccionar servicio:</p>
                            <select name="idservicio" id="servicio">
                                <option value=""> </option>
                                <option value="">Corte de barba</option>
                                <option value="">Corte de pelo</option>
                            </select>
                        </div>
                    </div>

                    <div class="producto-staff">
                        <!-- Producto seleccionado -->
                        <div class="producto">
                            <p class="titulos">PRODUCTO SELECCIONADO</p>
                            <div class="contenedor-carta-producto">
                                <div class="card-producto">
                                    <figure>
                                        <img
                                            src="https://olimpica.vtexassets.com/arquivos/ids/617819/7702006298902.jpg?v=637626525186370000"
                                            alt="Producto" />
                                        <p class="nombre">Crema dayli</p>
                                    </figure>
                                </div>
                            </div>
                            <div class="botones-producto">
                                <button class="btn" type="button" id="btn-menos">−</button>
                                <span id="contador">0</span>
                                <button class="btn" type="button" id="btn-mas">+</button>
                            </div>
                        </div>

                        <!-- Staff disponible -->
                        <div class="staff">
                            <p class="titulos">STAFF DISPONIBLE</p>
                            <div class="staff-contenedor">
                                <div class="card-staff">
                                    <img id="staff-img"
                                        src="https://img.freepik.com/foto-gratis/estilo-vida-emociones-gente-concepto-casual-confiado-agradable-sonriente-mujer-asiatica-brazos-cruzados-pecho-seguro-listo-ayudar-escuchando-companeros-trabajo-participando-conversacion_1258-59335.jpg?semt=ais_hybrid&w=740"
                                        alt="Staff" />
                                    <p class="nombre" id="staff-nombre">Román</p>
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
                    <div class="botones">
                        <button type="reset" class="cancelar">CANCELAR</button>
                        <button type="submit" class="guardar">GUARDAR</button>
                    </div>
                </div>
                @if(count($staffs) > 0)
                <input type="hidden" name="idStaff" id="staff-id" value="{{ $staffs[0]['id_staff'] }}">
                @else
                <p>No hay staff disponible en este momento.</p>
                @endif
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var selectedDateEl = document.getElementById('selected-date');

            var today = new Date(); // Obtener la fecha actual
            today.setHours(0, 0, 0, 0); // Ajustar la hora para evitar errores de comparación

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es', // Idioma español
                allDayText: 'Tiempo', // Texto para eventos de todo el día
                allDaySlot: false, // Ocultar slot de todo el día

                initialView: 'timeGridWeek', // Vista inicial
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
                buttonText: {
                    today: 'Hoy', // Botón "Hoy"
                    day: 'Día', // Botón "Día"
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
                }, // Formato de los encabezados de los días
                dayHeaderFormat: {
                    weekday: 'short', // Nombre corto del día (Lun, Mar, etc.)
                    day: 'numeric'
                },
                // Texto personalizado para el botón de "hoy"
                buttonText: {
                    today: 'HOY'
                },

                validRange: {
                    start: today // No permitir selección de días anteriores
                },


                eventContent: function(info) {
                    return {
                        html: '<div class="fc-event-title">' + info.event.title + '</div>'
                    };
                },
                events: {
                    !!json_encode($arreglo) !!
                },
                selectable: true,

                dateClick: function(info) {
                    // Convertir la fecha seleccionada en un objeto de JavaScript
                    const fechaSeleccionada = new Date(info.date);

                    // Extraer la hora de la fecha seleccionada
                    const horaSeleccionada = fechaSeleccionada.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });

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
    <script src="{{ asset('Js/index/indexAgendamiento.js') }}"></script>
</body>

</html>