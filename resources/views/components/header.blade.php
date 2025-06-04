<header>
    <div class="contenedor-logo">
        <img src="{{ asset('logo.svg') }}" alt="Logo">
        <h2 class="my-look">MYLOOK</h2>
    </div>

    <div class="contenedor-opciones">
        <div class="contenedor-iconos">
            <a href="@yield('link-index')"><button class="contenedor-icono"><i
                        class="fa-solid fa-house-chimney"></i></button></a>
            <button class="contenedor-icono" id="toggle-bandeja"><i class="fa-solid fa-bell"></i></button>
        </div>
        <div class="contenedor-busqueda" id="busqueda">
            <button class="contenedor-icono lupa"><i class="fa-solid fa-magnifying-glass"></i></button>

            <div class="menu-busqueda oculto">
              <div class="caja-busqueda">
                <input type="text" placeholder="Buscar..." id="busqueda-input" />
                <button class="boton-jecutar"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>

              <div class="contenedor-categorias">
                <button class="ejecutar-categorias">Categorias</button>
                <div class="contenedor-botones-categorias oculto">
                  <button class="boton-categoria">cortes</button>
                  <button class="boton-categoria">uñas</button>
                  <button class="boton-categoria">depilacion</button>
                  <button class="boton-categoria">maquillaje</button>

                </div>
              </div>
            </div>
          </div>
        <div class="contenedor-perfil" id="perfil">
            <figure>
                    <img src="{{ $imgusuario }}" alt="">
            </figure>

            <div class="menu-perfil oculto" id="menu-perfil">
                <a href="{{ route('usuarios',['accion' => 'config'])}}">
                    <p>Configurar perfil</p>
                </a>
                <hr>
                <!-- Pendiente el yield -->
                <a href="{{ route('usuarios', ['accion' => 'historialCitas'])}}">
                    <p>Historial de citas</p>
                </a>
                <hr>
                <!-- Pendiente el yield -->
                @if(!is_null(session('id_staff')))
                    <a href="{{ route('staff', ['accion' => 'index'])}}">
                        <p>Calendario</p>
                    </a>
                @endif
                <hr>
                <a href="@yield('link-salir')">
                    <p>Salir</p>
                </a>


            </div>
        </div>
    </div>

</header>
@include('components.bandeja')
@once
<link rel="stylesheet" href="{{ asset('Css/Header/Header.css') }}">
<script src="/Js/Header/Header.js"></script>
@endonce
