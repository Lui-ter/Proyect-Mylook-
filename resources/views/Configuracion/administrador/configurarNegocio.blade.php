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
        <form action="{{ route('updateNegocioTwo',['id' => $negocio->id_negocio]) }}" method="POST" class="configuracionNegocio formulario" id="form2" onsubmit="handleValidationUpdateNegocio(event)" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- titulo formulario -->
            <h2 class="tituloPrincipal">CONFIGURACION NEGOCIO</h2>
            <div class="contenedorImagen">
                <!-- Input de imagen de fondo -->
                <input type="file" name="img_portada" id="inputImagenFondo" class="inputFile" accept="image/*">
                <img id="imagenFondo" class="imagenFondo" src="{{ $img_portada }}" alt="Imagen de fondo">
                    <!-- Input para el logo (imagen superpuesta) -->
                    <div class="logoNegocio">
                        <input type="file" name="img_logo" id="inputLogo" class="inputFile" accept="image/*">
                        <img id="logo" src="{{ $img_perfil }}" alt="Logo del negocio">
                    </div>
                </div>

                <!-- contenedor de inputs -->
                <div class="formularioNegocio">
                    <div class="informacionInput">
                        <p class="nombreInput">IDENTIFICACION</p>
                        {{-- Comentamos el value que lanza error --}}
                        <input type="number" class="inputId" id="idNegocio" name="idNegocio" value="{{ $negocio->id_negocio }}"  readonly>
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">NOMBRE</p>
                        {{-- Comentamos el value para evitar error por undefined --}}
                        <input type="text" class="inputNombre" id="nombreNegocio" name="nombreNegocio" value="{{ $negocio->nombre_negocio }}" placeholder="Nombre del negocio">
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">DESCRIPCION</p>
                        <textarea name="descripcionNegocio" id="inputDescrip" cols="30" rows="1" class="inputDescrip" placeholder="Ingrese la descripción del negocio">{{ $negocio->desc_negocio }}</textarea>
                    </div>

                    <div class="informacionInput">
                        <p class="nombreInput">ADMINISTRADOR LIDER</p>
                        {{-- Comentamos el value de session --}}
                        <input type="text" class="inputLider" name="nombreAdmin" value="{{ $staffAdmin->nombre . ' ' . $staffAdmin->apellido }}" readonly>
                        {{-- También comentamos este --}}
                        <input type="hidden" name="id_usuario" value="{{ $staffAdmin->id_usuario }}">
                    </div>
                </div>

            <div class="contenedorBoton">
                <button type="submit" class="botonContinuar">ACTUALIZAR</button>
            </div>
        </form>
    </main>
    <script src="{{asset('Js/Validacion/formValidations.js')}}"></script>
    <script>
        const inputFondo = document.getElementById('inputImagenFondo');
        const imagenFondo = document.getElementById('imagenFondo');

        inputFondo.addEventListener('change', () => {
        const file = inputFondo.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {imagenFondo.src = reader.result;};
                reader.readAsDataURL(file);
            }
        });

        const inputLogo = document.getElementById('inputLogo');
        const logo = document.getElementById('logo');

        inputLogo.addEventListener('change', () => {
        const file = inputLogo.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {logo.src = reader.result;};
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
