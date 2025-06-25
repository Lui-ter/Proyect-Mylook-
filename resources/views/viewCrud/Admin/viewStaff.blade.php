<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Css/Views/viewCrudAdmin.css') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <title>Mi staff</title>
</head>

<body>
    <section class="seccion">
        <!-- Volver a index administrador-->
        <span class="volver">
            <a href="{{ route('admin') }}"><i class="fas fa-arrow-left"></i></a>
            <h3 class="nombre-vista">Gestion de staff</h3>
        </span>

        <!-- Filtrar en staff-->
        <nav class="filtros">
            <div class="option">
                <button type="button" id="btnInicio" class="boton">TODO</button>
                <button type="button" id="recientes" class="boton">RECIENTES</button>
            </div>
            <div class="searchBar">
                <i class="fas fa-search"></i>
                <input type="text" id="inputSearch" class="inputSearch" placeholder="Buscar Miembros">
            </div>
        </nav>

        <!-- Contenedor de staff-->
        <section class="contenedor-cartas">
            {{-- carta de staff --}}
            @foreach ($infoStaff as $item)
                <article class="carta" id="carta-staff" data-id="{{ $item['id_staff'] }}">
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


            <p id="mensajeNoResultados" class="mensaje">
                No se encontraron miembros.
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
            verificarSiHayCartasVisibles();
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

        function verificarSiHayCartasVisibles() {
            const hayCartasVisibles = Array.from(cartas).some(carta => carta.style.display !== 'none');
            mensajeNoResultados.style.display = hayCartasVisibles ? 'none' : 'block';
        }


        window.addEventListener('DOMContentLoaded', function() {
            mostrarTodasLasCartas();
            botonTodo.classList.add('activo');

            const mezcladas = cartasArray.sort(() => Math.random() - 0.5);
            mezcladas.forEach(carta => contenedor.appendChild(carta));
        verificarSiHayCartasVisibles();

        });
        verificarSiHayCartasVisibles();

    </script>
</body>

</html>
