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
</body>
</html>