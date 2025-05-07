<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Login staff</h1>
     <!-- INICIAR SESION USUARIO -->
     <form action="{{ route('staff', ['accion' => 'LoginStaff'])}}" method="post">
        @csrf
        Documento:<input type="number" name="documentoStaff" placeholder="Ingrese documento..."> <br>
        Contraseña:<input type="password" name="passwordUsuario" placeholder="Ingrese contraseña..."> <br>
        <button type="submit" class="btnStartUsuario">Iniciar Sesion</button>
        
    </form>
</body>
</html>