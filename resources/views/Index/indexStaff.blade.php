<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @section('link-index', '/staff/index')
    @section('link-configurar-perfil', '/staff/configurar-perfil')
    @section('link-historial', '/staff/historial')
    @section('link-salir', '/staff/logout')
    
    @include('components.header-staff')
    <h1>IndexStaff</h1>
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
</body>
</html>