<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Citas/viewCitas.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Visualizacion de citas</title>
</head>

<body>
    <main>
        <div class="contenedorPrincipal">
            <header class="encabezado">
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
            </header>

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
                            <th>Valorar</th>
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
                                <td data-label="FECHA">{{ $historial['fecha_cita'] }}</td>
                                <td data-label="HORA">{{ $historial['hora_cita'] }}</td>
                                <td data-label="DURACIÓN">{{ $historial['duracion_cita'] }}</td>
                                <td data-label="ESTADO" class="estadoRealizada">{{ $historial['estado_cita'] }}</td>
                                <!-- Aqui puedes agregar tu logica MARLON! -->
                                <td data-label="VALORAR" class="VALORACION">
                                    <form action="{{ route('formValoracion') }}" method="GET">
                                        <input type="hidden" name="id_cita" value="{{ $historial['id_cita'] }}">
                                        <button type="submit">Valorame</button>
                                    </form>
                                </td>


                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <script src="/Js/citas/visualizacionCitas.js"></script>

</body>
</main>
</body>

</html>
