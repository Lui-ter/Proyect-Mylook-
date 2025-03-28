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
    
    <header class="encabezadoAdmin">
        <h1 class="tittleApp">MYLOOK</h1>

        <figure class="containerPerfil">
            <img src="data:image/png;base64,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" alt="" class="imgPerfil">
        </figure>
    </header>

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

                    <img src="{{$item['img_staff']}}" alt="" class="imgStaff">

                    <span class="rediretRegister">
                        <button type="submit" class="btnOption"><a href="../../Form/Register/Staff/regsiterStaff.html">Editar</a></button>
                        <button type="submit" class="btnOption">Eliminar</button>
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