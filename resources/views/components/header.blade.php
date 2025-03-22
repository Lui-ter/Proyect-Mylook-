<header>
    <div class="contenedor-logo">
        <h2 class="my-look">MYLOOK</h2>
    </div>
    <nav>
        <ul class="navegacion">
            <!-- Contenedor de búsqueda con botón y opciones desplegables -->
            <li class="contenedor-busqueda">
            <!-- Botón para activar la búsqueda -->
            <button class="boton-buscar" id="botonBuscar">
                <i class="fa-solid fa-magnifying-glass"></i> <!-- Ícono de lupa -->
            </button>
            <!-- Opciones desplegables de búsqueda -->
            <div class="opciones-busqueda" id="opcionesBusqueda">
                <!-- Contenedor del input de búsqueda -->
                <div class="contenedor-input-busqueda">
                <input type="text" class="input-busqueda" placeholder="Buscar..." /> <!-- Campo de texto para búsqueda -->
                <button type="button" class="input-busqueda">
                    <i class="fa-solid fa-magnifying-glass"></i> <!-- Botón con ícono de lupa -->
                </button>
                </div>

                <!-- Contenedor de categorías con submenú desplegable -->
                <div class="contenedor-categorias">
                <button class="boton-categorias" id="botonCategorias">
                    Categorías <!-- Botón para mostrar las categorías -->
                </button>
                <ul class="submenu-categorias" id="submenuCategorias">
                    <!-- Lista de categorías -->
                    <li><button class="categoria" data-categoria="Peluquería">Peluquería</button></li>
                    <li><button class="categoria" data-categoria="Uñas">Uñas</button></li>
                    <li><button class="categoria" data-categoria="Maquillaje">Maquillaje</button></li>
                    <li><button class="categoria" data-categoria="Barbería">Barbería</button></li>
                </ul>
                </div>
            </div>
            </li>

            <!-- Enlace al inicio -->
            <li><a href="{{ url('/usuarios/index') }}"><i class="fa-solid fa-house-chimney"></i></a></li>

            <!-- Enlace a la sección de "tops" -->
            <li class="tops"><a href="#top" class="top"><i class="fa-solid fa-trophy"></i></a></li>

            <!-- Contenedor del perfil del usuario -->
            <li id="contenedor-perfil">
            <!-- Imagen de perfil del usuario -->
            <img id="imagenPerfil" class="imagen-perfil"
                src="https://img.freepik.com/foto-gratis/foto-chico-guapo-afeitar-mira-expresion-agradable-directamente-camara_176532-8164.jpg"
                alt="Foto de perfil" />

            <!-- Menú desplegable del perfil -->
            <ul id="menuDesplegable" class="menu-desplegable">
                <li><a href="#">Ajustes</a></li> <!-- Enlace a ajustes -->
                <li><a href="#">Cerrar Sesión</a></li> <!-- Enlace para cerrar sesión -->
            </ul>
            </li>
        </ul>
    </nav>
</header>
@once
<link rel="stylesheet" href="{{ asset('Css/Header/Header.css') }}">
<script src="/Js/Header/Header.js"></script>
@endonce