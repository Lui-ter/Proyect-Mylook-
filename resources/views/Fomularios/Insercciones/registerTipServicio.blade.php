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
        <form action="{{ route('registerServiceType') }}" class="formTservicios" method="post">
            @csrf
            <h1 class="titulo">TIPO DE SERVICIOS</h1>
            <label for="" class="labels">Seleccionar categoría:</label>
            <select name="Categoria" id="Categoria">
                @foreach ($categoryData as $category)
                    <option value="{{ $category['id_categoria'] }}">{{ $category['nom_categoria'] }}</option>
                @endforeach
            </select>
            <label for="" class="labels">Nombre del servicio:</label>
            <input type="text" name="nombreServicios">
            <div class="botones">
                <button type="reset" class="cancelar">CANCELAR</button>
                <button type="submit" class="guardar">GUARDAR</button>
            </div>
            </form>
</body>
</html>