</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Mis servicios</title>
</head>

<body>
    @if(session('success'))
        <script>alert('{{ e(session('success')) }}');</script>
    @endif
    @if(session('error'))
        <script>alert('{{ e(session('error')) }}');</script>
    @endif
    <section class="seccion">
        <!-- Volver a index administrador -->
        <span class="volver">
            <div class="encabezado">
                <a href="{{ route('admin', ['accion' => 'index']) }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <section class="encabezadoCategoria">
                    <img src="{{ $categorias['imagen'] }}" alt="Imagen de la categoría" class="imgGrande">
                    <h2>{{ $categorias['nom_categoria'] }}</h2>
                </section>
            </div>
            <h3 class="nombre-vista">Gestion Servicios</h3>
        </span>

        <!-- Filtrar en los servicios -->
        <nav class="filtros">
            <div class="option">
                <button type="button" id="btnInicio" class="boton">TODO</button>
                <button type="button" id="recientes" class="boton">RECIENTES</button>
                <select id="ordenPrecio" class="boton">
                    <option value="valor">PRECIO</option>
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
                <select id="ordenDuracion" class="boton">
                    <option value="" disabled selected>duración</option>
                    <option value="asc">Menor</option>
                    <option value="desc">Mayor</option>
                </select>

                <a href="{{ route('servicios', ['accion' => 'nuevo', 'id' => $categorias['id_categoria']]) }}"><button
                        type="submit" class="boton">AGREGAR</button></a>
            </div>
            <div class="searchBar">
                <i class="fas fa-search"></i>
                <input type="text" id="inputSearch" class="inputSearch" placeholder="Buscar servicios">
            </div>
        </nav>

        <!-- Contenedor de servicios-->
        <section class="lista-servicios">
            @foreach ($servicios as $servicio)
                <div class="carta-servicio" data-id="{{ $servicio->id_servicio }}"
                    data-valor="{{ $servicio->precio_servicio }}" data-duracion="{{ $servicio->duracion_serv }}">
                    <h2>{{ $servicio->nombre_servicio }}</h2>
                    <p class="descripcion">{{ $servicio->desc_servicio }}</p>
                    <div class="fila">
                        <p class="requisito">PRECIO</p>
                        <p>${{ $servicio->precio_servicio }} COP</p>
                    </div>
                    <div class="fila">
                        <p class="requisito">DURACION</p>
                        <p>{{ $servicio->duracion_serv }} minutos</p>
                    </div>
                    <div class="contenedor-botones">
                        <form action="{{ route('servicios', ['accion' => 'editar']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="editServicio" value="{{ $servicio->id_servicio }}">
                            <button type="submit" class="boton">EDITAR</button>
                        </form>
                        <form action="{{ route('servicios', ['accion' => 'eliminar']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="deleteServicio" value="{{ $servicio->id_servicio }}">
                            <button type="submit" class="boton">ELIMINAR</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <p id="mensajeNoResultados" class="mensaje">
                No se encontraron servicios
            </p>
        </section>
    </section>

    <style>
        @media (max-width: 580px) {
            .seccion {
                .volver {
                    text-align: center;
                    flex-direction: column;
                    gap: .5em;
                    width: 100%;

                    .encabezado {
                        display: flex;
                        flex-direction: column;
                        gap: 1em;
                        width: 100%;
                    }
                }

            }


        }
    </style>

    <script>
        const input = document.querySelector('.inputSearch');
        const cartas = document.querySelectorAll('.carta-servicio');
        const mensajeNoResultados = document.getElementById('mensajeNoResultados');
        const contenedor = document.querySelector('.lista-servicios');
        const selectOrdenPrecio = document.getElementById('ordenPrecio');
        const botonRecientes = document.getElementById('recientes');
        const botonTodo = document.getElementById('btnInicio');
        const selectOrdenDuracion = document.getElementById('ordenDuracion');

        const cartasArray = Array.from(cartas);

        // Función para mostrar todas las cartas
        function mostrarTodasLasCartas() {
            cartas.forEach(carta => {
                carta.style.display = 'grid';
            });
            mensajeNoResultados.style.display = 'none';
        }

        // Verificar si el contenedor está vacío y mostrar mensaje si es necesario
        function verificarSiEstaVacio() {
            if (cartas.length === 0) {
                mensajeNoResultados.textContent = 'Está vacío, agrega servicios';
                mensajeNoResultados.style.display = 'block';
            } else {
                mensajeNoResultados.style.display = 'none';
            }
        }

        // Búsqueda
        input.addEventListener('input', function() {
            const textoBuscar = input.value.toLowerCase();
            let hayResultados = false;

            cartas.forEach(carta => {
                const nombre = carta.querySelector('h2').textContent.toLowerCase();

                if (nombre.includes(textoBuscar)) {
                    carta.style.display = 'grid';
                    hayResultados = true;
                } else {
                    carta.style.display = 'none';
                }
            });

            mensajeNoResultados.style.display = hayResultados ? 'none' : 'block';
        });

        // Estilo activo en botones
        const botonesFiltro = document.querySelectorAll('.boton');
        botonesFiltro.forEach(boton => {
            boton.addEventListener('click', () => {
                botonesFiltro.forEach(b => b.classList.remove('activo'));
                boton.classList.add('activo');
            });
        });

        // Mostrar todos (mezclados aleatoriamente)
        botonTodo.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarTodasLasCartas();

            const mezcladas = cartasArray.sort(() => Math.random() - 0.5);
            mezcladas.forEach(carta => contenedor.appendChild(carta));
        });

        // Mostrar recientes
        botonRecientes.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarTodasLasCartas();

            const ordenadas = cartasArray.sort((a, b) => b.dataset.id - a.dataset.id);
            ordenadas.forEach(carta => contenedor.appendChild(carta));
        });

        // Ordenar por precio
        selectOrdenPrecio.addEventListener('change', function(e) {
            mostrarTodasLasCartas();
            const opcion = e.target.value;

            if (opcion === 'asc') {
                const baratos = cartasArray.sort((a, b) => parseFloat(a.dataset.valor) - parseFloat(b.dataset
                    .valor));
                baratos.forEach(carta => contenedor.appendChild(carta));
            } else if (opcion === 'desc') {
                const caros = cartasArray.sort((a, b) => parseFloat(b.dataset.valor) - parseFloat(a.dataset.valor));
                caros.forEach(carta => contenedor.appendChild(carta));
            }
        });

        selectOrdenDuracion.addEventListener('change', function(e) {
            mostrarTodasLasCartas();
            const opcion = e.target.value;

            if (opcion === 'asc') {
                const duracionCorta = cartasArray.sort((a, b) => parseFloat(a.dataset.duracion) - parseFloat(b
                    .dataset.duracion));
                duracionCorta.forEach(carta => contenedor.appendChild(carta));
            } else if (opcion === 'desc') {
                const duracionLarga = cartasArray.sort((a, b) => parseFloat(b.dataset.duracion) - parseFloat(a
                    .dataset.duracion));
                duracionLarga.forEach(carta => contenedor.appendChild(carta));
            }
        });

        // Verificar si está vacío al cargar la página
        verificarSiEstaVacio();
    </script>

</body>

</html>
