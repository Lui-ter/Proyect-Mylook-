<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"  href="{{ asset('Css/Index/indexAdmin.css') }}">
    <title>Mi Negocio | MyLook</title>
</head>


<body>

    @section('link-index', '/admin/index')
    @section('link-configurar-perfil', '/admin/configurar-perfil')
    @section('link-historial', '/admin/historial')
    @section('link-salir', '/negocio/logout')
    
    @include('components.header-staff')
    

    <aside class="bandejaentradaAdmin">
        <article class="containerMensajes">

            <div class="tittleItem">
                <p class="nomEntrada">BANDEJA DE ENTRADA</p>
            </div>

            <div class="mensajesItem">
                <article class="mensajeUnited">

                    <span class="fechaMensaje">
                        <p class="namFecha">26 JUN</p>
                    </span>

                    <div class="mensaje">
                        <h4 class="nomCliente">Alejandro Aguilon Buitrago</h4>
                        <p class="txtMensaje">Solicitud de corte</p>
                    </div>


                    <i class="fas fa-envelope"></i>


                </article>

            </div>

            <div class="showMas">
                <h3 class="tittleShow">VER MÁS</h3>
            </div>

        </article>
    </aside>

    <nav class="menunavegacionAdmin">
        <button type="submit" class="btnCrud">Staff</button>
        <button type="submit" class="btnCrud">Productos</button>
        <button type="submit" class="btnCrud">Servicios</button>
        <button type="submit" class="btnCrud">Inicio</button>
    </nav>

    <main class="contentcrudAdmin">

        <!-- SECCION DEFAULT QUE VE EL USUARIO ADMINISTRADOR CUANDO ENTRA A SU ESTABLECIMIENTOS -->
        <section class="sectionDefault" style="display: none;">

            <div class="infoDefault">
                <p class="txtIntroduccion">Bienvenido al interfaz de Administrador, Aqui podras insertar los productos
                    de tu negocio. Para poder continuar pulsa sobre un <button type="submit" class="btnExample">Botón</button> para poder navegar en las diferentes
                    insercciones que tenemos para ti.
                </p>
            </div>
            <span class="passAndPass">
                <ul class="listaCrud">
                    <li class="optionCrud">Registrar Servicios.</li>
                    <li class="optionCrud">Regsitrar Categorias.</li>
                    <li class="optionCrud">Registrar Tipos de servicio.</li>
                    <li class="optionCrud">Regsitrar Productos.</li>
                    <li class="optionCrud">Configurar Perfil.</li>
                </ul>
            </span>
            <div class="infoImportant">
                <p class="txtImportant"><strong>Nota:</strong> Los cambios realizados en este apartado seran actualizados en las demas interfaces de la aplicación.</p>
            </div>

        </section>

        <!-- SECCION PARA MODIFICAR LOS MIEMBROS DEL STAFF -->
        <section class="crudStaff" style="display: none;">

            <span class="rediretViewStaff">
                <a link href="../../View/Administrador/viewStaff.html" class="tittleRediret">VER TODOS...</a>
            </span>
            <article class="staffItem">
                @foreach($infoStaff as $item)
                <figure class="staffCard">
                    <span class="nomStaff">{{$item['usuario']['nombre']}}</span>

                    <img src="{{$item['usuario']['img_usuario']}}" alt="foto staff" class="imgStaff">

                    <span class="rediretRegister">
                         <!-- Boton para editar un staff -->
                    <form action="{{ route('staff', ['accion' => 'editar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnOption" name="editStaff" value="{{$item['id_usuario'] }}">Editar</button>
                    </form>
                    <!-- Boton para borrar un staff -->
                    <form action="{{ route('staff', ['accion' => 'eliminar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnOption"name="deleteStaff" id="eliminarStaff" value="{{$item['id_usuario']}}">Eliminar</button>
                    </form> 
                    </span>
                </figure>
                @endforeach

                <figure class="staffCard" id="AñadirStaff">
                    <form action="{{ route('staff', ['accion' => 'register']) }}" method="POST">
                        @csrf
                        <button type="submit" style="border: none; background: none;">
                            <a class="rediretStaff">+</a>
                        </button>
                    </form>
                </figure>
            </article>

        </section>

        <!-- SECCION PARA MODIFICAR LOS PRODUCTOS DE MYLOOK -->
        <section class="crudProductos" style="display: none;">
            <span class="rediretViewProductos">
            <a href="{{ route('productos', ['accion' => 'ver']) }}" class="tittleRediret" ver="true">VER TODOS...</a>
            </span>

            <article class="productosItem">
                @foreach($productsPreview as $product)
                <figure class="productoCard">
                    <img src="{{$product['img_prod']}}" alt="" class="imgProducto">

                    <span class="nomProducto">{{$product['nombre_prod']}}</span>

                    <p class="descripProducto">{{$product['desc_prod']}}</p>

                    <span class="rediretRegister">
                    <!-- Boton para editar un producto -->
                    <form action="{{ route('productos', ['accion' => 'editar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnOption" name="editProducto" value="{{ $product['id_prod'] }}">Editar</button>
                    </form>
                    <!-- Boton para borrar un producto -->
                    <form action="{{ route('productos', ['accion' => 'eliminar']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btnOption" name="deleteProducto" id="eliminarItem" value="{{$product['id_prod']}}">Eliminar</button>
                    </form>
                    </span>
                </figure>
                @endforeach
            </article>

        </section>

        <!-- SECCION PARA MODIFICAR LAS CATEGORIAS Y VISUALIZAR EN OTRAS PESTAÑAS LOS SERVICIOS Y LOS TIPOS DE SERVICIO DEL ESTABLECIMIENTO -->
        <section class="crudCategoria" style="display: none;">
            <span class="rediretViewProductos">
                <a link href="{{ route('tipoServicios', ['accion' => 'ver']) }}" class="tittleRediret">VER TIPOS DE SERVICIO</a>
                <a link href="{{route('servicios')}}" class="tittleRediret" >VER SERVICIOS</a>
            </span>

            <div class="contianerCategoria">

                @foreach($categorias as $categoria)
            <article class="categoriaCard">
                <figure class="imgCategoria">
                    <img src="{{$categoria['imagen']}}" alt="" class="fotoCategoria">
                </figure>

                <div class="infoCategoria">
                    <h3 class="nomCategoria">{{$categoria['nom_categoria']}}</h3>
                    <p class="descripCategoria">{{$categoria['desc_categoria']}}</p>
                    <form action="{{ route('categorias', ['accion' => 'editar']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btnOption" name="editCategoria" value="{{ $categoria['id_categoria'] }}">
                            Editar Categoría
                        </button>
                    </form>
                </div>
            </article>
            @endforeach

        </div>

        <span class="rediretCategoria">
            <p class="nomRediret">¿ Deseas registrar una categoría nueva ?<a href="{{ route('categorias', ['accion' => 'nuevo']) }}">Registrar Aquí</a></p>
        </span>

        </section>

        <!-- SECCIÓN PARA EL CALENDARIO -->
<style>
    .custom-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
    }

    .custom-modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        max-width: 500px;
    }

    .close-btn {
        float: right;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
        color: #333;
    }
</style>

<section class="crudInicio">
    <!-- MODAL -->
    <div id="detalleCitaModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-btn" onclick="cerrarModal()">&times;</span>
            <h3>Detalle de la Cita</h3>
            <p><strong>Empleado:</strong> <span id="modalEmpleado"></span></p>
            <p><strong>Usuario:</strong> <span id="modalUsuario"></span></p>
            <p><strong>Establecimiento:</strong> <span id="modalEstablecimiento"></span></p>
            <p><strong>Fecha:</strong> <span id="modalFecha"></span></p>
            <p><strong>Hora Inicio:</strong> <span id="modalHoraInicio"></span></p>
            <p><strong>Hora Fin:</strong> <span id="modalHoraFin"></span></p>
            <p><strong>Producto:</strong> <span id="modalProducto"></span></p>
            <p><strong>Cantidad:</strong> <span id="modalCantidad"></span></p>
            <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
            <form action="{{ route('admin', ['accion' => 'solicitud']) }}" method="POST">
                @csrf
                <input type="hidden" id="modalIdCita" name="id_cita">
                <input type="submit" name="resultado" value="eliminar">
                <input type="submit" name="resultado" value="aceptar">
            </form>
        </div>
    </div>
    <!-- MODAL -->
    <div id='calendar'></div>
</section>


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

<script>
    function cerrarModal() {
        document.getElementById('detalleCitaModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('detalleCitaModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'es',
            allDayText: 'Tiempo',
            titleFormat: {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
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
            },
            dayHeaderFormat: {
                weekday: 'long',
                day: 'numeric'
            },
            events: @json($arreglo),
            // Aqui si el estado es igual a aceptado cambia de color a cafe. lo pueden cambiar
            eventDidMount: function(info) {
            const estado = info.event.extendedProps.estado;

            if (estado === 'Aceptado') {
                info.el.style.backgroundColor = '#A68160'; // café
                info.el.style.borderColor = '#8B4513';
            }
            },
            eventClick: function(info) {

                const evento = info.event.extendedProps;

                // Verifica en consola los datos
                console.log("Datos extendidos del evento: ", info.event.extendedProps);

                // Actualiza los valores del modal
                document.getElementById('modalEmpleado').textContent = evento.empleado || 'No definido';
                document.getElementById('modalUsuario').textContent = evento.usuario || 'No definido';
                document.getElementById('modalEstablecimiento').textContent = evento.establecimiento || 'No definido';
                document.getElementById('modalFecha').textContent = info.event.start.toLocaleDateString();
                document.getElementById('modalHoraInicio').textContent = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                document.getElementById('modalHoraFin').textContent = info.event.end ? info.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : 'N/A';
                document.getElementById('modalProducto').textContent = evento.producto || 'Sin producto';
                document.getElementById('modalCantidad').textContent = evento.cantidad || 'Sin cantidad';
                document.getElementById('modalEstado').textContent = evento.estado || 'Sin estado';

                // Trae el id_cita
                document.getElementById('modalIdCita').value = evento.id_cita;

                // Muestra el modal
                document.getElementById('detalleCitaModal').style.display = 'block';
            }
        });
        calendar.render();
    });
</script>


            

        
        <!-- CRUD DE ADMINISTRADORES DE MYLOOK Y SUS ESTABLECIMIENTOS (( ESTA SECCION SOLO SERA VISIBLE PARA EL ADMINISTRADOR LIDER )) -->
        <section class="sectionAdministrador">

        </section><!-- ---- PEDIENTE DE LOGICA ---- -->

    </main>


    <script src="/Js/Admin/indexAdmin.js">

    </script>
</body>
</html>
