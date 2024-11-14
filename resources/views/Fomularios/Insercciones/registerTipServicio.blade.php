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
       <section class="formTservicios">
            <h1 class="titulo">TIPO DE SERVICIOS</h1>
            <label for="" class="labels">Seleccionar categoría:</label>
            <select name="Categoria" id="Categoria">
                <option value="1">Maquillaje</option>
                <option value="2">Barbería</option>
                <option value="3">Uñas</option>
                <option value="4">Spa</option>
                <option value="5">Peluquería</option>
            </select>
            <label for="" class="labels">Nombre del servicio:</label>
            <input type="text" name="nombreServicios">
            <div class="botones">
                <button type="reset" class="cancelar">CANCELAR</button>
                <button type="submit" class="guardar">GUARDAR</button>
            </div>
       </section>
</body>
</html>