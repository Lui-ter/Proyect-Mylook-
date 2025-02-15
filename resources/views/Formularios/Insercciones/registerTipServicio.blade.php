<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario tipo de servicios</title>
    <link rel="stylesheet" href="/Css/Insercciones/inserccionTipoproducto.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
      <!-- sección todo -->
        <form action="{{ $modeValidator == 1 
        ? route('updateServiceType', ['id' => $typeServices['id_tiposerv']]) 
        : route('registerServiceType') }}"  class="formTservicios" method="post" onsubmit="handleValidationServiceType(event)">

            @csrf
            @method('PUT');
            

                  <h1 class="titulo">TIPO DE SERVICIOS</h1>
            <label for="" class="labels">Seleccionar categoría:</label>
            <select name="Categoria" id="Categoria">
                <option disabled selected>Seleccione una categoria</option>
                @foreach ($categoryData as $category)
                    <option value="{{ $category['id_categoria'] }}">{{ $category['nom_categoria'] }}</option>
                @endforeach
            </select>
            <label for="" class="labels">Nombre del servicio:</label>
            <input type="text" name="nombreServicios" id="nombreServicios" value="{{$typeServices['tipo_serv'] ?? ''}}">
            <div class="botones">
                <button type="reset" class="cancelar" onclick="window.history.back();">CANCELAR</button>
                <button type="submit" class="guardar">{{($modeValidator == 1) ? 'EDITAR':'GUARDAR'}}</button>
            </div>
            </form>

            <script src="{{ asset('Js/Validacion/formValidations.js') }}"></script>

</body>
</html>