<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Insercciones/inserccionProductos.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">

    <title>Registrar Valoración | MyLook</title>
</head>
<body>
<main>
    <form action="{{ route('registerValoracion') }}" method="POST" class="formulario-productos" onsubmit="return validarValoracion(event)">
        @csrf

        <input type="hidden" name="id_cita" value="{{ $id_cita }}">

        <!-- VISTA DE PREVISUALIZACIÓN -->
        <div class="contenedor-carta">

            <div class="detalles-carta">
                <h4 class="nombre-vista">Valoración de la Cita</h4>
                <p class="descripcion-vista">Tu opinión nos ayuda a mejorar nuestro servicio</p>
                <div class="componentes">
                    <div class="componentes-titulos">
                        <p class="titulo-detalles">Calificación</p>
                        <p class="titulo-detalles">Comentario</p>
                    </div>
                    <div class="componentes-titulos">
                        <p class="elementos" id="previewCalificacion">--</p>
                        <p class="elementos" id="previewComentario">--</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORMULARIO -->
        <div class="contenedor-informacion">
            <h2 class="titulo">DETALLES DE TU VALORACIÓN</h2>
            <p class="introduccion">Califica tu experiencia con el servicio recibido</p>

            <div class="contenedor-input">
                <p class="texto-input">CALIFICACIÓN (1 a 5)</p>
                <select name="calificacion" id="calificacion" class="insercion-input" required onchange="actualizarVistaValoracion()">
                    <option value="">Selecciona una calificación</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="contenedor-input">
                <p class="texto-input">COMENTARIO</p>
                <textarea name="comentario" id="comentario" class="insercion-input" maxlength="255" oninput="actualizarVistaValoracion()"></textarea>
            </div>

            <!-- BOTONES -->
            <div class="contenedor-botones">
                <button type="button" class="botones" onclick="window.history.back()">CANCELAR</button>
                <button type="submit" class="botones">ENVIAR</button>
            </div>
        </div>
    </form>
</main>

<script>
    function actualizarVistaValoracion() {
        const calificacion = document.getElementById('calificacion').value;
        const comentario = document.getElementById('comentario').value;

        document.getElementById('previewCalificacion').textContent = calificacion || '--';
        document.getElementById('previewComentario').textContent = comentario || '--';
    }

    function validarValoracion(event) {
        const calificacion = document.getElementById('calificacion').value;
        if (!calificacion) {
            alert('Por favor, selecciona una calificación.');
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>

</body>
</html>