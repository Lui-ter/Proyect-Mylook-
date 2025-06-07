<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Mis categorias</title>
</head>

<body>
    <section class="seccion">
        <!-- Volver a index administrador -->
        <span class="volver">
            <a href="{{ route('admin') }}"><i class="fas fa-arrow-left"></i></a>
            <h3 class="nombre-vista">Gestion de categorias</h3>
        </span>

        <!-- Filtros en las secciones-->
        <nav class="filtros">
            <div class="option">
                <button type="button" id="btnInicio" class="boton">TODO</button>
                <button type="button" id="recientes" class="boton">RECIENTES</button>
            </div>
            <div class="searchBar">
                <i class="fas fa-search"></i>
                <input type="text" id="inputSearch" class="inputSearch" placeholder="Buscar categorias">
            </div>
        </nav>

        <!-- contenedor de las categorias -->
        <section class="contenedor-cartas">

            @foreach ($categorias as $categoria)
                <article class="carta" data-id="{{ $categoria['id_categoria'] }}">

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
            <p id="mensajeNoResultados" class="mensaje">
                No se encontraron categorias
            </p>

        </section>
    </section>


    <script>
        const input = document.querySelector('.inputSearch');
        const cartas = document.querySelectorAll('.carta');
        const mensajeNoResultados = document.getElementById('mensajeNoResultados');
        const contenedor = document.querySelector('.contenedor-cartas');
        const botonRecientes = document.getElementById('recientes');
        const botonTodo = document.getElementById('btnInicio');
        const cartasArray = Array.from(cartas);

        // Función para mostrar todas las cartas
        function mostrarTodasLasCartas() {
            cartas.forEach(carta => {
                carta.style.display = 'grid';
            });
            mensajeNoResultados.style.display = 'none';
            verificarSiHayCartasVisibles();

        }

        // Búsqueda
        input.addEventListener('input', function() {
            const textoBuscar = input.value.toLowerCase();
            let hayResultados = false;

            cartas.forEach(carta => {
                const nombre = carta.querySelector('h3').textContent.toLowerCase();

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
            verificarSiHayCartasVisibles();

        });

        // Mostrar todos (mezclados aleatoriamente)
        botonTodo.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarTodasLasCartas();
            const mezcladas = cartasArray.sort(() => Math.random() - 0.5);
            mezcladas.forEach(carta => contenedor.appendChild(carta));
            verificarSiHayCartasVisibles();

        });

        // Mostrar recientes
        botonRecientes.addEventListener('click', function(e) {
            e.preventDefault();
            mostrarTodasLasCartas();

            const ordenadas = cartasArray.sort((a, b) => b.dataset.id - a.dataset.id);
            ordenadas.forEach(carta => contenedor.appendChild(carta));
            verificarSiHayCartasVisibles();

        });

        // Verificar si el contenedor está vacío y mostrar mensaje si es necesario
        function verificarSiHayCartasVisibles() {
            const hayCartasVisibles = Array.from(cartas).some(carta => carta.style.display !== 'none');
            mensajeNoResultados.style.display = hayCartasVisibles ? 'none' : 'block';
        }


        // funcion para mostrar las cartas al iniciar la vista
        window.addEventListener('DOMContentLoaded', function() {
            mostrarTodasLasCartas();
            botonTodo.classList.add('activo');

            const mezcladas = cartasArray.sort(() => Math.random() - 0.5);
            mezcladas.forEach(carta => contenedor.appendChild(carta));
        });
        verificarSiHayCartasVisibles();
    </script>

</body>

</html>
