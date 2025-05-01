<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Mis productos</title>
</head>

<body>

    <section class="seccion">
        <!-- Volver a index administrador -->
        <span class="volver">
            <a href="{{ route('admin') }}"><i class="fas fa-arrow-left"></i></a>
            <h3 class="nombre-vista">Gestion de productos</h3>
        </span>

        <!-- Filtros en los productos-->
        <nav class="filtros">
            <div class="option">
                <button type="button" id="btnInicio" class="boton">TODO</button>
                <button type="button" id="recientes" class="boton">RECIENTES</button>
                <button type="button" id="agotados" class="boton">AGOTADOS</button>
                <select id="ordenPrecio" class="boton">
                    <option value="valor">PRECIO</option>
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>
            <div class="searchBar">
                <i class="fas fa-search"></i>
                <input type="text" id="inputSearch" class="inputSearch" placeholder="Buscar producto...">
            </div>
        </nav>


        <!-- Contenedor de productos -->
        <section class="contenedor-cartas">
            @foreach ($productos as $producto)
                <article class="carta" data-id="{{ $producto['id_prod'] }}" data-valor="{{ $producto['valor_prod'] }}"
                    data-stock="{{ $producto['stock'] }}">
                    <figure class="carta-imagen">
                        <img src="{{ $producto['img_prod'] }}" alt="">
                        <p class="stock">{{ $producto['stock'] }} <i class="fa-solid fa-boxes-stacked"></i>
                        </p>
                        <p class="precio"><span>{{ $producto['valor_prod'] }} COP</span></p>
                    </figure>
                    <h3>{{ $producto['nombre_prod'] }}</h3>
                    <p>{{ $producto['desc_prod'] }}</p>
                    <div class="contenedor-botones">
                        <form action="{{ route('productos', ['accion' => 'editar']) }}" method="POST">
                            @csrf
                            <button class="boton" type="submit" value="{{ $producto['id_prod'] }}"
                                name="editProducto">Editar</button>
                        </form>
                        <form action="{{ route('productos', ['accion' => 'eliminar']) }}" method="POST">
                            @csrf
                            <button class="boton" value="{{ $producto['id_prod'] }}"
                                name="deleteProducto">Eliminar</button>
                        </form>
                    </div>
                </article>
            @endforeach
            <p id="mensajeNoResultados" class="mensaje">
                No se encontraron productos
            </p>
            <p id="mensajeagotados" class="mensaje">
                No se encontraron productos agotados
            </p>

        </section>
    </section>

    <script>
        const input = document.querySelector('.inputSearch');
        const cartas = document.querySelectorAll('.carta');
        const mensajeNoResultados = document.getElementById('mensajeNoResultados');
        const contenedor = document.querySelector('.contenedor-cartas');
        const selectOrdenPrecio = document.getElementById('ordenPrecio');
        const botonRecientes = document.getElementById('recientes');
        const botonTodo = document.getElementById('btnInicio');
        const botonAgotados = document.getElementById('agotados');
        const mensajeAgotados = document.getElementById('mensajeagotados');

        const cartasArray = Array.from(cartas);

        // Función para mostrar todas las cartas
        function mostrarTodasLasCartas() {
            cartas.forEach(carta => {
                carta.style.display = 'grid';
            });
            mensajeNoResultados.style.display = 'none';
            mensajeAgotados.style.display = 'none';
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
            mensajeAgotados.style.display = 'none';
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
            verificarSiHayCartasVisibles();

        });

        // Verificar si el contenedor está vacío y mostrar mensaje si es necesario
        function verificarSiHayCartasVisibles() {
            const hayCartasVisibles = Array.from(cartas).some(carta => carta.style.display !== 'none');
            mensajeNoResultados.style.display = hayCartasVisibles ? 'none' : 'block';
        }

        // Mostrar solo agotados
        botonAgotados.addEventListener('click', function(e) {
            e.preventDefault();
            let hayAgotados = false;

            cartas.forEach(carta => {
                if (carta.dataset.stock === "0") {
                    carta.style.display = 'grid';
                    hayAgotados = true;
                } else {
                    carta.style.display = 'none';
                }
            });

            mensajeAgotados.style.display = hayAgotados ? 'none' : 'block';
            mensajeNoResultados.style.display = 'none';
        });

        verificarSiHayCartasVisibles();
    </script>



</body>

</html>
