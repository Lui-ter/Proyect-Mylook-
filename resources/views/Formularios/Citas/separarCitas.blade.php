<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('Css/Citas/separarCitas.css') }}">
    <title>Agendamiento de citas - MYLOOK</title>
</head>
<body>
    
    <form action="" class="contenedorPadre" method="POST"  enctype="multipart/form-data">
        @csrf
        <span class="infoEstablecimiento">

            <div class="infoPersonal">
                <h2 class="nomEstablecimiento">Barber Shop United S.A.S</h2>
                <p class="nomCliente">Alejandro Aguilon Buitrago</p>
                <p class="fechaCita"><strong>Miercoles</strong> 23 Junio 2024  20:30PM</p>
            </div>

            <figure class="logoEstablecimiento">
                <img src="https://i.pinimg.com/550x/61/aa/33/61aa3330ac4cd406ca6f5a5228757309.jpg" alt="" class="logoImg">
            </figure>
        </span>

        <article class="infoServicios">
            <p class="nomSeleccion">Los servicios que has separado:</p>

            <figure class="contenedorSeleccion">
                <article class="seleccionUnited">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhua_6Y09r7S2St6y6TK2xznI5HHh4MwbrZw&s" alt="" class="imgSeleccion">
                </article>
                <article class="seleccionUnited">
                    <img src="https://miriam.mx/assets/img/_1200x630_crop_center-center_82_none/Depilaci%C3%B3n-de-ceja-para-hombres.jpg?mtime=1695688258" alt="" class="imgSeleccion">
                </article>

                <!-- ESTE ARTICULO SOLO ES PARA LA FUNCIONALIDAD DE AGREGAR OTRO PRODUCTO -->
                <article class="seleccionUnited">
                    <p class="btnAñadir">+</p>
                </article>
            </figure>
        </article>

        <article class="infoPorductos">
            <p class="nomSeleccion">Los productos que has separado:</p>

            <figure class="contenedorSeleccion">
                <article class="seleccionUnited">
                    <img src="https://acdn.mitiendanube.com/stores/001/047/177/products/111-03a9fe3f5a727ef4cc16738747099243-480-0.png" alt="" class="imgSeleccion">
                </article>

                <!-- ESTE ARTICULO SOLO ES PARA LA FUNCIONALIDAD DE AGREGAR OTRO PRODUCTO -->
                <article class="seleccionUnited">
                    <p class="btnAñadir">+</p>
                </article>
            </figure>
        </article>

        <article class="infoSeleccion">
            <span class="alertSeleccion">
                <p class="alert">2 Servicios 1 Producto</p>
            </span>
        </article>

        <article class="infoCondicion">
            <label for="" class="txtCondicion">Condición:</label>
            <textarea name="condicionCita" id="" class="inputCondicion" placeholder="Tengo una piquiña producto de esa cera que me hecharon..."></textarea>
        </article>

        <span class="btnSend">
            <button type="submit" class="btnAgendar Agendar">Guardar Cambios</button>
            <button type="submit" class="btnAgendar">Cancelar Cita</button>
        </span>

    </form>

    

</body>
</html>