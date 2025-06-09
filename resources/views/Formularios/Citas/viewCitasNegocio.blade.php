<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Citas/viewCitas.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

    <title>Visualizacion de citas</title>
</head>

<body>
    @section('link-index', '/admin/index')
    @section('link-configurar-perfil', route('admin', ['accion' => 'config']))
    @section('link-configurar-establecimiento', route('establecimientos', ['accion' => 'config']))
    @section('link-configurar-negocio', route('negocio', ['accion' => 'config']))
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/negocio/logout')

    @include('components.header-staff', ['notificaciones' => $notificaciones, 'imgStaff' => $imgStaff])

    <main>
        <section class="encabezado">
            <div class="tituloSeccion">
                <h1>VISUALIZACION DE CITAS</h1>
                <p>Visualiza tus citas de forma clara y organizada, consulta los detalles fácilmente en un solo
                    lugar.
                </p>
            </div>
            <div class="barraBusqueda">
                <div class="campoBusqueda">
                    <input type="date" id="fechaFiltro">
                </div>
            </div>
        </section>
        <div class="contenedorPrincipal">


            <div class="contenedorTabla">
                <table class="tablaCitas" id="tablaCitas">
                    <thead>
                        <tr>
                            <th>ID CITA</th>
                            <th>USUARIO</th>
                            <th>ESTABLECIMIENTO</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>DURACION</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoCitas">
                        <tr id="mensajeNoCitas" style="display: none;">
                            <td colspan="7" style="text-align: center; font-weight: bold; color: red;">
                                No se encontraron citas para esta fecha.
                            </td>
                        </tr>
                        @foreach ($HistorialCitas as $historial)
                            <tr>
                                <td data-label="ID CITA">{{ $historial['id_cita'] }}</td>
                                <td data-label="ID USUARIO">{{ $historial['usuario']['nombre'] }}</td>
                                <td data-label="ID ESTABLECIMIENTO">
                                    {{ $historial['establecimiento']['nombre_establc'] }}</td>
                                <td data-label="FECHA">
                                    {{ \Carbon\Carbon::parse($historial['fecha_cita'])->format('Y-m-d') }}</td>
                                <td data-label="HORA">{{ $historial['hora_cita'] }}</td>
                                <td data-label="DURACIÓN">{{ $historial['duracion_cita'] }}</td>
                                <td data-label="ESTADO" class="estadoRealizada">{{ $historial['estado_cita'] }}</td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
    </main>
    <script src="{{ asset('Js/citas/visualizacionCitas.js') }}"></script>

</body>

</html>
