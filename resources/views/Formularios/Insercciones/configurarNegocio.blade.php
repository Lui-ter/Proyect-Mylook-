<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>configurar mi negocio</title>
    <link rel="stylesheet" href="{{ asset('Css/Config/administrador/configuracionNegocio.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/validaciones.css') }}">
</head>

<body>
    <main>
        <!--FORMULARIO PARA CREAR O ACTUALIZAR EL NEGOCIO -->
        <form action="{{ route('updateNegocio') }}" method="POST" class="configuracion-negocio formulario"
            id="form2" onsubmit="handleValidationUpdateNegocio(event)" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- titulo formulario -->
            <h2 class="titulo-principal">CONFIGURACION NEGOCIO</h2>
            <p class="descripcion">Aquí podrás ver quién administra tu negocio y personalizar su perfil con imágenes y
                una descripción que lo identifique.</p>
            <div class="contenedor">
                <div class="izquierda">
                    <!-- contenedor de inputs -->
                    <div class="formulario-negocio">

                        <div class="informacion-input">
                            <p class="nombre-input">ADMINISTRADOR LIDER</p>
                            {{-- Comentamos el value de session --}}
                            <input type="text" class="input-lider" name="nombreAdmin"
                                value="{{ $admin->nombre . ' ' . $admin->apellido }}" readonly>
                        </div>

                        <div class="fila">
                            <div class="informacion-input">
                                <p class="nombre-input">IDENTIFICACION</p>
                                {{-- Comentamos el value que lanza error --}}
                                <input type="number" class="input-id" id="idNegocio" name="idNegocio"
                                    value="{{ $negocio->id_negocio }}" readonly>
                            </div>

                            <div class="informacion-input">
                                <p class="nombre-input">NOMBRE</p>
                                {{-- Comentamos el value para evitar error por undefined --}}
                                <input type="text" class="input-nombre" id="nombreNegocio" name="nombreNegocio"
                                    value="{{ $negocio->nombre_negocio }}">
                            </div>
                        </div>

                        <div class="informacion-input">
                            <p class="nombre-input">DESCRIPCION</p>
                            <textarea name="descripcionNegocio" id="inputDescrip" cols="30" rows="1" class="input-descrip">{{ old('descripcionNegocio', $data['descripcionNegocio'] ?? '') }}</textarea>
                            @if (isset($validationErrors) && $validationErrors->has('descripcionNegocio'))
                                <div class="error">{{ $validationErrors->first('descripcionNegocio') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="contenedor-boton boton-1">
                        <button type="submit" class="boton-continuar">GUARDAR</button>
                    </div>
                </div>
                <div class="derecha">
                    <p class="palabra">PREVISUALIZACION</p>
                    <div class="contenedor-imagen">
                        <!-- Input de imagen de fondo -->
                        <input type="file" name="img_portada" id="inputImagenFondo" class="input-file"
                            accept="image/*">
                        <img id="imagenFondo" class="imagen-fondo"
                            src="https://img.freepik.com/foto-gratis/sillas-vintage-peluqueria_155003-10150.jpg"
                            alt="Imagen de fondo">

                        <!-- Input para el logo (imagen superpuesta) -->
                        <div class="logo-negocio">
                            <input type="file" name="img_logo" id="inputLogo" class="input-file" accept="image/*">
                            <img id="logo"
                                src="https://d1yjjnpx0p53s8.cloudfront.net/logotipo-imperio-barberia-vector1.png"
                                alt="Logo del negocio">
                        </div>
                        <p class="nombre">{{ $negocio->nombre_negocio ?: 'Nombre' }}</p>
                        </p>
                    </div>
                    <div class="contenedor-boton boton-2">
                        <button type="submit" class="boton-continuar">GUARDAR</button>
                    </div>
                </div>
            </div>


        </form>
    </main>
    <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>
    <script src="{{ asset('Js/Admin/configNegocio.js') }}"></script>

</body>

</html>
