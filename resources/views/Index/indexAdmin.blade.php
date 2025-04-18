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

        <!-- SECCION PARA MODIFICAR LA IMAGEN DE PRESENTACION DEL ESTABLECIMIENTO -->
        <section class="crudInicio" style="display: none;">
            <article class="containerImg">
                <figure class="imgPresentacion" id="previewImage"></figure>
                <label for="fileInput" class="redirectEditar">
                    <span class="nomEditar">Editar</span>
                    <i class="fas fa-arrow-right-from-bracket"></i>
                </label>
                <input type="file" id="fileInput"  class="input-file-hidden" accept="image/*">
            </article>
        </section>

        <!-- CRUD DE ADMINISTRADORES DE MYLOOK Y SUS ESTABLECIMIENTOS (( ESTA SECCION SOLO SERA VISIBLE PARA EL ADMINISTRADOR LIDER )) -->
        <section class="sectionAdministrador">

        </section><!-- ---- PEDIENTE DE LOGICA ---- -->

    </main>


    <script src="/Js/Admin/indexAdmin.js">

    </script>
</body>
</html>
